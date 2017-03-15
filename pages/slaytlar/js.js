$(document).ready(function () {

    $(".toggle-switch").click(function () {
        var hidden_input_id =  $(this).attr("hidden-input-id");
        var hidden_input_state = $("#ts" + hidden_input_id).prop("checked");

        $("#ts" + hidden_input_id).prop("checked", !hidden_input_state);

        var STATE = !hidden_input_state == true ? 1 : 0;
        var formData = new FormData();
        formData.append("OPTION", "CHANGE_STATE");
        formData.append("ID", hidden_input_id);
        formData.append("STATE", STATE);
        
        $.ajax({
            type: 'POST',
            dataType: 'text',
            data: formData,
            url:'/panel/pages/slaytlar/ajax.php',
            processData: false,
            contentType: false,
            success: function () {

            },
            error: function (a, b, c) {
                console.log(a);
                console.log(b);
                console.log(c);
                alert("STATE değişirken bir hata oluştu ama sorun değil işlemlerine devam edebilirsin.");
            }
        });


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