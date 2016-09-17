function filterReservations() {
    $("#filter").submit();
}


$(document).ready(function () {

    $("#filter").submit(function (e) {

        e.preventDefault();


        var $form = $(this),
        url = $form.attr("action");

        var reservation_id = $('input[name=eventID]').val()

        $.ajax({
            type: 'post',
            url: url,
            data: { 'eventID': reservation_id },
            error: function () {
                $("#result-status").html("<div class='error'>Greska prilikom obrade rezervacije karata. Molimo vas pokusajte ponovo.!</div>")
            },
            success: function (data) {
               // window.location.reload();
                $("#all_reservations").load(window.location + " #all_reservations");
                //alert(data);
            },

        });//ajax

    })//submit
});