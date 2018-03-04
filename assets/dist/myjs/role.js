/* role methods */
$("#role-assign").change(function () {
    var role_id = $(this).val();

    $.ajax({
        url: "http://localhost/ngo/user/getUsersForRole",
        method: "POST",
        data: {role_id: role_id},
        success: function (res) {
            console.log(res);
            $('#user').html(res);
        }
    });
});

$("#role").change(function () {
    var role_id = $(this).val();

    $.ajax({
        url: "http://localhost/ngo/rolecontrol/getcontrolsforrole",
        method: "POST",
        data: {role_id: role_id},
        success: function (res) {
            $('#controlsForRole').html(res);
        }
    });
});

function getRole(id) {
    var role_id = '';
    var role_name = '';

    jQuery.ajax({
        type: "POST",
        url: "http://localhost/ngo/role/getrole",
        dataType: 'json',
        data: {id: id},
        success: function (res) {
            var categoryJSON = JSON.parse(JSON.stringify(res));
            $.each(categoryJSON, function (i, item) {
                role_id = item.role_id;
                role_name = item.role_name;
            });
            if (res) {
                $("input#role-id").val(role_id);
                $("input#role-name").val(role_name);
            }
        }
    });
}

function deleteRole(id) {
    jQuery.ajax({
        type: "POST",
        url: "http://localhost/ngo/role/deleterole",
        dataType: 'json',
        data: {id: id},
        success: function (res) {
            location.reload();
        }
    });
}

/* assign role to user */
$('#rolesForm').click(function () {
    var user_id = $('#user').val();
    var role_id = $('#role-assign').val();

    jQuery.ajax({
        type: "POST",
        url: "http://localhost/ngo/role/assignrole",
        data: {user_id: user_id, role_id: role_id},
        success: function (res) {
            if (res) {
                location.reload();
            }
        }
    });
});

$(document).ready(function() {
    $("#add-role").click(function () {
        $("#add-role-form").dialog({
            title: 'Add Role',
            width: 450,
            height: 250,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                Cancel: function () {
                    $(this).dialog('close');
                },
                Save: function () {
                    document.forms["add-role-form"].submit();
                }
            }
        });
    });
    $(".edit-role").click(function () {
        $("#edit-role-form").dialog({
            title: 'Add Role',
            width: 450,
            height: 250,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                Cancel: function () {
                    $(this).dialog('close');
                },
                Save: function () {
                    document.forms["edit-role-form"].submit();
                }
            }
        });
    });
});

function confirmDeleteRole(role_id) {
    var dynamic_dialog = $('<div id="confirm-box">' +
        '<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">' +
        '</span> Are you sure to delete the role?</div>');

    dynamic_dialog.dialog({
        title: "Are you sure?",
        closeOnEscape: true,
        modal: true,

        buttons: [
            {
                text: "Yes",
                click: function() {
                    $(this).dialog("close");
                    deleteRole(role_id);
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