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
                <section>
                    <div class="row">
                        <div class="col l-3 l-o-2">
                            <div class="product-detail__images">
                                <img src="./images/products/polo_active_premium_gray.jpg" alt="" class="product-detail__main-image">
        
                                <div class="product-detail__sub-images">
                                    <img class="product-detail__sub-image" src="./images/products/polo_active_premium_gray.jpg" value="Gray" alt="Gray">
                                    <img class="product-detail__sub-image" src="./images/products/polo_active_premium_black.jpg" value="Black" alt="Black">
                                </div>
                            </div>
                        </div>
    
                        <div class="col l-6">
                            <div class="product-detail__container">
                                <p class="product-detail__title">Áo Polo Nam Cafe Bo Kẻ</p>
                                <p class="product-detail__sub-title">
                                    <span class="product-detail__short-desc">
                                        Exdry
                                    </span>
    
                                    /
    
                                    <span class="product-detail__short-info">
    
                                    </span>
                                </p>
    
                                <div class="rating-score">
                                    <div class="rating-score__star is-active"></div>
                                    <div class="rating-score__star is-active"></div>
                                    <div class="rating-score__star is-active"></div>
                                    <div class="rating-score__star is-half"></div>
                                    <div class="rating-score__star is-neutral"></div>
                                    <span class="product-detail__rating-score">(3.5)</span>
                                </div>
    
                                <div class="product-detail__price">
                                    <span class="product-detail__current-price">449.000đ</span>
                                    <span class="product-detail__old-price">499.000đ</span>
                                    <span class="product-detail__discount">-10%</span>
                                </div>
    
                                <div class="product-detail__policy">
                                    <div class="row">
                                        <div class="col l-6">
                                            <div class="product-detail__policy-item">
                                                <i class="fa-solid fa-right-left product-detail__policy-icon"></i>
                                                <span class="product-detail__policy-content">Đổi trả miễn phí trong vòng 15 ngày</span>
                                            </div>
                                        </div>
    
                                        <div class="col l-6">
                                            <div class="product-detail__policy-item">
                                                <i class="fa-solid fa-arrow-rotate-left product-detail__policy-icon"></i>
                                                <span class="product-detail__policy-content">Đổi trả cực dễ chỉ cần số điện thoại</span>
                                            </div>
                                        </div>
    
                                        <div class="col l-6">
                                            <div class="product-detail__policy-item">
                                                <i class="fa-solid fa-phone product-detail__policy-icon"></i>
                                                <span class="product-detail__policy-content">Hotline 0385.216.798 hỗ trợ từ 8h30 - 22h mỗi ngày</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <form action="" class="product-detail__options">
                                    <div class="product-option">
                                        <div class="product-option__heading">
                                            <span>Màu sắc: </span>
                                            <span class="product-option__selected-option product-option__selected-option--color"></span>
                                        </div>
                                        
                                        <div class="product-option__select product-option__select--color-select">
                                            <button class="product-option__select-item product-option__select-item--color" name="color" value="Gray">
                                                <span style="background-image: url(./images/product_colors/gray.jpg);"></span>
                                            </button>
    
                                            <button class="product-option__select-item product-option__select-item--color" name="color" value="Black">
                                                <span style="background-image: url(./images/product_colors/black.jpg);"></span>
                                            </button>
                                        </div>
                                    </div>
    
                                    <div class="product-option">
                                        <div class="product-option__heading product-option__heading--size-option">
                                            <div class="">
                                                <span>Kích thước: </span>
                                                <span class="product-option__selected-option product-option__selected-option--size"></span>
                                            </div>
    
                                            <span class="product-detail__select-size-guide">
                                                Hướng dẫn chọn size
                                            </span>
                                        </div>
    
                                        <div class="product-option__select product-option__select--size-select">
                                            <button class="product-option__select-item product-option__select-item--size" value="S">
                                                S
                                            </button>
    
                                            <button class="product-option__select-item product-option__select-item--size" value="M">
                                                M
                                            </button>
    
                                            <button class="product-option__select-item product-option__select-item--size" value="L">
                                                L
                                            </button>
    
                                            <button class="product-option__select-item product-option__select-item--size" value="XL">
                                                XL
                                            </button>
    
                                            <button class="product-option__select-item product-option__select-item--size" value="2XL">
                                                2XL
                                            </button>
    
                                            <button class="product-option__select-item product-option__select-item--size" value="3XL">
                                                3XL
                                            </button>
                                        </div>
                                    </div>
    
                                    <div class="product-option">
                                        <div class="product-option__heading">
                                            <span>Số lượng: </span>
                                        </div>
    
                                        <div class="product-option__select product-option__select--quantity-select">
                                            <div class="quantity-change">
                                                <span class="quantity__reduce">-</span>
                                                <span class="quantity__display">1</span>
                                                <input type="number" value="1" min="1" max="99" class="quantity__control">
                                                <span class="quantity__augure">+</span>
                                            </div>
    
                                            <span class="quantity__quantity-remaining">7749 sản phẩm có sẵn</span>
                                        </div>
                                    </div>
    
                                    <div class="product-detail__actions">
                                        <button class="product-detail__action-btn product-detail__action-btn--add-to-cart">
                                            Thêm vào giỏ hàng
                                        </button>
    
                                        <button class="product-detail__action-btn product-detail__action-btn--buy">
                                            Mua ngay
                                        </button>
                                    </div>
                                </form>
    
                                <div class="product-detail__description">
                                    <p class="product-detail__description-heading">
                                        Mô tả sản phẩm
                                    </p>
    
                                    <p class="product-detail__description-item">
                                        Chất liệu: 50% S.Café + 50% Recycled PET
                                    </p>
    
                                    <p class="product-detail__description-item">
                                        Sợi S.Café có tính kháng khuẩn tự nhiên và chống tia UV
                                    </p>
    
                                    <p class="product-detail__description-item">
                                        Công nghệ Hydroponic tăng khả năng bốc hơi ẩm khỏi vải, giúp nhanh khô
                                    </p>
    
                                    <p class="product-detail__description-item">
                                        Bo cổ dùng sợi Hightwisted 45D/75D tạo co giãn và bền form
                                    </p>
    
                                    <p class="product-detail__description-item">
                                        Phù hợp với: đi làm, đi chơi
                                    </p>
    
                                    <p class="product-detail__description-item">
                                        Kiểu dáng Regular fit
                                    </p>
    
                                    <p class="product-detail__description-item">
                                        Tự hào sản xuất tại Việt Nam
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="product-detail__feedback">
                    <div class="row">
                        <div class="col l-2 l-o-1">
                            <div class="overall-rating">
                                <span class="overall-rating__title">Đánh giá sản phẩm</span>
                                <span class="overall-rating__score">3.5</span>
                                <div class="rating-score rating-score--overall-rating">
                                    <div class="rating-score__star is-active"></div>
                                    <div class="rating-score__star is-active"></div>
                                    <div class="rating-score__star is-active"></div>
                                    <div class="rating-score__star is-half"></div>
                                    <div class="rating-score__star is-neutral"></div>
                                </div>
                                <span class="overall-rating__count">5 lượt đánh giá</span>
                            </div>
                        </div>

                        <div class="col l-8">
                            <div class="row">
                                <div class="col l-6">
                                    <div class="feedback-item">
                                        <div class="rating-score rating-score--feedback-item">
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-half"></div>
                                            <div class="rating-score__star is-neutral"></div>
                                        </div>

                                        <p class="feedback-item__author">Nguyễn Đông Dương</p>
                                        <p class="feedback-item__purchased-product-short-info">Black / 3XL</p>
                                        <p class="feedback-item__content">Ảo mỏng, nhẹ, thoáng, thấm mồ hôi. Quần short nhẹ, mình mặc để chạy bộ khá thoải mái</p>
                                    </div>
                                </div>

                                <div class="col l-6">
                                    <div class="feedback-item">
                                        <div class="rating-score rating-score--feedback-item">
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-half"></div>
                                            <div class="rating-score__star is-neutral"></div>
                                        </div>

                                        <p class="feedback-item__author">Nguyễn Đông Dương</p>
                                        <p class="feedback-item__purchased-product-short-info">Black / 3XL</p>
                                        <p class="feedback-item__content">Ảo mỏng, nhẹ, thoáng, thấm mồ hôi. Quần short nhẹ, mình mặc để chạy bộ khá thoải mái</p>
                                    </div>
                                </div>

                                <div class="col l-6">
                                    <div class="feedback-item">
                                        <div class="rating-score rating-score--feedback-item">
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-half"></div>
                                            <div class="rating-score__star is-neutral"></div>
                                        </div>

                                        <p class="feedback-item__author">Nguyễn Đông Dương</p>
                                        <p class="feedback-item__purchased-product-short-info">Black / 3XL</p>
                                        <p class="feedback-item__content">Ảo mỏng, nhẹ, thoáng, thấm mồ hôi. Quần short nhẹ, mình mặc để chạy bộ khá thoải mái</p>
                                    </div>
                                </div>

                                <div class="col l-6">
                                    <div class="feedback-item">
                                        <div class="rating-score rating-score--feedback-item">
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-active"></div>
                                            <div class="rating-score__star is-half"></div>
                                            <div class="rating-score__star is-neutral"></div>
                                        </div>

                                        <p class="feedback-item__author">Nguyễn Đông Dương</p>
                                        <p class="feedback-item__purchased-product-short-info">Black / 3XL</p>
                                        <p class="feedback-item__content">Ảo mỏng, nhẹ, thoáng, thấm mồ hôi. Quần short nhẹ, mình mặc để chạy bộ khá thoải mái</p>
                                    </div>
                                </div>
                            </div>

                            <div class="loadmore">
                                <button class="loadmore-btn">
                                    Xem thêm
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <?php include "footer.php" ?>
    </div>

    <div class="modal modal--close">
        <div class="modal__overlay"></div>

        <div class="modal__body">
            <div class="modal__inner">
                <div class="select-size-guide-modal modal__container modal--close">
                    <button class="modal__close-btn">
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                    <div class="select-size-guide-modal__header">
                        <p class="select-size-guide-modal__heading">Bảng size</p>
                    </div>

                    <div class="select-size-guide-modal__content">
                        <table>
                            <thead>
                                <tr>
                                    <td>Size</td>
                                    <td>S</td>
                                    <td>M</td>
                                    <td>L</td>
                                    <td>XL</td>
                                    <td>2XL</td>
                                    <td>3XL</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Chiều cao</td>
                                    <td>1m55 - 1m59</td>
                                    <td>1m60 - 1m65</td>
                                    <td>1m66 - 1m72</td>
                                    <td>1m72 - 1m77</td>
                                    <td>1m77 - 1m83</td>
                                    <td>1m84 - 1m88</td>
                                </tr>
                                <tr>
                                    <td>Cân nặng</td>
                                    <td>48kg - 54kg</td>
                                    <td>55kg - 61kg</td>
                                    <td>62kg - 68kg</td>
                                    <td>69kg - 75kg</td>
                                    <td>76kg - 82kg</td>
                                    <td>83kg - 87kg</td>
                                </tr>
                                <tr>
                                    <td>Dài áo</td>
                                    <td>66</td>
                                    <td>68</td>
                                    <td>70</td>
                                    <td>72</td>
                                    <td>74</td>
                                    <td>76</td>
                                </tr>
                                <tr>
                                    <td>Dài tay</td>
                                    <td>17</td>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                    <td>22</td>
                                </tr>
                                <tr>
                                    <td>Rộng ngực</td>
                                    <td>48</td>
                                    <td>50</td>
                                    <td>52</td>
                                    <td>54</td>
                                    <td>56</td>
                                    <td>58</td>
                                </tr>
                                <tr>
                                    <td>Rộng vai</td>
                                    <td>42.5</td>
                                    <td>44</td>
                                    <td>45.5</td>
                                    <td>47</td>
                                    <td>48.5</td>
                                    <td>50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="select-size-guide-modal__footer">
                        <div class="select-size-guide-modal__tips">
                            Trường hợp số đo của bạn nằm trong khoảng giữa các size với nhau:<br>
                            Với áo thun, bạn hãy lựa chọn ưu tiên theo chiều cao <br>
                            Ví dụ chiều cao của bạn theo size L nhưng cân nặng của bạn theo size M, Hãy chọn L.<br>
                            <br>
                            97% khách hàng của chúng tôi đã chọn đúng size theo cách này.<br>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        var productImages = {
            "Gray": "./images/products/polo_active_premium_gray.jpg",
            "Black": "./images/products/polo_active_premium_black.jpg"
        }

        var mainImage = document.querySelector('.product-detail__main-image');
        var subImages = document.querySelectorAll('.product-detail__sub-image');
        subImages.forEach(
            x => x.addEventListener('click', function(){
                productColorOptions.forEach(
                    y => y.classList.remove('product-option__select-item--is-selected')
                )
                document.querySelector('.product-option__selected-option--color').innerText = "";
                subImages.forEach(
                    y => y.classList.remove('product-detail__sub-image--is-selected')
                )
                x.classList.add('product-detail__sub-image--is-selected');

                var colorValue = x.getAttribute('value');
                mainImage.src = productImages[colorValue];
                shortInfo_colorChanged(colorValue);
            })
        )

        function shortInfo_colorChanged(info){
            var shortInfo = document.querySelector('.product-detail__short-info');
            shortInfo.innerText = info;
        }

        var productOptionItems = document.querySelectorAll('.product-option__select-item');
        productOptionItems.forEach(
            x => x.addEventListener('click', function(event){
                event.preventDefault();
            })
        )

        var productColorOptions = document.querySelectorAll('.product-option__select-item--color');
        productColorOptions.forEach(
            x => x.addEventListener('click', function(){
                subImages.forEach(
                    y => y.classList.remove('product-detail__sub-image--is-selected')
                )
                productColorOptions.forEach(
                    y => y.classList.remove('product-option__select-item--is-selected')
                )
                x.classList.add('product-option__select-item--is-selected');

                var colorValue = x.getAttribute('value');
                mainImage.src = productImages[colorValue];
                shortInfo_colorChanged(colorValue);

                var selectedColorInfo = document.querySelector('.product-option__selected-option--color');
                selectedColorInfo.innerText = colorValue;
            })
        )

        var productSizeOptions = document.querySelectorAll('.product-option__select-item--size');
        productSizeOptions.forEach(
            x => x.addEventListener('click', function(){
                productSizeOptions.forEach(
                    y => y.classList.remove('product-option__select-item--is-selected')
                )
                x.classList.add('product-option__select-item--is-selected');

                var sizeValue = x.getAttribute('value');

                var selectedSizeInfo = document.querySelector('.product-option__selected-option--size');
                selectedSizeInfo.innerText = sizeValue;
            })
        )
    </script>

    <script>
        var selectSizeGuide = document.querySelector('.product-detail__select-size-guide');
        var modal = document.querySelector('.modal');
        selectSizeGuide.addEventListener('click', function(){
            var selectSizeGuideModal = modal.querySelector('.select-size-guide-modal');

            modal.classList.remove('modal--close');
            selectSizeGuideModal.classList.remove('modal--close');
        })

        function closeCurrentModal(){
            modal.classList.add('modal--close');
            modalContainers.forEach(
                x => x.classList.add('modal--close')
            )
        }

        var modalCloseBtn = document.querySelector('.modal__close-btn');
        modalCloseBtn.addEventListener('click', closeCurrentModal);
        modal.addEventListener('click', closeCurrentModal);
        var modalContainers = modal.querySelectorAll('.modal__container');
        modalContainers.forEach(
            x => x.addEventListener('click', function(event){
                event.stopPropagation();
            })
        )
    </script>

    <script>
        var quantityControl = document.querySelector('.quantity__control');
        var quantityDisplay = document.querySelector('.quantity__display');
        
        var quantityReduce = document.querySelector('.quantity__reduce');
        quantityReduce.addEventListener('click', function(){
            var currentQuantity = parseInt(quantityControl.value);
            if(currentQuantity > 1){
                quantityControl.value = currentQuantity - 1;
                quantityDisplay.innerHTML = quantityControl.value;
            }
        })

        var quantityAugure = document.querySelector('.quantity__augure');
        quantityAugure.addEventListener('click', function(){
            var currentQuantity = parseInt(quantityControl.value);
            if(currentQuantity < 99){
                quantityControl.value = currentQuantity + 1;
                quantityDisplay.innerHTML = quantityControl.value;
            }
        })
    </script>
</body>
</html>