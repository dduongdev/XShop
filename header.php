<?php
    require_once './php/dbconnect.php';
    require_once './php/dbcommands.php';
?>

<header class="header">
    <div class="grid wide">
        <div class="header__top-bar">
            <p class="header__slogan font-weight-500">
                X-Shop: Your style, your Xperience!
            </p>

            <ul class="nav-main">
                <li class="nav-main__item nav-main__item--separate">
                    <a href="#" class="nav-main__link">
                        Về X-Shop
                    </a>
                </li>
                <li class="nav-main__item nav-main__item--separate">
                    <a href="#" class="nav-main__link">
                        Trung tâm CSKH
                    </a>
                </li>
                <?php
                    if(isset($_SESSION['username'])) {
                        echo '<li class="nav-main__item">
                                <a href="../user_view.php" class="nav-main__link font-weight-500">
                                    Chào '.$_SESSION['fullname'].'
                                </a>
                            </li>';
                    } else {
                        echo '<li class="nav-main__item nav-main__item--separate hidden_tag">
                                <a href="../register_page.php" class="nav-main__link font-weight-500">
                                    Đăng ký
                                </a>
                            </li>';
                        echo '<li class="nav-main__item hidden_tag">
                                <a href="../login_page.php" class="nav-main__link font-weight-500">
                                    Đăng nhập
                                </a>
                                </li>';
                    }
                ?>
            </ul>
        </div>

        <div class="header__inner">
            <a href="../index.php">
                <img src="../images/logo.png" alt="Logo" class="header__logo">
            </a>

            <ul class="nav-sub">
                <li class="nav-sub__item">
                    <a href="../index.php" class="nav-sub__link">
                        Trang chủ
                    </a>
                </li>
                <li class="nav-sub__item">
                    <a href="../products_page.php" class="nav-sub__link">
                        Sản phẩm
                    </a>
                </li>
            </ul>

            <div class="header__actions">
                <div class="header__action-item">
                    <form   action="../search_result.php"
                            role="search" 
                            class="header-searchbar" 
                            method="GET">
                        <label class="header-searchbar__main" for="header-searchbar__label-target">
                            <input type="text" name="keyword" class="header-searchbar___input" id="header-searchbar__label-target" placeholder="Search in X-Shop">
                            <button class="header-searchbar__search-button" value="submit" type="submit" name="submit">
                                <i class="header-searchbar__search-icon fa-solid fa-magnifying-glass"></i>
                            </button>
                        </label>
                    </form>
                </div>

                <div class="header__action-item header__action-item--has-notification-dialog">
                    <a href="#" class="header__action-link">
                        <i class="header__action-icon fa-solid fa-bell"></i>
                    </a>

                    <div class="header-dialog notification-dialog">
                        <div class="header-dialog__container">
                            <header class="header-dialog__header">
                                <p>Thông báo</p>
                            </header>
    
                            <ul class="header-dialog__list">
                                <li class="header-dialog__item">
                                    <a href="#" class="header-dialog__link">
                                        <span><img src="../images/logo.png" alt="" class="header-dialog__img"></span>
                                        <div class="header-dialog__info">
                                            <p class="header-dialog__info-title">
                                                Chào mừng sự ra đời của X-Shop 
                                            </p>
                                            <p class="header-dialog__info-desc">
                                                Sale 50% toàn sàn trong 2 ngày
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
    
                            <footer class="header-dialog__footer">
                                <a href="#" class="header-dialog_show-all-btn  ">
                                    Xem tất cả
                                </a>
                            </footer>
                        </div>
                    </div>
                </div>

                <div class="header__action-item header__action-item--has-cart-dialog">
                    <a href="../cart_page.php" class="header__action-link">
                        <i class="header__action-icon fa-solid fa-cart-shopping"></i>
                    </a>

                    <div class="header-dialog cart-dialog">
                        <div class="header-dialog__container">
                            <header class="header-dialog__header">
                                <p>Giỏ hàng</p>
                            </header>
    
                            <ul class="header-dialog__list">
                                <?php
                                    $cart_item_count = 0;
                                    if(isset($_SESSION['username'])){
                                        $stmt = $_conn->prepare($CART_QUERY_GET_ALL_OF_USER);
                                        $stmt->bind_param('s', $_SESSION['username']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $cart_item_count = $result->num_rows;

                                        while($row = $result->fetch_assoc()){
                                            echo '<li class="header-dialog__item">';
                                            echo '<a href="../product_detail_page.php/'.$row['slug'].'-'.$row['id'].'" class="header-dialog__link">';
                                            echo '<img src="'.$row['main_img'].'" alt="" class="header-dialog__img">';
                                            echo '<div class="header-dialog__info">';
                                            echo '<p class="header-dialog__info-title">'.$row['product_name'].'</p>';
                                            echo '<p class="cart-dialog__info-price">';
                                            if($row['discount_percentage'] > 0.0){
                                                echo '<span class="cart__item-current-price">'.(number_format($row['unit_price'] * (1 - $row['discount_percentage']), 0, ',', '.')).'đ</span>';
                                                echo '<span class="cart-dialog__info-old-price">'.number_format($row['unit_price'], 0, ',', '.').'đ</span>';
                                                echo '<span class="cart__item-discount">-'.($row['discount_percentage'] * 100).'%</span>';
                                            }
                                            else {
                                                echo '<span class="cart__item-current-price">'.(number_format($row['unit_price'], 0, ',', '.')).'đ</span>';
                                            }
                                            echo '</p>';

                                            echo '</div>';
                                            echo '</a>';
                                            echo '</li>';
                                        }
                                    }
                                    else {
                                        echo '<p class="cart-dialog__empty-message">Vui lòng đăng nhập để có thể sử dụng giỏ hàng.</p>';
                                    }
                                    
                                    if(isset($_SESSION['username']) && $cart_item_count == 0) {
                                        echo '<p class="cart-dialog__empty-message">Hãy lướt X-Shop và thêm vào giỏ hàng nhé <3</p>';
                                    }
                                ?>
                            </ul>
    
                            <footer class="header-dialog__footer cart-dialog__footer">
                                <span class="cart-dialog__desc">
                                    <span class="cart-dialog__product-cnt">
                                        <?php echo $cart_item_count; ?>
                                    </span>
                                    sản phẩm trong giỏ hàng
                                </span>

                                <a href="../cart_page.php" class="header-dialog_show-all-btn cart-dialog__show-all-btn">
                                    Xem tất cả
                                </a>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const header = document.querySelector('.header');
        let lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;
        window.addEventListener('scroll', function(event) {
            let currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (currentScrollTop > lastScrollTop) {
                header.classList.remove('header--slide-in');
                header.classList.add('header--fade-out');
            } else {
                header.classList.remove('header--fade-out');
                header.classList.add('header--slide-in');
            }
            lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
        });

        document.querySelector('.header-searchbar__search-button').addEventListener('click', function(event){
            event.preventDefault();

            let searchInput = document.getElementById('header-searchbar__label-target').value;
            let encodedSearchInput = encodeURIComponent(searchInput);
            let url = `../search_result.php?search=${encodedSearchInput}`;
            window.location.href = url;
        })
    </script>
</header>