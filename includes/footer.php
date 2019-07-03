<div id="list"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
<script>
$(".ui.normal.dropdown").dropdown({maxSelections: 3});

$("#searchBtn").on("click", function(e){
    console.log($("#search").val());

    $.post("list.php", {
        search: $("#search").val()
    }, function(data){
        $("#list").html(data);
    });
});
</script>
</body>
</html>