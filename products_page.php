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
        
        <div class="container">
            <div class="grid wide">
                <h1 class="products-page__header">Tất cả sản phẩm</h1>
                <div class="row">
                    <div class="col l-2 m-0 c-0">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
                                class="product-filter"
                                method="get">
        
                            <div class="product-filter__item">
                                <p class="product-filter__title">
                                    Danh mục
                                </p>
        
                                <ul class="product-filter__clothing reset-ul">
                                    <li class="product-filter__clothing-item">
                                        <input type="checkbox" name="" id="product-filter--select-shirt">
                                        <label class="product-filter__clothing-title" for="product-filter--select-shirt">
                                            Áo
                                        </label>
                                    </li>
        
                                    <li class="product-filter__clothing-item">
                                        <input type="checkbox" name="" id="product-filter--select-trousers">
                                        <label class="product-filter__clothing-title" for="product-filter--select-trousers">
                                            Quần
                                        </label>
                                    </li>
        
                                    <li class="product-filter__clothing-item">
                                        <input type="checkbox" name="" id="product-filter--select-underwear">
                                        <label class="product-filter__clothing-title" for="product-filter--select-underwear">
                                            Đồ lót
                                        </label>
                                    </li>
                                </ul>
                            </div>
        
                            <div class="product-filter__item">
                                <p class="product-filter__title">
                                    Kích cỡ
                                </p>
        
                                <div class="product-filter__size">
                                    <button class="product-filter__size-item product-filter__button">S</button>
                                    <button class="product-filter__size-item product-filter__button">M</button>
                                    <button class="product-filter__size-item product-filter__button">L</button>
                                    <button class="product-filter__size-item product-filter__button">XL</button>
                                    <button class="product-filter__size-item product-filter__button">2XL</button>
                                    <button class="product-filter__size-item product-filter__button">3XL</button>
                                    <button class="product-filter__size-item product-filter__button">29</button>
                                    <button class="product-filter__size-item product-filter__button">30</button>
                                    <button class="product-filter__size-item product-filter__button">31</button>
                                    <button class="product-filter__size-item product-filter__button">32</button>
                                    <button class="product-filter__size-item product-filter__button">33</button>
                                </div>
                            </div>
        
                            <div class="product-filter__item">
                                <p class="product-filter__title">
                                    Màu sắc
                                </p>
        
                                <div class="product-filter__color">
                                    <button class="product-filter__color-item product-filter__button">
                                        <div class="product-filter__color-img" style="background-image: url(../images/product_colors/black.jpg);"></div>
                                        <span class="product-filter__color-desc">Black</span>
                                    </button>
                                    <button class="product-filter__color-item product-filter__button">
                                        <div class="product-filter__color-img" style="background-image: url(../images/product_colors/gray.jpg);"></div>
                                        <span class="product-filter__color-desc">Gray</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
        
                    <div class="col l-10">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
                            method="get"
                            class="products-page__sort-bar">
                            <span class="products-page__sort-title">
                                Sắp xếp theo
                            </span>
        
                            <button class="products-page__sort-type" value="new">Mới nhất</button>
                            <button class="products-page__sort-type" value="bestseller">Bán chạy</button>
        
                            <input type="radio" name="sort-price" id="products-page__sort-price-asc" value="price-asc">
                            <label class="products-page__sort-type" for="products-page__sort-price-asc">Giá thấp đến cao</label>
        
                            <input type="radio" name="sort-price" id="product-page__sort-price-desc" value="price-desc">
                            <label class="products-page__sort-type" for="products-page__sort-price-desc">Giá cao đến thấp</label>
                        </form>
        
                        <div class="row">
                            <div class="col l-2-4 m-6 c-6">
                                <a class="product-card">
                                    <div class="product-card__img" style="background-image: url(./images/products/polo_active_premium_gray.jpg);"></div>
                                    <div class="product-card__content">
                                        <div class="product-card__options-color">
                                            <button class="product-card__color" name="color">
                                                <span style="background-image: url(./images/product_colors/gray.jpg);"></span>
                                                <img src="./images/products/polo_active_premium_gray.jpg" alt="Gray">
                                            </button>
        
                                            <button class="product-card__color" name="color">
                                                <span style="background-image: url(./images/product_colors/black.jpg);"></span>
                                                <img src="./images/products/polo_active_premium_black.jpg" alt="Black">
                                            </button>
                                        </div>
                                        <p class="product-card__title">Áo Polo Nam Cafe Bo Kẻ</p>
                                        <p class="product-card__short-desc">
                                            <span class="product-card__sub-title">Exdry</span>
                                             / 
                                            <span class="product-card__color-info"></span>
                                        </p>
                                        <div class="product-card__price">
                                            <span class="product-card__current-price">449.000đ</span>
                                            <span class="product-card__old-price">499.000đ</span>
                                            <span class="product-card__discount">-10%</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
        
                        <div class="products-page__loadmore">
                            <button class="products-page__loadmore-btn">
                                Xem thêm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include "footer.php" ?>
    </div>

    <script>
        var colorButtons = document.querySelectorAll('.product-card__color');

        colorButtons.forEach(function(button){
            button.addEventListener('click', function(){
                var product_card = button.closest('.product-card');
                var product_card_img = product_card.querySelector('.product-card__img');
                var selectedImg = button.querySelector('img');
                product_card_img.style.backgroundImage = "url('" + selectedImg.src + "')";

                var productCard_colorInfo = product_card.querySelector('.product-card__color-info');
                productCard_colorInfo.innerText = selectedImg.alt;
            })
        })
    </script>
</body>
</html>
