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

            <form action="">

                <div class="row">

                    <div class="col">

                        <h3 class="title">Thông tin vận chuyển</h3>

                        <div class="flex">
                            <div class="inputBox">
                                <input type="text" placeholder="Họ tên">
                            </div>

                            <div class="inputBox">
                                <input type="text" placeholder="Số điện thoại">
                            </div>
                        </div>

                        <div class="inputBox">
                            <input type="email" placeholder="Email">
                        </div>

                        <div class="inputBox">
                            <input type="text" placeholder="Địa chỉ (ví dụ: 30 Hoàng Văn Thụ, phường Quang Trung)">
                        </div>

                        <div class="inputBox">
                            <input type="text" placeholder="Ghi chú thêm (Ví dụ: Giao hàng giờ hành chính)">
                        </div>

                    </div>

                    <div class="col">
                        <h3 class="title">Hình thức thanh toán</h3>
                        
                        <div class="payment-shipping">
                            <form action="">
                                <div class="mgb--20">
                                    <label for="payment-COD" class="payment-method__item active">
                                        <span class="payment-method__item-custom-checkbox custom-radio">
                                            <input type="radio" id="payment-COD" name="payment-method" autocomplete="off" value="COD">
                                            <span class="checkmark"></span>
                                        </span>
                                        <span class="payment-method__item-icon-wrapper">
                                            <img src="https://www.coolmate.me/images/COD.svg" alt="COD - Thanh toán khi nhận hàng">
                                        </span>
                                        <span class="payment-method__item-name">
                                            COD
                                            <br>
                                            Thanh toán khi nhận hàng
                                        </span>
                                    </label>
                                </div>

                                <div class="mgb--20">
                                    <label for="payment-momo" class="payment-method__item active">
                                        <span class="payment-method__item-custom-checkbox custom-radio">
                                            <input type="radio" id="payment-momo" name="payment-method" autocomplete="off" value="momo">
                                            <span class="checkmark"></span>
                                        </span>
                                        <span class="payment-method__item-icon-wrapper">
                                            <img src="https://www.coolmate.me/images/momo-icon.png" alt="Thanh Toán MoMo">
                                        </span>
                                        <span class="payment-method__item-name">Thanh Toán MoMo</span>
                                    </label>
                                </div>

                                <div class="mgb--20">
                                    <label for="payment-flex_money" class="payment-method__item active">
                                        <span class="payment-method__item-custom-checkbox custom-radio">
                                            <input type="radio" id="payment-flex_money" name="payment-method" autocomplete="off" value="flex_money">
                                            <span class="checkmark"></span>
                                        </span>
                                        <span class="payment-method__item-icon-wrapper">
                                            <img src="https://mcdn.coolmate.me/image/April2023/mceclip1_21.png" alt="Chuyển khoản liên ngân hàng bằng QR Code <br> Chuyển tiền qua ví điện tử (MoMo, Zalopay,...)">
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

                    </div>
            
                </div>

                <input type="submit" value="proceed to checkout" class="submit-btn">

            </form>

        </div>  

        <?php include "footer.php" ?>
    </div>
</body>
</html>