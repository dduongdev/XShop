const toast_icons = {
    success: "fa-solid fa-circle-check",
    info: "fa-solid fa-circle-check",
    warning: "fa-solid fa-circle-exclamation",
    danger: "fa-solid fa-circle-exclamation"
}

function toast({
    title = '',
    message = '',
    type = 'info',
    duration = 4000
}) {
    const toast_container = document.getElementById('toast');
    if(toast_container){
        const toast = document.createElement('div');

        const autoRemoveId = setTimeout(function(){
            toast_container.removeChild(toast);
        }, duration + 1000);

        toast.onclick = function(event){
            if(event.target.closest('.toast__close')){
                toast_container.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        }

        toast.classList.add('toast', 'toast--' + type);
        const delay = (duration / 1000).toFixed(2);
        toast.style.animation = 'slideInLeft ease .3s, fadeOut linear 1s ' + delay + 's forwards';

        const icon = toast_icons[type];

        toast.innerHTML = '\
                    <div class="toast__icon">\
                        <i class="' + icon +  '"></i>\
                    </div>\
                    <div class="toast__body">\
                        <p class="toast__title">' + title + '</p>\
                        <p class="toast__msg">' + message + '</p>\
                    </div>\
                    <div class="toast__close">\
                        <i class="fa-solid fa-x"></i>\
                    </div>\
                ';
        
        toast_container.appendChild(toast);
    }
}