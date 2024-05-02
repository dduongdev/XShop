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
                <div class="row">
                    <div class="col l-5">
                        <div class="product-detail__images">
                            <img class="product-detail__main-image" src="./images/products/polo_active_premium_gray.jpg" alt="">

                            <div class="product-detail__sub-images">
                                <img class="product-detail__sub-image" src="./images/products/polo_active_premium_gray.jpg" alt="Gray">
                                <img class="product-detail__sub-image" src="./images/products/polo_active_premium_black.jpg" alt="Black">
                            </div>
                        </div>
                    </div>

                    <div class="col l-7">
                        <div class="product_detail__content">
                            <p class="product-detail__title">Áo Polo Nam Cafe Bo Kẻ</p>
                            <p class="product-detail__short-desc">
                                <span class="product-detail__sub-title">Exdry</span>
                                 / 
                                <span class="product-detail__color-info"></span>
                            </p>
                        
                            <div class="product-detail__ratings">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star-half-stroke"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>

                            <div class="product-detail__price">
                                <span class="product-detail__current-price">449.000đ</span>
                                <span class="product-detail__old-price">499.000đ</span>
                                <span class="product-detail__discount">-10%</span>
                            </div>
                            
                            <div class="product-detail__policy">
                                <div class="row">
                                    <div class="product-detail__policy-item col l-6">
                                        <i class="fa-solid fa-right-left product-detail__policy-icon"></i>
                                        <span class="product-detail__policy-content">Đổi trả miễn phí trong vòng 15 ngày</span>
                                    </div>
                                    
                                    <div class="product-detail__policy-item col l-6">
                                        <i class="fa-solid fa-arrow-rotate-left product-detail__policy-icon"></i>
                                        <span class="product-detail__policy-content">Đổi trả cực dễ chỉ cần số điện thoại</span>
                                    </div>

                                    <div class="product-detail__policy-item col l-6">
                                        <i class="fa-solid fa-phone product-detail__policy-icon"></i>
                                        <span class="product-detail__policy-content">Hotline 0385.216.798 hỗ trợ từ 8h30 - 22h mỗi ngày</span>
                                    </div>
    
                                </div>
                            </div>

                            <form action="">
                                <div class="product-detail__select-color">
                                    <div class="product-detail__select-color-header">
                                        <p class="product-detail__selected-color">Màu sắc: <span></span></p>
                                    </div>
    
                                    <div class="product-detail__options-color">
                                        <button class="product-detail__color" name="color" value="Gray">
                                            <span style="background-image: url(./images/product_colors/gray.jpg);"></span>
                                        </button>
    
                                        <button class="product-detail__color" name="color" value="Black">
                                            <span style="background-image: url(./images/product_colors/black.jpg);"></span>
                                        </button>
                                    </div>
                                </div>

                                <div class="product-detail__select-size">
                                    <div class="product-detail__select-size-header">
                                        <div class="product-detail__selected-size">
                                            Kích thước: 
                                            <span></span>
                                        </div>
                                        <span class="product-detail__select-size-guide">
                                            Hướng dẫn chọn size
                                        </span>
                                    </div>

                                    <div class="product-detail__options-size">
                                        <button class="product-detail__size">
                                            S
                                        </button>
                                        
                                        <button class="product-detail__size">
                                            M
                                        </button>
                                        
                                        <button class="product-detail__size">
                                            L
                                        </button>

                                        <button class="product-detail__size">
                                            XL
                                        </button>

                                        <button class="product-detail__size">
                                            2XL
                                        </button>

                                        <button class="product-detail__size">
                                            3XL
                                        </button>

                                    </div>
                                </div>

                                <div class="product-detail__select-quantity">
                                    <div class="product-detail__select-quantity-header">
                                        <p class="product-detail__select-quantity-heading">Số lượng</p>
                                    </div>
                                    <div class="quantity-change">
                                        <span class="quantity__reduce">-</span>
                                        <span class="quantity__display">1</span>
                                        <input type="number" value="1" min="1" max="99" class="quantity__control">
                                        <span class="quantity__augure">+</span>
                                    </div>

                                    <p class="quantity__quantity-remaining">7749 sản phẩm có sẵn</p>
                                </div>

                                <div class="product-detail__actions">
                                    <button class="product-detail__actions-item product-detail__add-to-cart-btn">Thêm vào giỏ hàng</button>
                                    <button class="product-detail__actions-item product-detail__buy-btn">Mua ngay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
        var subImages = document.querySelectorAll('.product-detail__sub-image');
        subImages.forEach(function(img){
            img.addEventListener('click', function(){
                var mainImage = document.querySelector('.product-detail__main-image');
                mainImage.src = productImgMatchWithColor[this.alt];

                var colorInfo = document.querySelector('.product-detail__color-info');
                colorInfo.innerText = this.alt;
            })
            img.addEventListener('click', function(){
                subImages.forEach(function(img){
                    img.classList.remove('product-detail__sub-image--is-selected');
                })
                this.classList.add('product-detail__sub-image--is-selected');
            })
        })

        var productImgMatchWithColor = {
            Gray: './images/products/polo_active_premium_gray.jpg',
            Black: './images/products/polo_active_premium_black.jpg'
        };

        var colorButtons = document.querySelectorAll('.product-detail__color');
        colorButtons.forEach(function(button){
            button.addEventListener('click', function(){
                var mainImage = document.querySelector('.product-detail__main-image');
                mainImage.src = productImgMatchWithColor[this.value];

                var colorInfo = document.querySelector('.product-detail__color-info');
                colorInfo.innerText = this.value;

                var selectedColor = document.querySelector('.product-detail__selected-color');
                selectedColor.querySelector('span').innerText = this.value;
            })
            button.addEventListener('click', function(){
                colorButtons.forEach(function(button){
                    button.classList.remove('product-detail__color--is-selected');
                })
                this.classList.add('product-detail__color--is-selected');
            })
        })
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