/* control methods */
function deleteControl(id) {
    jQuery.ajax({
        type: "POST",
        url: "http://localhost/ngo/control/deleteControl",
        dataType: 'json',
        data: {id: id},
        success: function (res) {
            location.reload();
        }
    });
}

function getControl(id) {
    var control_id;
    var control_name;
    var control_url;

    jQuery.ajax({
        type: "POST",
        url: "http://localhost/ngo/control/getcontrol",
        dataType: 'json',
        data: {id: id},
        success: function (res) {
            var categoryJSON = JSON.parse(JSON.stringify(res));

            $.each(categoryJSON, function (i, item) {
                control_id = item.control_id;
                control_name = item.control_name;
                control_url = item.control_url;
            });

            if (res) {
                $("input#id").val(control_id);
                $("input#name").val(control_name);
                $("input#url").val(control_url);
            }
        }
    });
}

$(document).ready(function() {
    $("#add-control").click(function () {
        $("#add-control-form").dialog({
            title: 'Add Control',
            width: 450,
            height: 300,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                Cancel: function () {
                    $(this).dialog('close');
                },
                Save: function () {
                    document.forms["add-control-form"].submit();
                }
            }
        });
    });
    $(".edit-control").click(function () {
        $("#edit-control-form").dialog({
            title: 'Edit Control',
            width: 450,
            height: 300,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                Cancel: function () {
                    $(this).dialog('close');
                },
                Save: function () {
                    document.forms["edit-control-form"].submit();
                }
            }
        });
    });
});

function confirmDeleteControl(control_id) {
    var dynamic_dialog = $('<div id="confirm-box">' +
        '<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">' +
        '</span> Are you sure to delete the control?</div>');

    dynamic_dialog.dialog({
        title: "Are you sure?",
        closeOnEscape: true,
        modal: true,

        buttons: [
            {
                text: "Yes",
                click: function() {
                    $(this).dialog("close");
                    deleteControl(control_id);
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