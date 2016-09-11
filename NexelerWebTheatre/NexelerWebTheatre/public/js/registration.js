
function checkAvailability() {

    var username = $("#user_name").val();
   
    if (!username || username.length === 0) {
        
        return false;
    }
    //$("#loaderIcon").show();
    $.ajax({
        url: "checkUsername",
        data: 'username=' + username,
        type: "POST",
        success: function (data) {
            //$("#loaderIcon").hide();
            
            //$("#user-availability-status").html("<IMG STYLE='border: none;' SRC='../images/confirm1.png' >");
            if (data === 'AVAILABLE') {
                $("#user-availability-status").attr("title", "Korisničko ime je slobodno");
                $("#user-availability-status").attr("src", "../images/confirm2.png");
            } else {
                $("#user-availability-status").attr("title", "Korisničko ime je zauzeto");
                $("#user-availability-status").attr("src", "../images/x2.png");
            }
           
            $('#user-availability-status').show('show');
        },
        error: function () { }
    });
}

$(document).ready(function () {
    
    $("#register_form").submit(function(e) {
        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var cpassword = $("#password_repeat").val();
        var username = $("#user_name").val();

        if (!name || name.length === 0) {
            $("#validation-status").html("<div class='error'>Polje 'Ime' je obavezno. Molimo Vas popunite sva zahtevana polja.</div>")
            return false;
        } else if (!email || email.length === 0) {
            $("#validation-status").html("<div class='error'>Polje 'Email' je obavezno. Molimo Vas popunite sva zahtevana polja.</div>")
            return false;
        } else if (!username || username.length === 0) {
            $("#validation-status").html("<div class='error'>Polje 'Korisnicko ime' je obavezno. Molimo Vas popunite sva zahtevana polja.</div>")
            return false;
        } else if (!password || password.length === 0 || !cpassword || cpassword.length === 0) {
            $("#validation-status").html("<div class='error'>Molimo Vas unesite željenu šifru.</div>")
            return false;
        } else if ((password.length) < 8 || cpassword < 8) {
            $("#validation-status").html("<div class='error'>Šifra mora sadržati minimum 8 karaktera!</div>")
            return false;
        } else {
            var form = $('#register_form');
 
            $.ajax({
                type: form.type,
                url: form.url,
                data: form.serialize(),

                error: function () {
                    alert("Greska prilikom registracije korisnika. Molimo vas pokusajte ponovo.");
                    $('#errorMessage').html('<p>An error has occurred</p>');
                },
                success: function (msg) {
                },
                
            });
        }
    });
});