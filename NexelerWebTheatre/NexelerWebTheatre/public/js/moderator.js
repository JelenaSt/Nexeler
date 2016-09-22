function filterReservations() {
    $("#filter").submit();
}


$(document).ready(function () {

    $("#filter").submit(function (e) {

        e.preventDefault();


        var $form = $(this),
        url = $form.attr("action");

        //var filter_requeste = $('input[name=filtriraj').val(); 
        //var event_id = $('input[name=eventID]').val();
        var play_name = $('input[name=playName]').val();
        var datum = $('input[name=datum]').val();
        var user_id = $('input[name=idUser]').val();
        var name_user = $('input[name=nameUser]').val();

        $.ajax({
            type: 'post',
            url: url,
            data: {'playName': play_name, 'datum': datum, 'userId': user_id , 'name_user' : name_user},
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