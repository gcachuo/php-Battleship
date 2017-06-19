$(function () {
    $("table td").click(function () {
        var table = $(this).closest("table").attr("id");
        var cell = $(this).data("id");
        ajax("validateShot", "game", {table: table, cell: cell});
    });
});

function validateShot(callback) {
    console.log(callback.table);
    console.log(callback.cell);
    var color = "blue";
    if (callback.shot) color = "red";
    $("table#" + callback.table + " td[data-id=" + callback.cell + "]").css({"background-color": color});
}