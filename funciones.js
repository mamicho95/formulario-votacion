function getComuna(val) {
    $.ajax({
        type: "POST",
        url: "comuna.php",
        data: { region_id: val },
        success: function (data) {
            $("#comuna").html(data);
        }, error: function (data) {
            alert("error al obtener comuna");
        }
    });
}