<?php
    include_once './php/init_rating_stars.php';
    require_once './php/product_dao.php';
    require_once './php/color_dao.php';

    $product_id;
    $product_colors;
    $current_color_slug;
    $product_info;
    $unit_price;
    $discount_percentage;
    $images_of_product_color;
    $sizes_of_product_color;
    $rating;

    $url_parts = explode('-', $_SERVER['REQUEST_URI']);
    $lastPart = array_pop($url_parts);
    $product_id = explode('?', $lastPart)[0];

    if(isExistProduct($product_id)){
        $product_colors = getAllColorsOfProduct($product_id);
        $current_color_slug = array_key_first($product_colors);    
        
        $product_info = getProductInformation($product_id);
        $unit_price = $product_info['unit_price'];
        $discount_percentage = $product_info['discount_percentage'];
    
        $images_of_product_color = getAllImagesOfProductColor($product_id, $current_color_slug); 
    
        $sizes_of_product_color = getAllSizesOfColor($product_id, $current_color_slug);
    
        $rating = getGeneralRatingOfProduct($product_id);
    }
    else{
        header("HTTP/1.0 404 Not Found");
        echo "Page not found";
        exit();
    }
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
            <div class="grid wide">
                <section>
                    <div class="row">
                        <div class="col l-4 l-o-1">
                            <div class="product-detail__images">
                                <?php
                                    echo '<img src="'.$images_of_product_color[0].'" alt="" class="product-detail__main-image">';
                                ?>
        
                                <div class="product-detail__sub-images">
                                    <?php
                                        for($i=0; $i<count($images_of_product_color); $i++){
                                            if($i == 0){
                                                echo '<img class="product-detail__sub-image product-detail__sub-image--is-selected" src="'.$images_of_product_color[$i].'">';
                                            }
                                            else{
                                                echo '<img class="product-detail__sub-image" src="'.$images_of_product_color[$i].'">';
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
    
                        <div class="col l-6">
                            <div class="product-detail__container">
                                <p class="product-detail__title"><?php echo $product_info['product_name']; ?></p>

                                <div class="rating-score rating-score--product-detail">
                                    <?php echo initRatingStars($rating['rating_score']); ?>
                                    <span class="product-detail__rating-score">(<?php echo $rating['rating_score']; ?>)</span>
                                </div>
    
                                <div class="product-detail__price">
                                    <?php
                                        if($discount_percentage > 0){
                                            echo '<span class="product-detail__current-price">'.number_format($unit_price * (1-$discount_percentage), 0, ',', '.').'đ</span>';
                                            echo '<span class="product-detail__old-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
                                            echo '<span class="product-detail__discount">-'.($discount_percentage * 100).'%</span>';
                                        }
                                        else{
                                            echo '<span class="product-detail__current-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
                                        }
                                    ?>
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
                                            <span class="product-option__selected-option product-option__selected-option--color"><?php echo $product_colors[$current_color_slug]['color_name']; ?></span>
                                        </div>
                                        
                                        <div class="product-option__select product-option__select--color-select">
                                            <?php
                                                foreach($product_colors as $key => $value){
                                                    $uid = uniqid('product-option_', true);
                                                    if(strcasecmp($key, $current_color_slug) == 0){
                                                        echo '<label for="'.$uid.'" class="product-option__select-item product-option__select-item--color product-option__select-item--is-selected" color-value="'.$value['color_name'].'">';
                                                        echo '<input type="radio" class="hidden_tag" name="color" value="'.$key.'" id="'.$uid.'" checked>';
                                                    }
                                                    else {
                                                        echo '<label for="'.$uid.'" class="product-option__select-item product-option__select-item--color" color-value="'.$value['color_name'].'">';
                                                        echo '<input type="radio" class="hidden_tag" name="color" value="'.$key.'" id="'.$uid.'">';
                                                    }
                                                    echo '<span style="background-image: url('.$value['img'].');"></span>';
                                                    echo '</label>';
                                                }
                                            ?>
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
                                            <?php 
                                                foreach($sizes_of_product_color as $key => $value){
                                                    $uid = uniqid('product-option_', true);
                                                    echo '<label for="'.$uid.'" class="product-option__select-item product-option__select-item--size">';
                                                    echo $value['size_name'];
                                                    echo '<input type="radio" class="hidden_tag" name="size" value="'.$key.'" size-value="'.$value['size_name'].'" id="'.$uid.'">';
                                                    echo '</label>';
                                                }   
                                            ?>
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
    
                                            <span class="quantity__quantity-remaining hidden_tag">
                                                <span class="quantity__quantity-remaining-value"></span>
                                                sản phẩm có sẵn
                                            </span>
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
                                    <?php 
                                        foreach(json_decode($product_info['product_desc'], true) as $line){
                                            echo '<p class="product-detail__description-item">'.$line.'</p>';
                                        }
                                    ?>
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
                                <span class="overall-rating__score"><?php echo $rating['rating_score']; ?></span>
                                <div class="rating-score rating-score--overall-rating">
                                    <?php echo initRatingStars($rating['rating_score']); ?>
                                </div>
                                <span class="overall-rating__count"><?php echo $rating['rating_count'] ?> lượt đánh giá</span>
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
        <?php
            echo 'var product_id = '.$product_id.';';
            echo 'var sizes_data = '.json_encode($sizes_of_product_color).';';
        ?>
    </script>

    <script>
        $(document).ready(function(){
            $('input[name="color"]').change(function(){
                var color_slug = $('input[name="color"]:checked').val();
                var action = 'product_detail_change';

                $.ajax({
                    type: 'post',
                    url: '../php/ajax_response.php',
                    dataType: 'json',
                    data: {
                        action, product_id, color_slug
                    }
                }).done(function(response){
                    $('.product-detail__main-image').attr('src', response.main_image);
                    $('.product-detail__sub-images').html(response.images);
                    $('.product-option__select--size-select').html(response.sizes);

                    sizes_data = response.sizes_data;
                    $('.quantity__quantity-remaining').addClass('hidden_tag');
                    $('.product-option__selected-option--size').text('');
                })
            })

            $('.product-option__select-item--color').click(function(){
                $('.product-option__select-item--color').removeClass('product-option__select-item--is-selected');
                $(this).addClass('product-option__select-item--is-selected');
                $('.product-option__selected-option--color').text($(this).attr('color-value'));
            })

            $('.quantity__augure').click(function(){
                var currentValue = Number($('.quantity__control').val());
                var selectedSize = $('input[name="size"]:checked').val();
                if(currentValue + 1 <= sizes_data[selectedSize].remaining_quantity){
                    $('.quantity__control').val(currentValue + 1);
                    $('.quantity__display').text(currentValue + 1);
                }
            })

            $('.quantity__reduce').click(function(){
                var currentValue = Number($('.quantity__control').val());
                if(currentValue - 1 >= 1){
                    $('.quantity__control').val(currentValue - 1);
                    $('.quantity__display').text(currentValue - 1);
                }
            })
        })

        $(document).on('click', '.product-option__select-item--size', function(e){
            $('.product-option__select-item--size').removeClass('product-option__select-item--is-selected');
            $(this).addClass('product-option__select-item--is-selected');
        })

        $(document).on('click', '.product-detail__sub-image', function(){
            $('.product-detail__sub-image').removeClass('product-detail__sub-image--is-selected');
            $(this).addClass('product-detail__sub-image--is-selected');
            $('.product-detail__main-image').attr('src', $(this).attr('src'));
        })

        $(document).on('change', 'input[name="size"]', function(){
            $('.product-option__selected-option--size').text($(this).attr('size-value'));
            
            $('.quantity__control').val(1);
            $('.quantity__display').text(1);

            $('.quantity__quantity-remaining').removeClass('hidden_tag');
            $('.quantity__quantity-remaining-value').text(sizes_data[$(this).val()].remaining_quantity);
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
</body>
</html>