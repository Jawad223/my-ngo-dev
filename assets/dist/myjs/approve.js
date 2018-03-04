/* approval methods */
function approveDonation(id, choice) {
    $.ajax({
        url: "http://localhost/ngo/approval/approveDonation/id/choice",
        method: "POST",
        data: {id: id, choice: choice},
        success: function (res) {
            location.reload();
        }
    });
}

function approveReception(id, choice) {
    $.ajax({
        url: "http://localhost/ngo/approval/approveReception/id/choice",
        method: "POST",
        data: {id: id, choice: choice},
        success: function (res) {
            location.reload();
        }
    });
}