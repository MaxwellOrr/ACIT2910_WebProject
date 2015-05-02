jQuery(document).ready(function($) {
    		$('.btnSearch').click(function(){
    			makeAjaxRequest();
    		});
    		$('.btnedit').click(function(){
    			openDialog();
    		});
    		$('.btnadd').click(function(){
    			openDialogadd();
    		});


            $('form').submit(function(e){
                e.preventDefault();
                makeAjaxRequest();
                return false;
            });

            function makeAjaxRequest() {
                $.ajax({
                    url: 'PHP/suspectMain.php',
                    type: 'POST',
                    dataType: "json",
                    data: {name: $('#offIDval').val(), incType: $('#suspIDval').val()},
                    success: function(response) {
                        $('table#resultTable tbody').empty();
                        $.each(response, function(key, val) {
                    	$('table#resultTable tbody').append('<tr> <td>'+val.suspID+'</td><td>'+
                    	val.suspFirstname+'</td>'+'<td>'+ val.suspLastname +'</td>'+'<td>' +val.suspGender+'</td>'+'</tr>');
                    	});
                    }
                });
            }
            
            window.onload = function(){
            	$.ajax({
                    url: 'PHP/offSelect.php',
                    type: 'get',
                    dataType: "json",
                    data: {name: null, incType: null},
                    success: function(response) {
                        $.each(response, function(key, val) {
                        $('#offIDval').append('<option>' + val.offID + '</option>');
                        });
                    }
                });
                
                 $.ajax({
                    url: 'PHP/suspectMain.php',
                    type: 'POST',
                    dataType: "json",
                    data: {name: $('input#name').val()},
                    success: function(response) {
                        $.each(response, function(key, val) {
                    	$('table#resultTable tbody').append('<tr> <td>'+val.suspID+'</td><td>'+
                    	val.suspFirstname+'</td>'+'<td>'+ val.suspLastname +'</td>'+'<td>' +val.suspGender+'</td>'+'</tr>');
                    	});
                    }
                });
            
            }
    	});
    	
    	
                             function openDialog() {
       var page = "Suspect_Edit.html";

var $dialog = $('<div></div>').html('<iframe scrolling="no" frameborder="1"  style="border: 10px; " src="' + page + '" width="450px" height="480px"></iframe>').dialog({
                   autoOpen: false,
                   modal: true,
                   show: 'fade',
                   height: 480,
                   width: 450,
                   title: "Edit Incident",
                   close: function() {
            			$( this ).dialog( "close" );
      					},
      					 open: function (event, ui) {
    $(this).css('overflow', 'hidden'); //this line does the actual hiding
  }
               });
$dialog.dialog('open');
}
            
                function openDialogadd() {
       var page = "Suspect_add.html";

var $dialog = $('<div></div>').html('<iframe scrolling="no" frameborder="1"  style="border: 10px; " src="' + page + '" width="450px" height="480px"></iframe>').dialog({
                   autoOpen: false,
                   modal: true,
                   show: 'fade',
                   height: 480,
                   width: 450,
                   title: "add Incident",
                   close: function() {
            			$( this ).dialog( "close" );
      					},
      			
               });
$dialog.dialog('open');
}