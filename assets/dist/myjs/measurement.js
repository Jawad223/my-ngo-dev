/* measurement methods */
function getUnit(id) {
    var m_id;
    var m_unit;

    $.ajax({
        type: "POST",
        url: "http://localhost/ngo/measurement/getUnit",
        dataType: 'json',
        data: {id: id},
        success: function (res) {
            //var unitJSON = JSON.parse(JSON.stringify(res));
            $.each(res, function (i, item) {
                m_id = item.measurement_id;
                m_unit = item.measurement_unit;
            });
            $("input#measurement-id").val(m_id);
            $("input#measurement-unit").val(m_unit);
        }
    });
}

function deleteUnit(id) {
    jQuery.ajax({
        type: "POST",
        url: "http://localhost/ngo/measurement/deleteUnit",
        dataType: 'json',
        data: {id: id},
        success: function (res) {
            location.reload();
        }
    });
}

$(document).ready(function() {
    /* edit measurement unit dialog box*/
    $(".edit-unit").click(function() {
        $("#edit-unit-form").dialog({
            title: 'Edit Measurement Unit',
            width: 400,
            height: 250,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                Cancel: function() {
                    $(this).dialog('close');
                },
                Save: function() {
                    document.forms["edit-unit-form"].submit();
                }
            }
        });
    });

    /* add measurement unit dialog box*/
    $("#add-unit").click(function() {
        $("#add-unit-form").dialog({
            title: 'Add Measurement Unit',
            width: 400,
            height: 250,
            modal: true,
            resizable: false,
            draggable: false,
            buttons: {
                Cancel: function() {
                    $(this).dialog('close');
                },
                Save: function() {
                    document.forms["add-unit-form"].submit();
                }
            }
        });
    });
})

function confirmDeleteUnit(measurement_id) {
    var dynamic_dialog = $('<div id="confirm-box">' +
        '<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">' +
        '</span> Are you sure to delete the unit?</div>');

    dynamic_dialog.dialog({
        title: "Are you sure?",
        closeOnEscape: true,
        modal: true,

        buttons: [
            {
                text: "Yes",
                click: function() {
                    $(this).dialog("close");
                    deleteUnit(measurement_id);
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
