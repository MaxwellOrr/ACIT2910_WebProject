                            function openDialog() {
       var page = "incident_edit.html";

var $dialog = $('<div></div>').html('<iframe scrolling="no" frameborder="1"  style="border: 10px; " src="' + page + '" width="450px" height="480px"></iframe>').dialog({
                   autoOpen: false,
                   modal: true,
                   height: 480,
                   width: 450,
                   title: "Edit Incident"
               });
$dialog.dialog('open');
}