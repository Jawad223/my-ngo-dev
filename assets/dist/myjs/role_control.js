/* role control methods */
function deleteRoleControl(id) {
    jQuery.ajax({
        type: "POST",
        url: "http://localhost/ngo/rolecontrol/deleteRoleControl",
        dataType: 'json',
        data: {id: id},
        success: function (res) {
            Location.reload();
        }
    });
}

$(document).ready(function() {
    $("#add-role-control").click(function () {
        $("#add-role-control-form").dialog({
            title: 'Add Role Control',
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
                    document.forms["add-role-control-form"].submit();
                }
            }
        });
    });
});

$("#rc-role-dropdown").change(function() {
    var role_id = $(this).val();

    $.ajax({
        type: "POST",
        data: {id: role_id},
        url: "http://localhost/ngo/rolecontrol/getcontrolsforrole",
        success: function(res) {
            $("#rc-control-dropdown").html(res);
        }
    });
});

function confirmDeleteRoleControl(rc_id) {
    var dynamic_dialog = $('<div id="confirm-box">' +
        '<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">' +
        '</span> Are you sure to delete the role control?</div>');

    dynamic_dialog.dialog({
        title: "Are you sure?",
        closeOnEscape: true,
        modal: true,

        buttons: [
            {
                text: "Yes",
                click: function() {
                    $(this).dialog("close");
                    deleteRoleControl(rc_id);
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