/* Reception methods */
$("#receptionReferenceSelect").change(function () {
    var reference = $("#receptionReferenceSelect").val();

    if (reference === "reference") {
        var showReference;
        var reference_id;
        var reference_name;
        $.ajax({
            type: "POST",
            url: "http://localhost/ngo/reference/getreference",
            dataType: "JSON",

            success: function (data) {
                $.each(data, function (i, item) {
                    reference_id = item.id;
                    reference_name = item.name;
                });
                if (data) {
                    showReference = "<label class='col-sm-3 control-label'>Select Reference</label>";
                    showReference += "<div class='col-sm-4'><select class='form-control' name='reference_id'>";
                    showReference += "<option value='" + reference_id + "'>" + reference_name + "</option></select></div>";

                    $("#showReference").html(showReference);
                }
            }
        });
    }
    $("#showReference").html("");
});