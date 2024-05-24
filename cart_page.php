<?php
    require_once './php/dbconnect.php';

    $query = 'SELECT * FROM cart WHERE user_id = '.$_SESSION['username'].'';
    $cart_items = $_conn->query($query);
    $products_size_id = [];
    foreach($cart_item as $value){
        $products_size_id[] = $value['product_size_id'];
    }

    $query = 'SELECT products.id, products.product_name, products.unit_price, products.discount_percentage, products.main_img
                FROM products
                JOIN products_color
                ON products.id = products_color.product_id
                JOIN products_size
                ON products_color.id = products_size.product_color_id
                WHERE product_color_id IN (?)
                GROUP BY products.id';
    $stmt = $_conn->prepare($query);
    $stmt->bind_param('s', implode("', '", $products_size_id));
    $stmt->execute();
    $products = $stmt->get_result();
    $products = $products->fetch_all();
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
</head>
<body>
    <div class="app">
        <?php include "header.php" ?>

        <div class="container container--cart">
            <div class="grid wide">
                <div class="cart__header">
                    <p class="cart__heading">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Giỏ hàng
                    </p>
                </div>

                <div class="cart__content">
                    <div class="cart__item">
                        <input type="checkbox" name="" id="">
                        <img class="cart__product-img" src="./images/products/polo_active_premium_black.jpg" alt="">
                        <p class="cart__product-name">Áo sơ mi nam kiểu dáng basic TOPMEN khoác ngoài chất vải kaki cao cấp trẻ trung năng động phù hợp cả mặc đi làm, đi chơi</p>
                        
                        <div class="cart__option">
                            <div class="cart__option--current">
                                <span class="cart__option-info">Đen, M</span> 
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                            

                            <div class="cart__option--other">
                                <div class="cart__option--color">
                                    <p class="cart__option-title">
                                        Màu sắc:
                                    </p>

                                    <div class="cart__option-container">
                                        <button class="cart__option-button">
                                            Cam
                                        </button>

                                        <button class="cart__option-button">
                                            Đen
                                        </button>
                                    </div>
                                </div>

                                <div class="cart__option--size">
                                    <p class="cart__option-title">
                                        Kích thước:
                                    </p>

                                    <div class="cart__option-container">
                                        <button class="cart__option-button">
                                            S
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cart__product-price">
                            <span class="cart__product-current-price">449.000đ</span>
                            <span class="cart__product-old-price">499.000đ</span>
                        </div>
                        <div class="quantity-change quantity-change--cart">
                            <span class="quantity__reduce quantity__reduce--cart">-</span>
                            <span class="quantity__display quantity__display--cart">1</span>
                            <input type="number" value="1" min="1" max="99" class="quantity__control quantity__control--cart">
                            <span class="quantity__augure quantity__augure--cart">+</span>
                        </div>
                        <button class="cart__delete-cart-item-btn">Xoá</button>
                    </div>


                    <?php
                        foreach($cart_items as $value){
                            $get_product_info_query = 'SELECT products.id as id, products.product_name as product_name, products.unit_price as unit_price, products.discount_percentage as discount_percentage, products.main_img as main_img
                                                        FROM products
                                                        JOIN products_color
                                                        ON products.id = products_color.product_id
                                                        JOIN products_size
                                                        ON products_color.id = products_size.product_color_id
                                                        WHERE product_color_id = ?
                                                        GROUP BY products.id';
                            $stmt = $_conn->prepare($get_product_info_query);
                            $stmt->bind_param('s', $value['product_size_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $product_info = $result->fetch_assoc();

                            echo '<div class="cart__item">';
                            echo '<input type="checkbox" name="" id="">';
                            echo '<img class="cart__product-img" src="'.$product_info['main_img'].'" alt="">';
                            echo '<p class="cart__product-name">'.$product_info['product_name'].'</p>';
                            echo '<div class="cart__option">';
                            echo '<div class="cart__option--current">';

                            $get_current_option_query = 'SELECT colors.color_name as color_name, sizes.size_name as size_name
                                        FROM products_color
                                        JOIN colors
                                        ON products_color.color_id = colors.id
                                        JOIN products_size
                                        ON products_color.id = products_size.product_color_id
                                        JOIN sizes
                                        ON sizes.id = products_size.id
                                        WHERE products_size.id = ?';
                            $stmt = $_conn->prepare(get_current_option_query);
                            $stmt->bind_param('s', $value['product_size_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $current_option = $result->fetch_assoc();

                            echo '<span class="cart__option-info">'.$current_option['color_name'].', '.$current_option['size_name'].'</span>';
                            echo '<i class="fa-solid fa-caret-down"></i>';
                            echo '</div>';
                        }
                    ?>
                </div>

                <div class="cart__footer">
                    <span class="cart__select-all"><input type="checkbox" name="" id="">Chọn tất cả</span>
                    <p class="cart__total-bill">
                        Tổng thanh toán (<span class="cart__total-product">0</span> sản phẩm):
                        <span class="cart__total-payment">0đ</span>
                    </p>
                    <button class="cart__buy-btn">Mua hàng</button>
                </div>
            </div>
        </div>

        <?php include "footer.php" ?>
    </div>

    <script src="./js/quantity_up_down.js"></script>
</body>
</html>