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
            <div class="payment-gateway">
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
                                <input type="text" name="address" placeholder="Địa chỉ (ví dụ: 170 An Dương Vương, phường Nguyễn Văn Cừ)" autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class="grid grid__selected">
                            <select class="selectedBox" id="provinceSelect" onchange="populateCities()">
                                <option value="">Tỉnh/Thành phố</option>
                                <option value="Hanoi">Hà Nội</option>
                                <option value="HCMC">Hồ Chí Minh</option>
                                <option value="BinhDinh">Bình Định</option>
                            </select>

                            <select class="selectedBox" id="citySelect" onchange="populateDistricts()">
                                <option value="">Quận/Huyện</option>
                            </select>

                            <select class="selectedBox" id="districtSelect">
                                <option value="">Thị trấn/Xã</option>
                            </select>
                        </div>
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
        </div>

        <?php include "footer.php" ?>
    </div>

    <script>
        // Dữ liệu về các thành phố và quận/huyện
        var cityData = {
            "Hanoi": {
                "Ba Đình": ["Phúc Xá", "Ngọc Hà", "Kim Mã"],
                "Hoàn Kiếm": ["Phan Chu Trinh", "Cửa Nam", "Hàng Bạc"],
                // Thêm dữ liệu cho các quận/huyện khác
            },
            "HCMC": {
                "Quận 1": ["Phường Bến Nghé", "Phường Cô Giang", "Phường Cầu Ông Lãnh"],
                "Quận 2": ["Phường An Phú", "Phường Thảo Điền", "Phường Bình An"],
                // Thêm dữ liệu cho các quận/huyện khác
            },
            "BinhDinh": {
                "Quận 2": ["Phường Bến Nghé", "Phường Cô Giang", "Phường Cầu Ông Lãnh"],
                "Quận 3": ["Phường An Phú", "Phường Thảo Điền", "Phường Bình An"],
                // Thêm dữ liệu cho các quận/huyện khác
            }
        };

        // Hàm để điền danh sách các thành phố dựa trên lựa chọn của tỉnh/thành phố
        function populateCities() {
            var provinceSelect = document.getElementById("provinceSelect");
            var citySelect = document.getElementById("citySelect");
            var selectedProvince = provinceSelect.value;

            // Xóa tất cả các option hiện có trong danh sách thành phố
            citySelect.innerHTML = "<option value=''>Chọn thành phố</option>";

            // Nếu người dùng đã chọn một tỉnh/thành phố
            if (selectedProvince !== "") {
                var cities = Object.keys(cityData[selectedProvince]);
                // Thêm các thành phố tương ứng vào danh sách
                for (var i = 0; i < cities.length; i++) {
                    var option = document.createElement("option");
                    option.textContent = cities[i];
                    option.value = cities[i];
                    citySelect.appendChild(option);
                }
            }
        }

        // Hàm để điền danh sách các quận/huyện dựa trên lựa chọn của thành phố
        function populateDistricts() {
            var provinceSelect = document.getElementById("provinceSelect");
            var citySelect = document.getElementById("citySelect");
            var districtSelect = document.getElementById("districtSelect");
            var selectedProvince = provinceSelect.value;
            var selectedCity = citySelect.value;

            // Xóa tất cả các option hiện có trong danh sách quận/huyện
            districtSelect.innerHTML = "<option value=''>Chọn quận/huyện</option>";

            // Nếu người dùng đã chọn một tỉnh/thành phố và một quận/huyện
            if (selectedProvince !== "" && selectedCity !== "") {
                var districts = cityData[selectedProvince][selectedCity];
                // Thêm các thị trấn/xã tương ứng vào danh sách
                for (var i = 0; i < districts.length; i++) {
                    var option = document.createElement("option");
                    option.textContent = districts[i];
                    option.value = districts[i];
                    districtSelect.appendChild(option);
                }
            }
        }
    </script>
</body>
</html>