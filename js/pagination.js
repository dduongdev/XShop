let currentPage = 1
let totalPage = (products_data.length % itemsPerPageCount == 0) ? products_data.length / itemsPerPageCount : Math.ceil(products_data.length / itemsPerPageCount);
let itemsPerPage = products_data.slice((currentPage - 1) * itemsPerPageCount, (currentPage - 1) * itemsPerPageCount + itemsPerPageCount);
renderProductData(container_html);

function handlePagination(pageNumber) {
    currentPage = pageNumber;
    itemsPerPage = products_data.slice((currentPage - 1) * itemsPerPageCount, (currentPage - 1) * itemsPerPageCount + itemsPerPageCount);
    renderProductData(container_html);
}

function renderProductData(container_html) {
    let element = '';
    itemsPerPage.map(value => {
        element += `
            <div class="col l-2-4">
                <a class="product-card" href="../product_detail_page.php/${value[5]}-${value[0]}">
                    <div class="product-card__img" style="background-image: url(${value[2]});"></div>
                    <div class="product-card__content">
                        <p class="product-card__title">${value[1]}</p>
                        <div class="rating-score rating-score--product-card">
                            ${renderRatingStars(parseFloat(value[6]))}
                            <span class="product-detail__rating-score">(${value[6]})</span>
                        </div>
                        <div class="product-card__price">
                            ${renderProductPrice(parseFloat(value[3]), parseFloat(value[4]))}
                        </div>
                    </div>
                </a>
            </div>
        `;
    });
    $(container_html).html(element);
}

function renderProductPrice(unit_price, discount_percentage) {
    let result = '';
    if (discount_percentage > 0.0) {
        var new_price = unit_price * (1 - discount_percentage);
        result += `<span class="product-card__current-price">${new_price.toLocaleString('de-DE')}đ</span>`;
        result += `<span class="product-card__old-price">${unit_price.toLocaleString('de-DE')}đ</span>`;
        result += `<span class="product-card__discount">-${discount_percentage * 100}%</span>`;
    } else {
        result += `<span class="product-card__current-price">${unit_price.toLocaleString('de-DE')}đ</span>`;
    }
    return result;
}

function renderRatingStars(rating_score){
    let result = '';
    var i = 1;
    for(; i <= Math.floor(rating_score); i++){
        result += `<div class="rating-score__star is-active"></div>`;
    }

    if(rating_score > Math.floor(rating_score)){
        result += `<div class="rating-score__star is-half"></div>`;
        i++;
    }

    for(; i <= 5; i++){
        result += `<div class="rating-score__star is-neutral"></div>`;
    }

    return result;
}