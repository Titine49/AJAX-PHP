$(document).ready(function () {
    $("#searchBar").dropdown({
        maxSelections: 3
    });

    $("#btnSearch").on("click", function()
    {
        $.post(
            "search.php",
            {search: $("#searchBar").val()},
            function(data)
            {
                $("#list").html("");
                $("#list").append(data);
            });
    });
});