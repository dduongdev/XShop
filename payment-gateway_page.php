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
            <div class="cart-section">
                <div class="title">Thông tin vận chuyển</div>
                <div id="customer-info-block">
                    <div class="grid grid-name-phone">
                        <div class="grid__column six-twelfths">
                            <input type="text" name="full_name" placeholder="Họ tên" class="form-control">
                        </div>
                        <div class="grid__column six-twelfths">
                            <input type="tel" name="phone" placeholder="Số điện thoại" class="form-control">
                        </div>
                    </div>
                    <div class="grid">
                        <div class="grid__column">
                            <input type="email" name="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="grid__column">
                            <div class="address-block">
                                <input type="text" name="address" placeholder="Địa chỉ (ví dụ: 170 An Dương Vương, phường Nguyễn Văn Cừ)" autocomplete="off" class="form-control">
                                <!-- START: TEST THE DROPDOWNS -->
                                <select id="province" name="province" class="form-control">
                                    <option value="">Tỉnh/Thành phố</option>
                                    <!-- Populate with provinces/cities -->
                                </select>
                                <select id="ward" name="ward" class="form-control">
                                    <option value="">Quận/Huyện</option>
                                    <!-- Populated dynamically based on province/city selection -->
                                </select>
                                <select id="town" name="town" class="form-control">
                                    <option value="">Thị trấn/Xã</option>
                                    <!-- Populated dynamically based on ward/district selection -->
                                </select>
                                <!-- END: TEST THE DROPDOWNS -->
                            </div>
                        </div>
                    </div>
                    <div class="grid"></div>
                    <div class="grid">
                        <div class="grid__column">
                            <input type="text" name="cnote" placeholder="Ghi chú thêm (Ví dụ: Giao hàng giờ hành chính)" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-section cart-payment-scroll">
                <div class="title">Hình thức thanh toán</div>
                <div class="payment-shipping">
                    <form action="">
                        <div class="mgb--20">
                            <label for="payment-COD" class="payment-method__item">
                                <span class="payment-method__item-custom-checkbox custom-radio">
                                    <input type="radio" id="payment-COD" name="payment-method" autocomplete="off" value="COD">
                                    <span class="checkmark"></span>
                                </span>

                                <span class="payment-method__item-icon-wrapper">
                                    <img src="https://www.coolmate.me/images/COD.svg" alt="COD <br> Thanh toán khi nhận hàng">
                                </span>

                                <span class="payment-method__item-name">
                                    COD
                                    <br>
                                    Thanh toán khi nhận hàng
                                </span>
                            </label>
                        </div>

                        <div class="mgb--20">
                            <label for="payment-momo" class="payment-method__item">
                                <span class="payment-method__item-custom-checkbox custom-radio">
                                    <input type="radio" id="payment-momo" name="payment-method" autocomplete="off" value="momo">
                                    <span class="checkmark"></span>
                                </span>

                                <span class="payment-method__item-icon-wrapper">
                                    <img src="https://www.coolmate.me/images/momo-icon.png" alt="Thanh Toán MoMo">
                                </span>

                                <span class="payment-method__item-name">
                                    Thanh Toán MoMo
                                </span>
                            </label>
                        </div>
                        <div class="mgb--20">
                            <label for="payment-vietqr" class="payment-method__item">
                                <span class="payment-method__item-custom-checkbox custom-radio">
                                    <input type="radio" id="payment-vietqr" name="payment-method" autocomplete="off" value="vietqr">
                                    <span class="checkmark"></span>
                                </span>

                                <span class="payment-method__item-icon-wrapper">
                                    <img src="https://gateway.zalopay.vn/image/emvco/icon-vietqr.svg" alt="Quét QR & Thanh toán bằng ứng dụng ngân hàng<br/>Mờ ứng dụng ngân hàng để thanh toán">
                                </span>

                                <span class="payment-method__item-name">
                                    Quét QR & Thanh toán bằng ứng dụng ngân hàng
                                    <br>
                                    Mờ ứng dụng ngân hàng để thanh toán
                                </span>
                            </label>
                        </div>
                        <div class="mgb--20">
                            <label for="payment-flex_money" class="payment-method__item">
                                <span class="payment-method__item-custom-checkbox custom-radio">
                                    <input type="radio" id="payment-flex_money" name="payment-method" autocomplete="off" value="flex_money">
                                    <span class="checkmark"></span>
                                </span>

                                <span class="payment-method__item-icon-wrapper">
                                    <img src="https://mcdn.coolmate.me/image/April2023/mceclip1_21.png" alt="Chuyển khoản liên ngân hàng bằng QR Code<br>Chuyển tiền qua ví điện tử (MoMo, Zalopay,...)">
                                </span>

                                <span class="payment-method__item-name">
                                    Chuyển khoản liên ngân hàng bằng QR Code
                                    <br>
                                    Chuyển tiền qua ví điện tử (MoMo, Zalopay,...)
                                </span>
                            </label>
                        </div>
                    </form>
                </div>
                <p class="cart-return-text">
                    
                    Nếu bạn không hài lòng với sản phẩm của chúng tôi? Bạn
                    hoàn toàn có thể trả lại sản phẩm. Tìm hiểu thêm
                    <a href="https://www.coolmate.me/page/chinh-sach-doi-tra" target="_blank">
                        <b>tại đây!</b>
                    </a>
                </p>
                <button class="checkout-btn">
                    Thanh toán
                    <span>884k</span>
                    <span>(MoMo)</span>
                    <span> - Đổi trả 60 ngày</span>
                </button>
            </div>
        </div> 

        <?php include "footer.php" ?>
    </div>
</body>
</html>