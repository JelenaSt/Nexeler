function OpenConfirmationDialog(eventID,eventName) {

    $('#del_event_name').html("<strong>'"+eventName+"'</strong>");
    $('#eventID').attr("value", eventID);
    $("#event-delete-confirm").dialog("open");
}

$(function () {
    $("#event-delete-confirm").dialog({
        autoOpen: false,
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,

        buttons: {
            "Obrisi": function () {
                $('#del_event').submit();
                $(this).dialog("close");
            },

            "Odustani": function () {
                $(this).dialog("close");
            }
        }
    });
});
