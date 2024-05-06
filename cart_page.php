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
                        <select name="" id="" class="cart__product-options cart__product-options--size">
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                        <select name="" id="" class="cart__product-options cart__product-options--color">
                            <option value="Đen">Đen</option>
                            <option value="Trắng">Trắng</option>
                            <option value="Xám">Xám</option>
                        </select>
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

                    <div class="cart__item">
                        <input type="checkbox" name="" id="">
                        <img class="cart__product-img" src="./images/products/polo_active_premium_black.jpg" alt="">
                        <p class="cart__product-name">Áo sơ mi nam kiểu dáng basic TOPMEN khoác ngoài chất vải kaki cao cấp trẻ trung năng động phù hợp cả mặc đi làm, đi chơi</p>
                        <select name="" id="" class="cart__product-options cart__product-options--size">
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                        <select name="" id="" class="cart__product-options cart__product-options--color">
                            <option value="Đen">Đen</option>
                            <option value="Trắng">Trắng</option>
                            <option value="Xám">Xám</option>
                        </select>
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

                    <div class="cart__item">
                        <input type="checkbox" name="" id="">
                        <img class="cart__product-img" src="./images/products/polo_active_premium_black.jpg" alt="">
                        <p class="cart__product-name">Áo sơ mi nam kiểu dáng basic TOPMEN khoác ngoài chất vải kaki cao cấp trẻ trung năng động phù hợp cả mặc đi làm, đi chơi</p>
                        <select name="" id="" class="cart__product-options cart__product-options--size">
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                        <select name="" id="" class="cart__product-options cart__product-options--color">
                            <option value="Đen">Đen</option>
                            <option value="Trắng">Trắng</option>
                            <option value="Xám">Xám</option>
                        </select>
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

                    <div class="cart__item">
                        <input type="checkbox" name="" id="">
                        <img class="cart__product-img" src="./images/products/polo_active_premium_black.jpg" alt="">
                        <p class="cart__product-name">Áo sơ mi nam kiểu dáng basic TOPMEN khoác ngoài chất vải kaki cao cấp trẻ trung năng động phù hợp cả mặc đi làm, đi chơi</p>
                        <select name="" id="" class="cart__product-options cart__product-options--size">
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                        <select name="" id="" class="cart__product-options cart__product-options--color">
                            <option value="Đen">Đen</option>
                            <option value="Trắng">Trắng</option>
                            <option value="Xám">Xám</option>
                        </select>
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
</body>
</html>