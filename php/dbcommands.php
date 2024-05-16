<?php
    $SIZE_QUERY_GET_ALL = "SELECT * FROM sizes";

    $COLOR_QUERY_GET_ALL = "SELECT * FROM colors";
    $COLOR_QUERY_GET_COLOR_OF_PRODUCT = "SELECT colors.color_name, colors.slug, colors.img
                                            FROM products_color JOIN colors
                                            ON products_color.color_id = colors.id
                                            WHERE products_color.product_id = ?";

    $PRODUCT_QUERY_GET_PRODUCT_CARD_INFO = "SELECT id, product_name, main_img, unit_price, discount_percentage, slug
                                            FROM products
                                            ORDER BY Rand()";
    $PRODUCT_QUERY_GET_RATING_SCORE = "SELECT COALESCE((SUM(rating) + 5)/(COUNT(*) + 1), 5) AS rating_score, COUNT(feedbacks.id) AS rating_count
                                        FROM products LEFT JOIN feedbacks
                                        ON products.id = feedbacks.product_id
                                        WHERE products.id = ?
                                        GROUP BY products.id";
    $PRODUCT_QUERY_GET_PRODUCT_COLORS = "SELECT products_color.id AS product_color_id, colors.slug
                                            FROM products_color JOIN colors
                                            ON products_color.color_id = colors.id
                                            WHERE products_color.product_id = ? && colors.id = ";
    $PRODUCT_QUERY_GET_PRODUCT_COLOR_IMAGES = "SELECT product_color_img
                                                FROM products_color_picture 
                                                WHERE product_color_id = ?";
    $PRODUCT_QUERY_GET_PRODUCT_SIZES = "SELECT products_size.id AS product_size_id, size_name, remaining_quantity, sold_quantity
                                        FROM products_size JOIN sizes
                                        ON products_size.size_id = sizes.id
                                        WHERE products_size.product_color_id = ?";
    $PRODUCT_QUERY_GET_PRODUCT_INFORMATION = "SELECT product_name, unit_price, discount_percentage, product_desc
                                                FROM products
                                                WHERE id = ?";

    $PRODUCT_QUERY_GET_ALL_COLORS = "SELECT color_name, img, slug
                                    FROM products_color JOIN colors
                                    ON products_color.color_id = colors.id
                                    WHERE products_color.product_id = ?";
    $PRODUCT_QUERY_GET_ALL_IMAGES_OF_COLOR = "SELECT product_color_img
                                                FROM products_color JOIN products_color_picture
                                                ON products_color.id = products_color_picture.product_color_id
                                                JOIN colors
                                                ON colors.id = products_color.color_id
                                                WHERE products_color.product_id = ? AND colors.slug = ?";
    $PRODUCT_QUERY_GET_ALL_SIZES_OF_COLOR = "SELECT products_size.id AS product_id, size_name, remaining_quantity, sold_quantity
                                            FROM products_size JOIN products_color
                                            ON products_size.product_color_id = products_color.id
                                            JOIN sizes
                                            ON products_size.size_id = sizes.id
                                            JOIN colors
                                            ON products_color.color_id = colors.id
                                            WHERE products_color.product_id = ? AND colors.slug = ?";
    
?>