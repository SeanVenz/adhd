jQuery(function (e) {
    let i = 2, t = e("#load-more"), n = e("#article-container"), o = loadmore_params.ajax_url; t.on("click", function () {
        e.ajax({
            url: o, type: "GET", data: { action: "load_more_posts", page: i }, beforeSend: function () {
                t.html(`
    <svg class="spinner" width="20" height="20" viewBox="0 0 50 50">
        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="4"></circle>
    </svg> Loading...
`)
            }, success: function (e) { e.trim() ? (n.append(e), i++, t.text("Załaduj więcej")) : t.hide() }, error: function () { t.text("Błąd ładowania post\xf3w") }
        })
    })
});