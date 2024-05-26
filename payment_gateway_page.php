<?php
    require_once './php/dbconnect.php';
    session_start();

    include './php/user_status.php';

    $product_size_id = $_GET['product_size_id'];
    $quantity = $_GET['quantity'];

    $get_product_info_query = "SELECT product_name, main_img, unit_price, discount_percentage, color_name, size_name
                                FROM products
                                JOIN products_color
                                ON products.id = products_color.product_id
                                JOIN colors
                                ON products_color.color_id = colors.id
                                JOIN products_size
                                ON products_color.id = products_size.product_color_id
                                JOIN sizes
                                ON products_size.size_id = sizes.id
                                WHERE products_size.id = ?";
    $stmt = $_conn->prepare($get_product_info_query);
    $stmt->bind_param('s', $product_size_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product_info = $result->fetch_assoc();
    $result->close();

    $get_user_info_query = "SELECT fullname, email, phone FROM users WHERE user_name = ?";
    $stmt = $_conn->prepare($get_user_info_query);
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_info = $result->fetch_assoc();
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

        <div class="container container--payment-gateway">
            <div class="grid wide">
                <div class="wide payment-gateway__session payment-gateway__session--product">
                    <span class="payment-gateway__heading payment-gateway__heading--product-session">Sản phẩm</span>
                    <div class="payment-gateway__product">
                        <img src="<?php echo $product_info['main_img']; ?>" alt="" class="payment-gateway__product-img">
                        <span class="payment-gateway__product-name"><?php echo $product_info['product_name']; ?></span>
                        <span class="payment-gateway__product-option">Loại: <?php echo $product_info['color_name'].', '.$product_info['size_name']; ?></span>
                        <span class="payment-gateway__product-price">

                        <?php
                            if($product_info['discount_percentage'] > 0.0){
                                echo '<span class="payment-gateway__product-current-price">'.number_format($product_info['unit_price'] * (1 - $product_info['discount_percentage']), 0, ',', '.').'đ</span>';
                                echo '<span class="payment-gateway__product-old-price">'.number_format($product_info['unit_price'], 0, ',', '.').'đ</span>';
                                echo '<span class="payment-gateway__discount">-'.($product_info['discount_percentage'] * 100).'%</span>';
                            }
                            else {
                                echo '<span class="payment-gateway__product-current-price">'.number_format($product_info['unit_price'], 0, ',', '.').'đ</span>';
                            }
                        ?>

                        </span>

                        <span class="payment-gateway__product-quantity">Số lượng: <?php echo $quantity; ?></span>

                        <span>Thành tiền: <span class="payment-gateway__product-total-amount"><?php echo number_format($product_info['unit_price'] * (1-$product_info['discount_percentage']) * $quantity, 0, ',', '.'); ?>đ</span></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col l-6">
                        <form action="" class="payment-gateway__form">
                            <div class="row">
                                <div class="col l-12">
                                    <div class="payment-gateway__session">
                                        <div class="payment-gateway__heading">
                                            Thông tin vận chuyển
                                        </div>
                        
                                        <div class="payment-gateway__control-container">
                                            <div class="row payment-gateway__form-row">
                                                <div class="col l-6">
                                                    <input type="text" name="full_name" placeholder="Họ tên" class="payment-gateway__form-control js-input--fullname" value="<?php echo $user_info['fullname']; ?>" required>
                                                </div>
                    
                                                <div class="col l-6">
                                                    <input type="tel" name="phone" placeholder="Số điện thoại" class="payment-gateway__form-control js-input--phone" value="<?php echo $user_info['phone']; ?>" required>
                                                </div>
                                            </div>
                    
                                            <div class="row payment-gateway__form-row">
                                                <div class="col l-12">
                                                    <input type="email" name="email" placeholder="Email" class="payment-gateway__form-control js-input--email" value="<?php echo $user_info['email']; ?>" required>
                                                </div>
                                            </div>
                    
                                            <div class="row payment-gateway__form-row">
                                                <div class="col l-12">
                                                    <input type="text" name="address_delivery" placeholder="Địa chỉ (ví dụ: 170 An Dương Vương, phường Nguyễn Văn Cừ)" autocomplete="off" class="payment-gateway__form-control js-input--delivery-address" required>
                                                </div>
                                            </div>
                    
                                            <div class="row payment-gateway__form-row">
                                                <div class="col l-12">
                                                    <input type="text" name="cnote" placeholder="Ghi chú thêm (Ví dụ: Giao hàng giờ hành chính)" class="payment-gateway__form-control js-input--note">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col l-12">
                                    <div class="payment-gateway__session">
                                        <div class="payment-gateway__heading">
                                            Hình thức thanh toán
                                        </div>
            
                                        <div class="payment-gateway__control-container">
                                            <div class="row payment-gateway__form-row">
                                                <div class="col l-12">
                                                    <label for="payment-COD" class="payment-gateway__form-control payment-gateway__form-control--payment-method">
                                                        <span class="custom-radio">
                                                            <input type="radio" id="payment-COD" name="payment-method" autocomplete="off" value="COD">
                                                            <span class="custom-radio-checkmark"></span>
                                                        </span>
                    
                                                        <span class="payment-method__item-icon-wrapper">
                                                            <img src="./images/icons/COD.svg" alt="COD <br> Thanh toán khi nhận hàng">
                                                        </span>
                    
                                                        <span class="payment-method__item-name">
                                                            COD
                                                            <br>
                                                            Thanh toán khi nhận hàng
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
            
                                            <div class="row payment-gateway__form-row">
                                                <div class="col l-12">
                                                    <label for="payment-momo" class="payment-gateway__form-control payment-gateway__form-control--payment-method">
                                                        <span class="custom-radio">
                                                            <input type="radio" id="payment-momo" name="payment-method" autocomplete="off" value="momo">
                                                            <span class="custom-radio-checkmark"></span>
                                                        </span>
                    
                                                        <span class="payment-method__item-icon-wrapper">
                                                            <img src="./images/icons/momo-icon.png" alt="Thanh Toán MoMo">
                                                        </span>
                    
                                                        <span class="payment-method__item-name">
                                                            Thanh Toán MoMo
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
            
                                            <div class="row payment-gateway__form-row">
                                                <div class="col l-12">
                                                    <label for="payment-vietqr" class="payment-gateway__form-control payment-gateway__form-control--payment-method">
                                                        <span class="custom-radio">
                                                            <input type="radio" id="payment-vietqr" name="payment-method" autocomplete="off" value="vietqr">
                                                            <span class="custom-radio-checkmark"></span>
                                                        </span>
                    
                                                        <span class="payment-method__item-icon-wrapper">
                                                            <img src="./images/icons/icon-vietqr.svg" alt="Quét QR & Thanh toán bằng ứng dụng ngân hàng<br/>Mờ ứng dụng ngân hàng để thanh toán">
                                                        </span>
                    
                                                        <span class="payment-method__item-name">
                                                            Quét QR & Thanh toán bằng ứng dụng ngân hàng
                                                            <br>
                                                            Mờ ứng dụng ngân hàng để thanh toán
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
            
                                            <div class="row payment-gateway__form-row">
                                                <div class="col l-12">
                                                    <label for="payment-flex_money" class="payment-gateway__form-control payment-gateway__form-control--payment-method">
                                                        <span class="custom-radio">
                                                            <input type="radio" id="payment-flex_money" name="payment-method" autocomplete="off" value="flex_money">
                                                            <span class="custom-radio-checkmark"></span>
                                                        </span>
                    
                                                        <span class="payment-method__item-icon-wrapper">
                                                            <img src="./images/icons/mceclip1_21.png" alt="">
                                                        </span>
                    
                                                        <span class="payment-method__item-name">
                                                            Chuyển khoản liên ngân hàng bằng QR Code
                                                            <br>
                                                            Chuyển tiền qua ví điện tử (MoMo, Zalopay,...)
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col l-12">
                                    <button type="submit" class="payment-gateway__form-submit-btn">Thanh toán</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col l-6">
                        <ul class="address">
                            <div class="payment-gateway__heading">
                                Sổ địa chỉ
                            </div>

                            <?php
                                $query = "SELECT addresses.id as id, address
                                        FROM users
                                        JOIN addresses 
                                        ON users.id = addresses.user_id
                                        WHERE users.user_name = ?";
                                $stmt = $_conn->prepare($query);
                                $stmt->bind_param('s', $_SESSION['username']);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                $addresses = [];

                                if($result->num_rows == 0){
                                    echo '<span class="address__empty-message">Không có địa chỉ nào.</span>';
                                }
                                else {
                                    while($row = $result->fetch_assoc()){
                                        $addresses[$row['id']] = $row['address']; 
                                        $uid = uniqid('address__', true);
                                        echo '<li class="payment-gateway__form-row">';
                                        echo '<label for="'.$uid.'" class="payment-gateway__form-control address__item">';
                                        echo '<span class="custom-radio">';
                                        echo '<input type="radio" id="'.$uid.'" name="address" autocomplete="off" value="'.$row['id'].'">';
                                        echo '<span class="custom-radio-checkmark"></span>';
                                        echo '</span>';
                                        echo '<span class="address_info">';
                                        echo $row['address'];
                                        echo '</span>';
                                        echo '</label>';
                                        echo '</li>';
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>     
        </div>

        <?php include "footer.php" ?>
    </div>
    

    <script src="../js/toast.js"></script>
    <script>
        <?php 
            echo 'var addresses = '.json_encode($addresses).';';
            echo 'var product_size_id = '.$product_size_id.';';
            echo 'var quantity = '.$quantity.';';
            echo 'var username = "'.$_SESSION['username'].'";';
        ?>
                                
        $(document).ready(function(){
            $('input[name="address"]').change(function(){
                $('.js-input--delivery-address').val(addresses[$(this).val()]);
            })

            $('.payment-gateway__form-submit-btn').click(function(event){
                event.preventDefault();

                if($('.js-input--phone').val() === ''){
                    toast ({
                        title: 'Thông báo',
                        message: 'Vui lòng nhập số điện thoại nhận hàng.',
                        type: 'warning',
                        duration: 4000
                    });
                    return;
                }

                if($('.js-input--delivery-address').val() === ''){
                    toast ({
                        title: 'Thông báo',
                        message: 'Vui lòng nhập địa chỉ nhận hàng.',
                        type: 'warning',
                        duration: 4000
                    });
                    return;
                }

                var payment_method = $('input[name=payment-method]:checked');
                if(payment_method.length === 0){
                    toast ({
                        title: 'Thông báo',
                        message: 'Vui lòng chọn phương thức thanh toán.',
                        type: 'warning',
                        duration: 4000
                    });
                    return;
                }

                payment_method = ($(payment_method).val() == 'COD') ? 'offline' : 'online';
                var delivery_phone = $('.js-input--phone').val();
                var note = $('.js-input--note').val();
                
                var delivery_address = $('.js-input--delivery-address').val();

                $.ajax({
                url: '../php/ajax_response.php',
                type: 'post',
                dataType: 'json',
                 data: {
                    action: 'create_order',
                    username,
                    payment_method, 
                    product_size_id,
                    quantity,
                    delivery_phone,
                    delivery_address,
                    note
                }
                }).done(function(response){
                    toast ({
                        title: 'Thông báo',
                        message: response.toast_message,
                        type: response.toast_type,
                        duration: 4000
                    })

                    if(response.toast_type === 'success'){
                        setTimeout(() => {
                            window.location.href = '../user_view.php';
                        }, 5000);
                    }
                })
            })
        })

        $('.js-input--delivery-address').on('input', function(){
            $('input[name="address"]').prop('checked', false);
        })
    </script>
</body>
</html>