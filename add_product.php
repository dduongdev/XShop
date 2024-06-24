<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/toast.css">
    <link rel="stylesheet" href="../css/add_product_ui.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="app">
        <?php include 'toast.php'; ?>
        
        <header class="header">
            <div class="nav grid wide">
                <a href="../dashboard.php" class="nav__item">Dashboard</a>
            </div>
        </header>

        <div class="container grid wide">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="row product-form">
                <div class="col l-6">
                    <div class="row row--ud">
                        <input class="input_control js-product-name" placeholder="Tên sản phẩm" type="text">
                    </div>

                    <div class="row row--ud">
                        <input class="input_control js-unit-price" type="text" placeholder="Giá sản phẩm">
                    </div>

                    <div class="row row--ud">
                        <input class="input_control js-discount-percentage" type="text" placeholder="Phần trăm giảm giá">
                    </div>

                    <div class="row row--ud">
                        <span class="input_control">
                            <input class="js-main-img" type="file" name="" id="">
                        </span>
                    </div>

                    <div class="row row--ud">
                        <input class="input_control js-release-date" type="date" name="" id="">
                    </div>
                </div>

                <div class="col l-6">
                    <div class="row row--ud">
                        <textarea class="input_control input_control--textarea js-product-descs" name="" id="" placeholder="Mô tả sản phẩm. Lưu ý: Mỗi mô tả viết trên một dòng."></textarea>
                    </div>

                    <div class="row row--ud">
                        <div class="actions">
                            <button type="submit" class="input_control input_control--submit js-button-submit">Thêm</button>
                            <button class="input_control input_control--submit js-button-refresh">Làm mới</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <footer>

        </footer>
    </div>

    <script src="./js/toast.js"></script>
    <script>
        $(document).ready(function(){
            $('.js-button-submit').click(function(e) {
                e.preventDefault();

                var product_name = $('.js-product-name').val();
                var unit_price = $('.js-unit-price').val();
                var discount_percentage = $('.js-discount-percentage').val();
                var uploadedImage = $('.js-main-img')[0].files[0];
                var release_date = $('.js-release-date').val();
                var product_descs = $('.js-product-descs').val();
                var formData = new FormData();

                formData.append('file', uploadedImage);
                formData.append('product_name', product_name);
                formData.append('unit_price', unit_price);
                formData.append('discount_percentage', discount_percentage);
                formData.append('product_desc', JSON.stringify(product_descs.split('\n').map(line => line.trim())));
                formData.append('release_date', release_date);

                $.ajax({
                    url: './php/ajax_add_product.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status) {
                            toast({
                                title: 'Thông báo',
                                message: result.message,
                                type: 'success',
                                duration: 4000
                            });
                        } else {
                            toast({
                                title: 'Thông báo',
                                message: result.message,
                                type: 'warning',
                                duration: 4000
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        toast({
                            title: 'Lỗi',
                            message: 'Đã xảy ra lỗi trong quá trình xử lý.',
                            type: 'warning',
                            duration: 4000
                        });
                    }
                });
            });

            $('.js-button-refresh').click(function(e){
                e.preventDefault();

                $('.js-product-name').val('');
                $('.js-unit-price').val('');
                $('.js-discount-percentage').val('');
                $('.js-product-descs').val('');
                $('.js-release-date').val('');
                $('.js-main-img').val('');
            })
        })
    </script>
</body>
</html>