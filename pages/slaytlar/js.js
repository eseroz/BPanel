$(document).ready(function () {

    $(".toggle-switch").click(function () {
        var hidden_input_id = "ts" + $(this).attr("hidden-input-id");
        var hidden_input_state = $("#" + hidden_input_id).prop("checked");
        if (hidden_input_id == true) {
            $("#" + hidden_input_id).prop("checked", false);
        } else {
            $("#" + hidden_input_id).prop("checked", true);
        }
    });

    $("#sortable").sortable({
        stop: function(event, ui) {
            var SIRA_LISTESI = [];
            $(".draggable").each(function (index) {
                var id = $(this).attr("data-id");
                if (typeof id !== 'undefined') {
                    var elm = new Array(id, $(this).index());
                    SIRA_LISTESI.push(elm);
                }
            });


            var formData = new FormData();
            formData.append("OPTION", "SLIDER_SEQUENCE");
            formData.append("LISTE", JSON.stringify(SIRA_LISTESI));

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: formData,
                url: 'pages/slaytlar/ajax.php',
                processData: false,
                contentType: false,
                success: function (result) {
                    //console.log(result);

                    $(".draggable").each(function (index) {
                        var id = $(this).attr("data-id");
                        console.log("index:" + $(this).index() + " id:" + id);
                    });

                },
                error: function (a, b, c) {
                    console.error("Slayt sırası kaydedilirken bir hata oluştu. Ama bu çok önemli bir şey değil.");
                    console.error(a);
                    console.error(b);
                    console.error(c);
                }

            });
        },
        change: function (event, ui) {
           
        }
    });

    $("#btnSlaytEkle").click(function () {
        $("#btnSlaytKaydet").show();
        $("#btnSlaytGuncelle").hide();
        $("#modalWider").modal("show");
    });

    $("#btnSlaytKaydet").click(function () {

    });

    $("#btnSlaytGuncelle").click(function () {

    });
    //$("#slaytlar").disableSelection();
});