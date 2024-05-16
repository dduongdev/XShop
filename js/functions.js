function addUrlParameter(name, value) {
    var url = new URL(window.location.href);

    url.searchParams.set(name, value);

    window.location.href = url.href;
}