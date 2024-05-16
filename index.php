<?php
    require_once './php/dbconnect.php';
    require_once './php/dbcommands.php';
    require_once './php/functions.php';
    require_once './php/product_dao.php';
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

        <div class="container">
            <div class="home__container grid wide">
                <div class="slider">
                    <div class="slider__content">
                        <a href="#"><img src="./images/slider/banner.png"></a>
                        <a href="#"><img src="./images/slider/COOL_TEE_(1).jpg"></a>
                        <a href="#"><img src="./images/slider/mceclip2_67.jpg"></a>
                    </div>
    
                    <div class="slider__action">
                        <button class="slider__change-slide-button slider__prev-button">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="slider__change-slide-button slider__next-button">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
    
                <div class="home__product-suggest">
                    <div class="grid wide">
                        <div class="row">
                            <div class="col l-12">
                                <div class="home__product-suggest-heading">
                                    <span>Gợi ý hôm nay</span>
                                </div>
                            </div>
        
                            <?php 
                                $sql = $PRODUCT_QUERY_GET_PRODUCT_CARD_INFO;
                                $result = $_conn->query($sql);
                                while($row = $result->fetch_assoc()){
                                    $rating = getGeneralRatingOfProduct($row['id']);

                                    $unit_price = $row['unit_price'];
                                    $discount_percentage = $row['discount_percentage'];
                                    $sell_price = $unit_price * (1-$discount_percentage);


                                    echo '<div class="col l-2">';
                                    echo '<a class="product-card" href="product_detail_page.php?id='.$row['id'].'&product='.$row['slug'].'">';
                                    echo '<div class="product-card__img" style="background-image: url('.$row['main_img'].');"></div>';
                                    echo '<div class="product-card__content">';

                                    echo '<p class="product-card__title">'.$row['product_name'].'</p>';

                                    echo '<div class="rating-score rating-score--product-card">';
                                    initRatingStars($rating['rating_score']);
                                    echo '<span class="product-detail__rating-score">('.$rating['rating_score'].')</span>';
                                    echo '</div>';

                                    echo '<div class="product-card__price">';
                                    if($discount_percentage > 0){
                                        echo '<span class="product-card__current-price">'.number_format($sell_price, 0, ',', '.').'đ</span>';
                                        echo '<span class="product-card__old-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
                                        echo '<span class="product-card__discount">-'.($discount_percentage * 100).'%</span>';
                                    }
                                    else {
                                        echo '<span class="product-card__current-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
                                    }
                                    echo '</div>';

                                    echo '</div>';
                                    echo '</a>';
                                    echo '</div>';
                                }
                                $result->close();
                            ?>

                            <div class="col l-12">
                                <ul class="pagination">
                                    <li class="pagination__item">
                                        <a href="#" class="pagination__link pagination__link--disable">&laquo;</a>
                                    </li>
                                    <li class="pagination__item">
                                        <a href="#" class="pagination__link">1</a>
                                    </li>
                                    <li class="pagination__item">
                                        <a href="#" class="pagination__link">2</a>
                                    </li>
                                    <li class="pagination__item">
                                        <a href="#" class="pagination__link">3</a>
                                    </li>
                                    <li class="pagination__item">
                                        <a href="#" class="pagination__link pagination__link--disable">...</a>
                                    </li>
                                    <li class="pagination__item">
                                        <a href="#" class="pagination__link">8</a>
                                    </li>
                                    <li class="pagination__item">
                                        <a href="#" class="pagination__link">&raquo;</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "footer.php" ?>
    </div>

    <script>
        var slider = document.querySelector('.slider');
        var sliderImages = slider.querySelectorAll('img');

        var currentIndexSlider = sliderImages.length - 1;

        function nextSlider(){
            sliderImages[currentIndexSlider].classList.remove("slider--display");
            currentIndexSlider = (currentIndexSlider + 1) % sliderImages.length;
            sliderImages[currentIndexSlider].classList.add("slider--display");
        }

        function prevSlider(){
            sliderImages[currentIndexSlider].classList.remove("slider--display");
            currentIndexSlider = (currentIndexSlider == 0) ? sliderImages.length - 1 : currentIndexSlider - 1;
            sliderImages[currentIndexSlider].classList.add("slider--display");
        }

        // setInterval(nextSlider, 2000);
    </script>

    <script>
        var autoSlider = setInterval(nextSlider, 2000);

        function stopAutoSlider() {
            clearInterval(autoSlider);
            autoSlider = null;
        }

        function startAutoSlider() {
            if (autoSlider == null) {
                autoSlider = setInterval(nextSlider, 2000);
            }
        }

        var prevSliderButton = document.querySelector('.slider__prev-button');
        prevSliderButton.addEventListener('click', function(){
            stopAutoSlider();
            prevSlider();
            setTimeout(startAutoSlider, 5000);
        });

        var nextSliderButton = document.querySelector('.slider__next-button');
        nextSliderButton.addEventListener('click', function(){
            stopAutoSlider();
            nextSlider();
            setTimeout(startAutoSlider, 5000);
        });
    </script>
</body>
</html>