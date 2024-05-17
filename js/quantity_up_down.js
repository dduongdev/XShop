var quantityReduceButtons = document.querySelectorAll('.quantity__reduce');
quantityReduceButtons.forEach(function(button){
    button.addEventListener('click', function(){
        var quantity = button.closest('.quantity-change');
        var quantityControl = quantity.querySelector('.quantity__control');
        var quantityDisplay = quantity.querySelector('.quantity__display');
        var currentQuantity = parseInt(quantityControl.value);
        if(currentQuantity > 1){
            quantityControl.value = currentQuantity - 1;
            quantityDisplay.innerHTML = quantityControl.value;
        }
    })
})

var quantityAugureButtons = document.querySelectorAll('.quantity__augure');
quantityAugureButtons.forEach(function(button){
    button.addEventListener('click', function(){
        var quantity = button.closest('.quantity-change');
        var quantityControl = quantity.querySelector('.quantity__control');
        var quantityDisplay = quantity.querySelector('.quantity__display');
        var currentQuantity = parseInt(quantityControl.value);
        if(currentQuantity < 5){
            quantityControl.value = currentQuantity + 1;
            quantityDisplay.innerHTML = quantityControl.value;
        }
    })
})

// $('.quantity__reduce').click(function(){
//     var product_size_id = $('input[name="size"]').val();

// })