function toogleParameterUrl(param, value) {
    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);

    if (params.has(param)) {
        const values = params.get(param).split('%');
        const valueIndex = values.indexOf(value);

        if (valueIndex !== -1) {
            values.splice(valueIndex, 1);
            if (values.length > 0) {
                params.set(param, values.join('%'));
            } else {
                params.delete(param);
            }
        } else {
            values.push(value);
            params.set(param, values.join('%'));
        }
    } else {
        params.set(param, value);
    }

    window.location.href = `${url.pathname}?${params}`;
}