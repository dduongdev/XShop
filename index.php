<?php
    require_once './php/dbconnect.php';
    require_once './php/dbcommands.php';
    require_once './php/init_rating_stars.php';
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

        <div class="container">
            <div class="home__container grid wide">
                <div class="slider">
                    <div class="slider__content">
                        <a href="#"><img src="../images/slider/banner.png"></a>
                        <a href="#"><img src="../images/slider/COOL_TEE_(1).jpg"></a>
                        <a href="#"><img src="../images/slider/mceclip2_67.jpg"></a>
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

                <div class="grid wide">
                    <div class="home__product-suggest-heading">
                        <span>Gợi ý hôm nay</span>
                    </div>

                    <div id="home__product-suggest--product" class="row">



                    </div>

                    <div class="pagination">
                        <div class="pagination__item">
                            <span
                                class="pagination__link pagination__link--previous pagination__link--disabled">&laquo;</span>
                        </div>

                        <div class="pagination__can-change">

                        </div>

                        <div class="pagination__item">
                            <span class="pagination__link pagination__link--next">&raquo;</span>
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

        function nextSlider() {
            sliderImages[currentIndexSlider].classList.remove("slider--display");
            currentIndexSlider = (currentIndexSlider + 1) % sliderImages.length;
            sliderImages[currentIndexSlider].classList.add("slider--display");
        }

        function prevSlider() {
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
        prevSliderButton.addEventListener('click', function () {
            stopAutoSlider();
            prevSlider();
            setTimeout(startAutoSlider, 5000);
        });

        var nextSliderButton = document.querySelector('.slider__next-button');
        nextSliderButton.addEventListener('click', function () {
            stopAutoSlider();
            nextSlider();
            setTimeout(startAutoSlider, 5000);
        });
    </script>

    <script>
        <?php
            echo 'var products_data = '.getAllRandomProductCards().';';
        ?>

        let currentPage = 1;
        let itemsPerPageCount = 24;
        let totalPage = (products_data.length % itemsPerPageCount == 0) ? products_data.length / itemsPerPageCount : Math.ceil(products_data.length / itemsPerPageCount);
        let itemsPerPage = products_data.slice((currentPage - 1) * itemsPerPageCount, (currentPage - 1) * itemsPerPageCount + itemsPerPageCount);

        renderProductData();
        const paginationLimitItem = 5;
        renderPagination();

        function handlePageNavigation(pageNumber) {
            currentPage = pageNumber;
            itemsPerPage = products_data.slice((currentPage - 1) * itemsPerPageCount, (currentPage - 1) * itemsPerPageCount + itemsPerPageCount);
            renderProductData();
        }

        function renderProductData() {
            let element = '';
            itemsPerPage.map(value => {
                element += `
                    <div class="col l-2">
                        <a class="product-card" href="../product_detail_page.php/${value[5]}-${value[0]}">
                            <div class="product-card__img" style="background-image: url(${value[2]});"></div>
                            <div class="product-card__content">
                                <p class="product-card__title">${value[1]}</p>
                                <div class="rating-score rating-score--product-card">
                                    ${renderRatingStars(parseFloat(value[6]))}
                                    <span class="product-detail__rating-score">(${value[6]})</span>
                                </div>
                                <div class="product-card__price">
                                    ${renderProductPrice(parseFloat(value[3]), parseFloat(value[4]))}
                                </div>
                            </div>
                        </a>
                    </div>
                `;
            });
            $('#home__product-suggest--product').html(element);
        }

        function renderProductPrice(unit_price, discount_percentage) {
            let result = '';
            if (discount_percentage > 0.0) {
                var new_price = unit_price * (1 - discount_percentage);
                result += `<span class="product-card__current-price">${new_price.toLocaleString('de-DE')}đ</span>`;
                result += `<span class="product-card__old-price">${unit_price.toLocaleString('de-DE')}đ</span>`;
                result += `<span class="product-card__discount">-${discount_percentage * 100}%</span>`;
            } else {
                result += `<span class="product-card__current-price">${unit_price.toLocaleString('de-DE')}đ</span>`;
            }
            return result;
        }

        function renderRatingStars(rating_score){
            let result = '';
            var i = 1;
            for(; i <= Math.floor(rating_score); i++){
                result += `<div class="rating-score__star is-active"></div>`;
            }

            if(rating_score > Math.floor(rating_score)){
                result += `<div class="rating-score__star is-half"></div>`;
                i++;
            }

            for(; i <= 5; i++){
                result += `<div class="rating-score__star is-neutral"></div>`;
            }

            return result;
        }

        $(document).ready(function () {
            $('.pagination__link--previous').click(function () {
                if (currentPage > 1) {
                    currentPage -= 1;
                    renderPagination();
                    handlePageNavigation(currentPage);
                }
            })

            $('.pagination__link--next').click(function () {
                if (currentPage < totalPage) {
                    currentPage += 1;
                    renderPagination();
                    handlePageNavigation(currentPage);
                }
            })
        })

        $(document).on('click', '.pagination__link--can-change', function () {
            currentPage = parseInt($(this).text());
            renderPagination();
            handlePageNavigation(currentPage);
        })

        function renderPagination() {
            var newPaginationItems = '';

            if (currentPage > 1) {
                $('.pagination__link--previous').removeClass('pagination__link--disabled');
            } else {
                $('.pagination__link--previous').addClass('pagination__link--disabled');
            }

            if (currentPage < totalPage) {
                $('.pagination__link--next').removeClass('pagination__link--disabled');
            } else {
                $('.pagination__link--next').addClass('pagination__link--disabled');
            }

            if (currentPage <= 3) {
                for (var i = 1; i <= Math.min(totalPage, paginationLimitItem - 1); i++) {
                    newPaginationItems += `
                            <span class="pagination__link pagination__link--can-change${i === currentPage ? ' pagination__link--current' : ''}">${i}</span>
                        `;
                }
                if (totalPage > paginationLimitItem) {
                    newPaginationItems += `
                            <span class="pagination__link pagination__link--disabled">...</span>
                            <span class="pagination__link pagination__link--can-change">${totalPage}</span>
                        `;
                }
            } else if (currentPage >= 4 && currentPage <= totalPage - 3) {
                newPaginationItems += `
                        <span class="pagination__link pagination__link--can-change">1</span>
                        <span class="pagination__link pagination__link--disabled">...</span>
                    `;
                for (var i = currentPage - 1; i <= currentPage + 1; i++) {
                    newPaginationItems += `
                            <span class="pagination__link pagination__link--can-change${i === currentPage ? ' pagination__link--current' : ''}">${i}</span>
                        `;
                }
                newPaginationItems += `
                        <span class="pagination__link pagination__link--disabled">...</span>
                        <span class="pagination__link pagination__link--can-change">${totalPage}</span>
                    `;
            } else {
                newPaginationItems += `
                        <span class="pagination__link pagination__link--can-change">1</span>
                        <span class="pagination__link pagination__link--disabled">...</span>
                    `;
                for (var i = totalPage - (paginationLimitItem - 2); i <= totalPage; i++) {
                    newPaginationItems += `
                            <span class="pagination__link pagination__link--can-change${i === currentPage ? ' pagination__link--current' : ''}">${i}</span>
                        `;
                }
            }

            $('.pagination__can-change').html(newPaginationItems);
        }
    </script>
</body>

</html>