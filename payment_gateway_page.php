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

        <div class="container container--payment-gateway">
            <div class="grid wide">
                <form action="" class="payment-gateway__form">
                    <div class="row payment-gateway__form-row">
                        <div class="payment-gateway__session col l-6 l-o-3">
                            <div class="payment-gateway__heading">
                                Thông tin vận chuyển
                            </div>
            
                            <div class="payment-gateway__control-container">
                                <div class="row payment-gateway__form-row">
                                    <div class="col l-6">
                                        <input type="text" name="full_name" placeholder="Họ tên" class="payment-gateway__form-control">
                                    </div>
        
                                    <div class="col l-6">
                                        <input type="tel" name="phone" placeholder="Số điện thoại" class="payment-gateway__form-control">
                                    </div>
                                </div>
        
                                <div class="row payment-gateway__form-row">
                                    <div class="col l-12">
                                        <input type="email" name="email" placeholder="Email" class="payment-gateway__form-control">
                                    </div>
                                </div>
        
                                <div class="row payment-gateway__form-row">
                                    <div class="col l-12">
                                        <input type="text" name="address" placeholder="Địa chỉ (ví dụ: 170 An Dương Vương, phường Nguyễn Văn Cừ)" autocomplete="off" class="payment-gateway__form-control">
                                    </div>
                                </div>
        
                                <div class="row payment-gateway__form-row">
                                    <div class="col l-4">
                                        <select class="payment-gateway__form-control" id="payment-gateway__province-select" onchange="populateCities()">
                                            <option value="">Tỉnh/Thành phố</option>
                                            <option value="Hanoi">Hà Nội</option>
                                            <option value="HCMC">Hồ Chí Minh</option>
                                            <option value="BinhDinh">Bình Định</option>
                                        </select>
                                    </div>
        
                                    <div class="col l-4">
                                        <select class="payment-gateway__form-control" id="payment-gateway__district-select" onchange="populateDistricts()">
                                            <option value="">Quận/Huyện</option>
                                        </select>
                                    </div>
        
                                    <div class="col l-4">
                                        <select class="payment-gateway__form-control" id="payment-gateway__commune-select">
                                            <option value="">Thị trấn/Xã</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="row payment-gateway__form-row">
                                    <div class="col l-12">
                                        <input type="text" name="cnote" placeholder="Ghi chú thêm (Ví dụ: Giao hàng giờ hành chính)" class="payment-gateway__form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row payment-gateway__form-row">
                        <div class="payment-gateway__session col l-6 l-o-3">
                            <div class="payment-gateway__heading">
                                Hình thức thanh toán
                            </div>

                            <div class="payment-gateway__control-container">
                                <div class="row payment-gateway__form-row">
                                    <div class="col l-12">
                                        <label for="payment-COD" class="payment-gateway__form-control payment-gateway__form-control--payment-method">
                                            <span class="payment-gateway__custom-radio">
                                                <input type="radio" id="payment-COD" name="payment-method" autocomplete="off" value="COD">
                                                <span class="payment-gateway__custom-radio-checkmark"></span>
                                            </span>
        
                                            <span class="payment-method__item-icon-wrapper">
                                                <img src="./images/icons/COD.svg" alt="COD <br> Thanh toán khi nhận hàng">
                                            </span>
        
                                            <span class="payment-method__item-name">
                                                COD
                                                <br>
                                                Thanh toán khi nhận hàng
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row payment-gateway__form-row">
                                    <div class="col l-12">
                                        <label for="payment-momo" class="payment-gateway__form-control payment-gateway__form-control--payment-method">
                                            <span class="payment-gateway__custom-radio">
                                                <input type="radio" id="payment-momo" name="payment-method" autocomplete="off" value="momo">
                                                <span class="payment-gateway__custom-radio-checkmark"></span>
                                            </span>
        
                                            <span class="payment-method__item-icon-wrapper">
                                                <img src="./images/icons/momo-icon.png" alt="Thanh Toán MoMo">
                                            </span>
        
                                            <span class="payment-method__item-name">
                                                Thanh Toán MoMo
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row payment-gateway__form-row">
                                    <div class="col l-12">
                                        <label for="payment-vietqr" class="payment-gateway__form-control payment-gateway__form-control--payment-method">
                                            <span class="payment-gateway__custom-radio">
                                                <input type="radio" id="payment-vietqr" name="payment-method" autocomplete="off" value="vietqr">
                                                <span class="payment-gateway__custom-radio-checkmark"></span>
                                            </span>
        
                                            <span class="payment-method__item-icon-wrapper">
                                                <img src="./images/icons/icon-vietqr.svg" alt="Quét QR & Thanh toán bằng ứng dụng ngân hàng<br/>Mờ ứng dụng ngân hàng để thanh toán">
                                            </span>
        
                                            <span class="payment-method__item-name">
                                                Quét QR & Thanh toán bằng ứng dụng ngân hàng
                                                <br>
                                                Mờ ứng dụng ngân hàng để thanh toán
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row payment-gateway__form-row">
                                    <div class="col l-12">
                                        <label for="payment-flex_money" class="payment-gateway__form-control payment-gateway__form-control--payment-method">
                                            <span class="payment-gateway__custom-radio">
                                                <input type="radio" id="payment-flex_money" name="payment-method" autocomplete="off" value="flex_money">
                                                <span class="payment-gateway__custom-radio-checkmark"></span>
                                            </span>
        
                                            <span class="payment-method__item-icon-wrapper">
                                                <img src="./images/icons/mceclip1_21.png" alt="">
                                            </span>
        
                                            <span class="payment-method__item-name">
                                                Chuyển khoản liên ngân hàng bằng QR Code
                                                <br>
                                                Chuyển tiền qua ví điện tử (MoMo, Zalopay,...)
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row payment-gateway__form-row">
                        <div class="col l-6 l-o-3">
                            <button type="submit" class="payment-gateway__form-submit-btn">Thanh toán</button>
                        </div>
                    </div>
                </form>
            </div>     
        </div>

        <?php include "footer.php" ?>
    </div>
</body>
</html>