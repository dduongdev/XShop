<?php
    require_once 'dbconnect.php';
    require_once 'dbcommands.php';
    require_once 'product_dao.php';
    require_once 'cart_dao.php';
    require_once 'user_dao.php';

    $action = $_POST['action'] ?? '';
    switch($action){
        case 'product_detail_change':
            $product_id = $_POST['product_id'];
            $color_slug = $_POST['color_slug'];
            echo product_detail_change($product_id, $color_slug);
            break;
        case 'products_page_pagination':
            $start = $_POST['start'];
            $end = $_POST['end'];
            echo products_page_pagination($start, $end);
            break;
        case 'add_product_to_cart_of_user':
            $username = $_POST['username'];
            $product_id = $_POST['product_id'];
            echo addProductToCartOfUser($username, $product_id);
            break;
        case 'add_new_address_for_user':
            $username = $_POST['username'];
            $address = $_POST['address'];
            echo add_new_address_for_user($username, $address);
            break;
        case 'create_order':
            $username = $_POST['username'];
            $payment_method = $_POST['payment_method'];
            $product_size_id = $_POST['product_size_id'];
            $quantity = $_POST['quantity'];
            $delivery_phone = $_POST['delivery_phone'];
            $delivery_address = $_POST['delivery_address'];
            $note = $_POST['note'];
            echo create_order($username, $payment_method, $product_size_id, $quantity, $delivery_phone, $delivery_address, $note);
            break;
        case 'removeCartItem':
            $username = $_POST['username'];
            $product_id = $_POST['product_id'];
            echo removeCartItem($username, $product_id);
            break;
        case 'updateUserInfo':
            $user_id = $_POST['user_id'];
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            echo updateUserInfo($user_id, $fullname, $phone, $email);
            break;
        case 'deleteAddress':
            $address_id = $_POST['address_id'];
            echo deleteAddress($address_id);
            break;
        case 'deleteOrder':
            $order_id = $_POST['order_id'];
            echo deleteOrder($order_id);
            break;
    }

    function product_detail_change($product_id, $color_slug){
        $images = getAllImagesOfProductColor($product_id, $color_slug);

        $result = ['main_image' => '', 'images' => '', 'sizes' => '', 'sizes_data'];
        $result['main_image'] = $images[0];
        $result['images'] = '<img class="product-detail__sub-image product-detail__sub-image--is-selected" src="'.$images[0].'">';
        for($i=1; $i<count($images); $i++){
                $result['images'] .= '<img class="product-detail__sub-image" src="'.$images[$i].'">';
        }
        
        $sizes = getAllSizesOfColor($product_id, $color_slug);

        foreach($sizes as $key => $value){
            if(((int)$value['remaining_quantity']) > 0){
                $uid = uniqid('product-option_', true);
                $result['sizes'] .= '<label for="'.$uid.'" class="product-option__select-item product-option__select-item--size">';
                $result['sizes'] .= $value['size_name'];
                $result['sizes'] .= '<input type="radio" class="hidden_tag" name="size" value="'.$key.'" size-value="'.$value['size_name'].'" id="'.$uid.'">';
                $result['sizes'] .= '</label>';
            }
        }  

        $result['sizes_data'] = $sizes;

        echo json_encode($result);
    }

    function products_page_pagination($sql, $start, $end){
        $data = queryPagination($sql, $start, $end);

        $html = '';

        while($row = $data->fetch_assoc()){
            $rating = getGeneralRatingOfProduct($row['id']);

            $unit_price = $row['unit_price'];
            $discount_percentage = $row['discount_percentage'];
            $sell_price = $unit_price * (1-$discount_percentage);


            $html .= '<div class="col l-2-4 m-6 c-6">';
            $html .= '<a class="product-card" href="../product_detail_page.php/'.$row['slug'].'-'.$row['id'].'">';
            $html .= '<div class="product-card__img" style="background-image: url('.$row['main_img'].');"></div>';
            $html .= '<div class="product-card__content">';

            $html .= '<p class="product-card__title">'.$row['product_name'].'</p>';

            $html .= '<div class="rating-score rating-score--product-card">';
            $html .= initRatingStars($rating['rating_score']);
            $html .= '<span class="product-detail__rating-score">('.$rating['rating_score'].')</span>';
            $html .= '</div>';

            $html .= '<div class="product-card__price">';
            if($discount_percentage > 0){
                $html .= '<span class="product-card__current-price">'.number_format($sell_price, 0, ',', '.').'đ</span>';
                $html .= '<span class="product-card__old-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
                $html .= '<span class="product-card__discount">-'.($discount_percentage * 100).'%</span>';
            }
            else {
                $html .= '<span class="product-card__current-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
            }
            $html .= '</div>';

            $html .= '</div>';
            $html .= '</a>';
            $html .= '</div>';
        }
        $data->close();

        return $html;
    }

    function addProductToCartOfUser($username, $product_id){
        global $_conn;
        global $CART_QUERY_ADD;

        if(checkExistCartItemOfUser($username, $product_id)){
            return json_encode(['toast_type' => 'info', 'toast_message' => 'Sản phẩm đã có trong giỏ hàng.']);
        }
        else {
            $stmt = $_conn->prepare($CART_QUERY_ADD);
            $stmt->bind_param('ss', $username, $product_id);
            try {
                $stmt->execute();
                if($stmt->affected_rows > 0){
                    return json_encode(['toast_type' => 'success', 'toast_message' => 'Thêm vào giỏ hàng thành công!']);
                }
                else {
                    return json_encode(['toast_type' => 'warning', 'toast_message' => 'Thêm vào giỏ hàng không thành công!']);
                }
            }
            catch(Exception){
                return json_encode(['toast_type' => 'warning', 'toast_message' => 'Thêm vào giỏ hàng không thành công!']);
            }
        }
    }

    function add_new_address_for_user($username, $address){
        global $_conn;

        $user_id = getUserIdByUsername($username);

        $query = "INSERT addresses(user_id, address) VALUES(?, ?)";
        $stmt = $_conn->prepare($query);
        $stmt->bind_param('ss', $user_id, $address);
        try {
            $stmt->execute();
            echo $_conn->insert_id;
        }
        catch(Exception){
            throw new Exception();
        }
    }

    function create_order($username, $payment_method, $product_size_id, $quantity, $delivery_phone, $delivery_address, $note){
        global $_conn;

        $user_id = getUserIdByUsername($username);

        $query = "INSERT orders(user_id, payment_method, product_size_id, quantity, delivery_phone, delivery_address, note)
                VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $_conn->prepare($query);
        $stmt->bind_param('sssssss', $user_id, $payment_method, $product_size_id, $quantity, $delivery_phone, $delivery_address, $note);
        try {
            $stmt->execute();
            return json_encode(['toast_type' => 'success', 'toast_message' => 'Đặt hàng thành công!']);
        }
        catch(Exception){
            return json_encode(['toast_type' => 'warning', 'toast_message' => 'Đặt hàng không thành công!']);
        }
    }

    function removeCartItem($username, $product_id){
        global $_conn;

        $user_id = getUserIdByUsername($username);

        $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $_conn->prepare($query);
        $stmt->bind_param('ss', $user_id, $product_id);
        try {
            $stmt->execute();
            if($stmt->affected_rows > 0){
                return json_encode(['toast_type' => 'success', 'toast_message' => 'Xoá khỏi giỏ hàng thành công!']);
            }
            else {
                return json_encode(['toast_type' => 'warning', 'toast_message' => 'Xoá khỏi giỏ hàng không thành công!']);
            }
        }
        catch(Exception){
            return json_encode(['toast_type' => 'warning', 'toast_message' => 'Xoá khỏi giỏ hàng không thành công!']);
        }
    }

    function updateUserInfo($user_id, $fullname, $phone, $email) {
        global $_conn;

        $query = "UPDATE users
                    SET fullname = ?, phone = ?, email = ?
                    WHERE id = ?";
        $stmt = $_conn->prepare($query);
        $stmt->bind_param('ssss', $fullname, $phone, $email, $user_id);
        try {
            $stmt->execute();
            return true;
        }
        catch(Exception){
            return false;
        }
    }

    function deleteAddress($address_id){
        global $_conn;

        $query = "DELETE FROM addresses
                    WHERE id = ?";
        $stmt = $_conn->prepare($query);
        $stmt->bind_param('s', $address_id);
        try {
            $stmt->execute();
            if($stmt->affected_rows > 0){
                return true;
            }
            return false;
        }
        catch(Exception){
            throw new Exception();
        }
    }

    function deleteOrder($order_id){
        global $_conn;

        $query = "DELETE FROM orders WHERE id = ?";
        $stmt = $_conn->prepare($query);
        $stmt->bind_param('s', $order_id);
        try {
            $stmt->execute();
            if($stmt->affected_rows > 0){
                return true;
            }
            return false;
        }
        catch(Exception){
            throw new Exception();
        }
    }
?>