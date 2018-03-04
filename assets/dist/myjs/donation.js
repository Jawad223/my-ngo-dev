// get first child category
var child_message = "No child found for this category, assuming it last.";

$("#parent-category").change(function () {
    var id = $(this).val();

    $.ajax({
        type: "POST",
        url: "http://localhost/ngo/category/ifChildExists",
        data: {id: id},
        success: function (res) {
            if (res == 1) {
                $("#no-child-message").html("");
                $("#child-category-div").show();
                getFirstChild(id);
            }
            else {
                $("#no-child-message").html(child_message);
                $("#child-category-div").hide();
            }
        }
    });
    checkUnitForCategory(id);
});

function getFirstChild(id) {
    $.ajax({
        type: "POST",
        url: "http://localhost/ngo/category/getChildCategory",
        dataType: "JSON",
        data: {id: id},
        success: function (data) {
            child_category = "<div class='form-group'>";
            child_category += "<label class='col-sm-3 control-label'>Child Category</label>";
            child_category += "<div class='col-sm-5'>";
            child_category += "<select class='form-control' id='child-category-1' name='child_category_1'>";
            child_category += "<option value=''>Select Child Category</option>";

            $.each(data, function (i, item) {
                category_id = item.category_id;
                category_name = item.category_name;

                child_category += "<option value='" + category_id + "'>" + category_name + "</option>";
            });

            child_category += "</select>";
            child_category += "</div><small id='no-child-message-1' style='color: blue;'></small></div>";

            $("#child-category-div-1").html(child_category);
        }
    });
}

// get second child category
$("#child-category-div-1").change(function () {
    var id = $("#child-category-1").val();

    $.ajax({
        type: "POST",
        url: "http://localhost/ngo/category/ifChildExists",
        data: {id: id},
        success: function (res) {
            if (res == 1) {
                $("#no-child-message-1").html("");
                $("#child-category-div-2").show();
                getSecondChild(id);
            }
            else {
                $("#no-child-message-1").html(child_message);
                $("#child-category-div-2").hide();
            }
        }
    });
    checkUnitForCategory(id);
});

function getSecondChild(id) {
    $.ajax({
        type: "POST",
        url: "http://localhost/ngo/category/getChildCategory",
        dataType: "JSON",
        data: {id: id},
        success: function (data) {
            child_category = "<div class='form-group'>";
            child_category += "<label class='col-sm-3 control-label'>Sub-Child Category</label>";
            child_category += "<div class='col-sm-5'>";
            child_category += "<select class='form-control' id='child-category-2' name='child_category_2'>";
            child_category += "<option value='0'>Select Sub-Child Category</option>";

            $.each(data, function (i, item) {
                category_id = item.category_id;
                category_name = item.category_name;

                child_category += "<option value='" + category_id + "'>" + category_name + "</option>";
            });

            child_category += "</select>";
            child_category += "</div><small id='no-child-message-2' style='color: blue;'></small></div>";

            $("#child-category-div-2").html(child_category);
        }
    });
}

// get third child category
$("#child-category-div-2").change(function () {
    var id = $("#child-category-2").val();

    $.ajax({
        type: "POST",
        url: "http://localhost/ngo/category/ifChildExists",
        data: {id: id},
        success: function (res) {
            if (res == 1) {
                $("#no-child-message-2").html("");
                $("#child-category-div-3").show();
                getThirdChild(id);
            }
            else {
                $("#no-child-message-2").html(child_message);
                $("#child-category-div-3").hide();
            }
        }
    });
    checkUnitForCategory(id);
});

function getThirdChild(id) {
    $.ajax({
        type: "POST",
        url: "http://localhost/ngo/category/getChildCategory",
        dataType: "JSON",
        data: {id: id},
        success: function (data) {
            child_category = "<div class='form-group'>";
            child_category += "<label class='col-sm-3 control-label'>Sub-Child Category</label>";
            child_category += "<div class='col-sm-5'>";
            child_category += "<select class='form-control' id='child-category-3' name='child_category_3'>";
            child_category += "<option value='0'>Select Sub-Child Category</option>";

            $.each(data, function (i, item) {
                category_id = item.category_id;
                category_name = item.category_name;

                child_category += "<option value='" + category_id + "'>" + category_name + "</option>";
            });

            child_category += "</select>";
            child_category += "</div><small id='no-child-message-3' style='color: orange;'></small></div>";

            $("#child-category-div-3").html(child_category);
        }
    });
}

// get measurement unit
function checkUnitForCategory(category_id) {
    $.ajax({
        type: "POST",
        data: {id: category_id},
        dataType: "json",
        url: "http://localhost/ngo/measurement/checkUnitForCategory",
        success: function(res) {
            getUnitForCategory(category_id);
        }
    });
}

function getUnitForCategory(category_id) {
    $.ajax({
        type: "POST",
        data: {id: category_id},
        dataType: "json",
        url: "http://localhost/ngo/measurement/getUnitForCategory",
        success: function(res) {
            unit = "";

            $.each(res, function(i, item) {
                measurement_id = item.measurement_id;
                measurement_unit = item.measurement_unit;

                unit += "<option value='" + measurement_id + "'>" + measurement_unit + "</option>";
            })

            $("#measurement-unit").html(unit);
        }
    });
}