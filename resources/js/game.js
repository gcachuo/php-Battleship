$(function () {
    $("table td").click(function () {
        var table = $(this).closest("table").attr("id");
        var cell = $(this).data("id");
        var id = (table + "#" + cell);
        $(this).css({"background-color": "blue"});
    });
});