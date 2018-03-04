var _add_reference = false;

$("#add-reference").click(function() {
    if (_add_reference) {
        $("#add-reference-form").hide();
        _add_reference = false;
    }
    else {
        $("#add-reference-form").show();
        _add_reference = true;
    }
});


$(document).ready(function() {
    $("#add-reference-form").hide();
});

function confirmDeleteReference(reference_id) {
    var dynamic_dialog = $('<div id="confirm-box">' +
        '<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">' +
        '</span> Are you sure to delete the reference?</div>');

    dynamic_dialog.dialog({
        title: "Are you sure?",
        closeOnEscape: true,
        modal: true,

        buttons: [
            {
                text: "Yes",
                click: function() {
                    $(this).dialog("close");
                    deleteReference(reference_id);
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
