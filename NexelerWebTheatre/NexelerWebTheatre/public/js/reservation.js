

function OnReserveButton(eventId) {
    $('#event_id').attr("value", eventId);
    $("#reserve_tickets_btn").removeAttr("disabled")
    $("#result-status").html("");

    $('#reserveDialog').dialog({ modal: true });
}


function OnDeleteButton(reservationID) {
    $('#reservationID').attr("value", reservationID);
    $("#reserve-delete-confirm").dialog("open");
}

$(function () {
    $("#reserve-delete-confirm").dialog({
        autoOpen: false,
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,

        buttons: {
            "Da": function () {
             
                $('#del_reservation').submit();
                $(this).dialog("close");
            },

            "Odustani": function () {
                $(this).dialog("close");
            }

        }

    });

});


$(document).ready(function () {

    $("#del_reservation").submit(function (e) {

        e.preventDefault();


        var $form = $(this),
        url = $form.attr("action");

        var reservation_id = $('input[name=reservationID]').val()

        $.ajax({
            type: 'post',
            url: url,
            data: { 'reservationID': reservation_id },
            error: function () {
                $("#result-status").html("<div class='error'>Greska prilikom obrade rezervacije karata. Molimo vas pokusajte ponovo.!</div>")
            },
            success: function (data) {
               // window.location.reload();
                $("#all_reservations").load(window.location + " #all_reservations");

            },

        });//ajax
    
    })//submit
});



$(document).ready(function () {

    $("#reservation-form").submit(function (e) {

        e.preventDefault();

        $("#reserve_tickets_btn").attr("disabled", "disabled");

        var $form = $(this),
            url = $form.attr("action");

        var eventId = $("#event_id").val();
        var numOfCards = $('#num_of_cards').val();


        var formData = {
            'event_id': $('input[name=event_id]').val(),
            'num_of_cards': $('#num_of_cards').val()
        };

        $.ajax({
            type: 'post',
            url: url,
            data: formData,
            error: function () {
                $("#result-status").html("<div class='error'>Greska pri konekciji. Molimo vas pokusajte ponovo.!</div>")
            },
            success: function (data) {
                $("#result-status").html("<div class='success'>Uspesno rezervisane karte." + data + "!</div>");

            },

        });
    })
});






