<?php
    require_once './php/dbconnect.php';
    require_once './php/dbcommands.php';
    session_start();

    include './php/user_status.php';

    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/main.css">
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

        <div class="container container--cart">
            <div class="grid wide">
                <div class="cart__header">
                    <p class="cart__heading">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Giỏ hàng
                    </p>
                </div>

                <div class="cart__content">
                    <?php
                        $stmt = $_conn->prepare($CART_QUERY_GET_ALL_OF_USER);
                        $stmt->bind_param('s', $username);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()){
                            echo '<div class="cart__item">';
                            echo '<img class="cart__product-img" src="'.$row['main_img'].'" alt="">';
                            echo '<p class="cart__product-name">'.$row['product_name'].'</p>';
                            echo '<div class="cart__item-price">';
                            
                            if($row['discount_percentage'] > 0.0){
                                echo '<span class="cart__item-current-price">'.(number_format($row['unit_price'] * (1 - $row['discount_percentage']), 0, ',', '.')).'đ</span>';
                                echo '<span class="cart__item-old-price">'.number_format($row['unit_price'], 0, ',', '.').'đ</span>';
                                echo '<span class="cart__item-discount">-'.($row['discount_percentage'] * 100).'%</span>';
                            }
                            else {
                                echo '<span class="cart__item-current-price">'.(number_format($row['unit_price'], 0, ',', '.')).'đ</span>';
                            }

                            echo '</div>';

                            echo '<div class="cart__item-action">';
                            echo '<a href="../product_detail_page.php/'.$row['slug'].'-'.$row['id'].'" class="cart__item-action-button cart__item-action-button--buy">Mua</a>';
                            echo '<button class="cart__item-action-button cart__item-action-button--delete" value="'.$row['id'].'">Xoá</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>

                    <span class="cart__empty-message <?php echo ($result->num_rows == 0 ? '' : 'hidden_tag'); ?>">Giỏ hàng trống.</span>
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
            $('.cart__item-action-button--delete').click(function(event){
                event.preventDefault();

                var $clickedButton = $(this); 

                $.ajax({
                    url: '../php/ajax_response.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        action: 'removeCartItem',
                        username,
                        product_id: $(this).val()
                    }
                }).done(function(response){
                    if(response.toast_type === 'success'){
                        $clickedButton.closest('.cart__item').remove();

                        if($('.cart__content .cart_item').length == 0){
                            $('.cart__empty-message').removeClass('hidden_tag');
                        }
                    }

                    toast ({
                        title: 'Thông báo',
                        message: response.toast_message,
                        type: response.toast_type,
                        duration: 4000
                    })
                })
            })
        })
    </script>
</body>
</html>