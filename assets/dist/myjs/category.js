/* category methods */
function getCategory(id) {
    var category_id;
    var category_name;
    var parent_category;
    var parent_category_id;
    var measurement_id;
    var measurement_unit;

    jQuery.ajax({
        type: "POST",
        url: "http://localhost/ngo/category/getcategory",
        dataType: 'json',
        data: {id: id},
        success: function (res) {
            // don't need to do this - stringify and parse
            var categoryJSON = JSON.parse(JSON.stringify(res));

            $.each(categoryJSON, function (i, item) {
                category_id = item.id;
                category_name = item.category;
                parent_category = item.parent;
                parent_category_id = item.pid;
                measurement_id = item.mid;
                measurement_unit = item.measurement_unit;
            });

            if (res) {
                $("#category-id").val(category_id);
                $("#category-name-edit").val(category_name);
                $("#parent-category-edit").empty();
                $("#parent-category-edit").prepend('<option value="'+ parent_category_id +'">'+ parent_category +'</option>');
                populateSelectForParentCategory();
                $("#measurement-unit-edit").empty();
                $("#measurement-unit-edit").prepend('<option value="'+ measurement_id +'">'+ measurement_unit +'</option>');
                populateSelectForCategoryUnit();
            }
        }
    });
}

function populateSelectForParentCategory() {
    $.ajax({
        type: "GET",
        url: "http://localhost/ngo/category/getCategories",
        dataType: "json",
        success: function(res) {
            $.each(res, function(i, item) {
                $("#parent-category-edit").append('<option value="'+ item.category_id +'">'+ item.category_name +'</option>');
            });
        }
    })
}

function populateSelectForCategoryUnit() {
    $.ajax({
        type: "GET",
        url: "http://localhost/ngo/measurement/getUnits",
        dataType: "json",
        success: function(res) {
            $.each(res, function(i, item) {
               $("#measurement-unit-edit").append('<option value="'+ item.measurement_id +'">'+ item.measurement_unit +'</option>');
            });
        }
    })
}

function deleteCategory(id) {
    jQuery.ajax({
        type: "POST",
        url: "http://localhost/ngo/category/deletecategory",
        dataType: 'json',
        data: {id: id},
        success: function (res) {
            location.reload();
        }
    });
}

$(document).ready(function() {
    $("#add-category").click(function() {
        $("#add-category-form").dialog({
            title: 'Add Category',
            width: 450,
            height: 350,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                Cancel: function() {
                    $(this).dialog('close');
                },
                Save: function() {
                    document.forms["add-category-form"].submit();
                }
            }
        });
    });

    $(".edit-category").click(function() {
        $("#edit-category-form").dialog({
            title: 'Edit Category',
            width: 450,
            height: 350,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                Cancel: function() {
                    $(this).dialog('close');
                },
                Save: function() {
                    document.forms["edit-category-form"].submit();
                }
            }
        });
    });
})

function confirmDeleteCategory(category_id) {
    var dynamic_dialog = $('<div id="confirm-box">' +
        '<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">' +
        '</span> Are you sure to delete the category?</div>');

    dynamic_dialog.dialog({
        title: "Are you sure?",
        closeOnEscape: true,
        modal: true,

        buttons: [
            {
                text: "Yes",
                click: function() {
                    $(this).dialog("close");
                    deleteCategory(category_id);
                }
            },
            {
                text: "No",
                click: function() {
                    $(this).dialog("close");
                }
            }
        ]
    });
    return false;
}
