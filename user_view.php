<?php
    require_once './php/dbconnect.php';
    require_once './php/dbcommands.php';

    session_start();

    include './php/user_status.php';

    $get_user_info_query = "SELECT id, fullname, email, phone FROM users WHERE user_name = ?";
    $stmt = $_conn->prepare($get_user_info_query);
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_info = $result->fetch_assoc();
    $result->close();

    $get_all_addresses_query = "SELECT addresses.* 
                                FROM addresses
                                JOIN users
                                ON users.id = addresses.user_id
                                WHERE user_name = ?";
    $stmt = $_conn->prepare($get_all_addresses_query);
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $addresses = $result->fetch_all();
    $result->close();

    $get_all_orders_query = "SELECT orders.id AS id, product_name, main_img, unit_price, discount_percentage, color_name, size_name, orders.quantity AS quantity
                                FROM orders
                                JOIN products_size
                                ON orders.product_size_id = products_size.id
                                JOIN products_color
                                ON products_color.id = products_size.product_color_id
                                JOIN products
                                ON products.id = products_color.product_id
                                JOIN users
                                ON orders.user_id = users.id
                                JOIN colors
                                ON products_color.color_id = colors.id
                                JOIN sizes
                                ON products_size.size_id = sizes.id
                                WHERE users.user_name = ?";
    $stmt = $_conn->prepare($get_all_orders_query);
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all();
    $result->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="app">
        <?php include "header.php" ?>
        <?php include "toast.php" ?>

        <div class="container">
            <div class="grid wide">
                <div class="row">
                    <div class="col l-6">
                        <div class="user__session">
                            <div class="user__session-heading">
                                Thông tin người dùng
                            </div>

                            <div class="user__session-content">
                                <div class="row ud__row-padding-v6">
                                    <div class="col l-6">
                                        <span class="user__form-control"><?php echo $_SESSION['username']; ?></span>
                                    </div>
                    
                                    <div class="col l-6">
                                        <input type="text" name="user_info" placeholder="Họ tên" class="user__form-control js-input--fullname" value="<?php echo $user_info['fullname'] ?>" required>
                                    </div>
                                </div>

                                <div class="row ud__row-padding-v6">
                                    <div class="col l-6">
                                        <input type="tel" name="user_info" placeholder="Số điện thoại" class="user__form-control js-input--phone" value="<?php echo $user_info['phone'] ?>" required>
                                    </div>
                    
                                    <div class="col l-6">
                                        <input type="email" name="user_info" placeholder="Email" class="user__form-control js-input--email" value="<?php echo $user_info['email'] ?>" required>
                                    </div>
                                </div>

                                <div class="row ud__row-padding-v6">
                                    <div class="col l-4 l-o-4">
                                        <button value="<?php echo $user_info['id'] ?>" class="user__button user__button--action user--button--update-user-info hidden_tag">Cập nhật</button>
                                    </div>

                                    <div class="col l-4">
                                        <button class="user__button user__button--action js-logout-button">Đăng xuất</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col l-6">
                        <div class="user__session">
                            <div class="user__session-heading">
                                Sổ địa chỉ giao hàng
                            </div>

                            <div id="user__address-container" class="user__session-content">
                                <div class="row ud__row-padding-v6">
                                    <div class="col l-12">
                                        <label for="user__input-new-address" class="user__form-control">
                                            <input id="user__input-new-address" type="text" name="" placeholder="Thêm địa chỉ mới" class="user__form-control user__form-control--new-address js-input--new-address" value="" required>
                                            <button class="user__button js-add-new-address-button">Thêm</button>
                                        </label>
                                    </div>
                                </div>

                                    <?php
                                        if(count($addresses) > 0){
                                            foreach($addresses as $value){
                                                echo '<div class="row ud__row-padding-v6 address_item">';
                                                echo '<div class="col l-12">';
                                                echo '<span class="user__form-control">';
                                                echo '<span>'.$value[2].'</span>';
                                                echo '<button value="'.$value[0].'" class="user__button js-delete-address-button">Xoá</button>';
                                                echo '</span>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        }
                                    ?>

                                <div class="row">
                                    <span class="message--empty js-message-empty-address <?php echo (count($addresses) == 0 ? '' : 'hidden_tag'); ?>">Sổ địa chỉ trống.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col l-12">
                        <div class="user__session user__session--orders">
                            <div class="user__session-heading">
                                Danh sách đơn đặt hàng
                            </div>

                            <div class="user__session-content user__session-content--orders">
                                <?php
                                    if(count($orders) > 0){
                                        foreach($orders as $order){
                                            echo '<div class="user__order">';
                                            echo '<img src="'.$order[2].'" alt="" class="user__order-img">';
                                            echo '<span class="user__order-name">'.$order[1].'</span>';
                                            echo '<span>Loại: <span class="user__order-option">'.$order[5].', '.$order[6].'</span></span>';
                                            echo '<span class="user__order-price">';
                                            
                                            if($order[4] > 0.0){
                                                echo '<span class="user__order-current-price">'.number_format($order[3] * (1 - $order[4]), 0, ',', '.').'đ</span>';
                                                echo '<span class="user__order-old-price">'.number_format($order[3], 0, ',', '.').'đ</span>';
                                                echo '<span class="user__order-discount">-'.($order[4] * 100).'%</span>';
                                            }
                                            else {
                                                echo '<span class="user__order-current-price">'.number_format($order[3], 0, ',', '.').'đ</span>';
                                            }

                                            echo '</span>';
                                            echo '<span>Số lượng: <span class="user__order-quantity">'.$order[7].'</span></span>';
                                            $total = ($order[4] > 0.0) ? $order[3] * (1 - $order[4]) * $order[7] : $order[3] * $order[7];
                                            echo '<span>Thành tiền: <span class="user__order-total">'.number_format($total, 0, ',', '.').'đ</span></span>';
                                            echo '<button value="'.$order[0].'" class="user__button js-delete-order-button">Xoá</button>';
                                            echo '</div>';
                                        }
                                    }
                                ?>

                                <div class="row">
                                    <span class="message--empty js-message-empty-order <?php echo (count($orders) == 0 ? '' : 'hidden_tag'); ?>">Danh sách đặt hàng trống.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "footer.php" ?>
    </div>

    <script src="../js/toast.js"></script>
    <script>
        <?php
            echo 'var username = "'.$_SESSION['username'].'";';
        ?>

        $(document).ready(function(){
            $('.user--button--update-user-info').click(function(event){
                event.preventDefault();
                var user_id = $(this).val();
                var fullname = $('.js-input--fullname').val();
                var phone = $('.js-input--phone').val();
                var email = $('.js-input--email').val();

                $.ajax({
                    url: '../php/ajax_response.php',
                    type: 'post',
                    data: {
                        action: 'updateUserInfo',
                        user_id,
                        fullname,
                        phone,
                        email
                    }
                }).done(function(response){
                    console.log(response);
                    if(response == true){
                        toast ({
                            title: 'Thông báo',
                            message: 'Cập nhật thông tin người dùng thành công!',
                            type: 'success',
                            duration: 4000
                        })

                        $('.user--button--update-user-info').addClass('hidden_tag');
                    }
                    else {
                        toast ({
                            title: 'Thông báo',
                            message: 'Cập nhật thông tin người dùng không thành công!',
                            type: 'warning',
                            duration: 4000
                        })
                    }
                })
            })

            $('.js-add-new-address-button').click(function(event){
                event.preventDefault();

                var address = $('.js-input--new-address').val();

                if(address !== ''){
                    $.ajax({
                        url: '../php/ajax_response.php',
                        type: 'post',
                        dataType: 'text',
                        data: {
                            action: 'add_new_address_for_user',
                            username,
                            address
                        }
                    }).done(function(response){
                        renderAddress(response, address);

                        toast ({
                            title: 'Thông báo',
                            message: 'Thêm địa chỉ mới thành công!',
                            type: 'success',
                            duration: 4000
                        })

                        $('.js-message-empty-address').addClass('hidden_tag');
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        toast({
                            title: 'Thông báo',
                            message: 'Thêm địa chỉ mới không thành công.',
                            type: 'warning',
                            duration: 4000
                        })
                    })
                }
                else {
                    toast ({
                        title: 'Thông báo',
                        message: 'Vui lòng nhập địa chỉ mới.',
                        type: 'warning',
                        duration: 4000
                    })
                }
            })

            $('.js-delete-order-button').click(function(event){
                event.preventDefault();

                var clickedButton = $(this);
                var order_id = $(this).val();

                $.ajax({
                    url: '../php/ajax_response.php',
                    type: 'post',
                    data: {
                        action: 'deleteOrder',
                        order_id
                    }
                }).done(function(response){
                    if(response == true){
                        clickedButton.closest('.user__order').remove();
                        
                        toast ({
                            title: 'Thông báo',
                            message: 'Xoá đơn hàng thành công!',
                            type: 'success',
                            duration: 4000
                        })

                        if($('.user__session-content--orders .user__order').length == 0){
                            $('.js-message-empty-order').removeClass('hidden_tag');
                        }
                    }
                    else {
                        toast ({
                            title: 'Thông báo',
                            message: 'Xoá đơn hàng không thành công.',
                            type: 'warning',
                            duration: 4000
                        })
                    }
                })
            })

            $('.js-logout-button').click(function(event){
                event.preventDefault();

                $.ajax({
                    url: '../php/ajax_response.php',
                    type: 'post',
                    data: {
                        action: 'logout'
                    }
                })

                window.location.href = '../index.php';
            })
        })

        function renderAddress(address_id, address){
            const element = `
                <div class="row ud__row-padding-v6 address_item">
                <div class="col l-12">
                <span class="user__form-control">
                <span>${address}</span>
                <button value="${address_id}" class="user__button js-delete-address-button">Xoá</button>
                </span>
                </div>
                </div>
            `;

            $('#user__address-container').html($('#user__address-container').html() + element);
        }

        $('input[name=user_info]').on('input', function(){
            $('.user--button--update-user-info').removeClass('hidden_tag');
        })

        $(document).on('click', '.js-delete-address-button', function(event){
            event.preventDefault();

            var address_id = $(this).val();
            var clickedButton = $(this);

            $.ajax({
                url: '../php/ajax_response.php',
                type: 'post',
                data: {
                    action: 'deleteAddress',
                    address_id
                }
            }).done(function(response){
                if(response == true){
                    clickedButton.closest('.address_item').remove();

                    toast ({
                        title: 'Thông báo',
                        message: 'Xoá địa chỉ thành công!',
                        type: 'success',
                        duration: 4000
                    })
                }

                if ($('#user__address-container .address_item').length == 0) {
                    $('.js-message-empty-address').removeClass('hidden_tag');
                }
            }).fail(function(jqXHR, textStatus, errorThrown){
                toast ({
                    title: 'Thông báo',
                    message: 'Xoá địa chỉ không thành công.',
                    type: 'warning',
                    duration: 4000
                })
            });
        })
    </script>
</body>
</html>