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
                    url: 'PHP/officerMain.php',
                    type: 'POST',
                    dataType: "json",
                    data: {depID: $('#depIDval').val(), offID: $('#offIDval').val()},
                    success: function(response) {
                    $('table#resultTable tbody').empty();
                        $.each(response, function(key, val) {
                    	$('table#resultTable tbody').append('<tr> <td>'+val.offID+'</td><td>'+val.depID+'</td><td>'+
                    	val.offFirstname+'</td>'+'<td>'+ val.offLastname +'</td>'+'<td>' +val.offRank+'</td>'+'</tr>');
                    	});
                    }
                });
            }
            
            window.onload = function(){

            	$.ajax({
                    url: 'PHP/depSelect.php',
                    type: 'POST',
                    dataType: "json",
                    data: {name: $('#depIDval').val(), incType: $('#depIDval').val()},
                    success: function(response) {
                        $.each(response, function(key, val) {
                        $('#depIDval').append('<option>' + val.depID + '</option>');
                        });
                    }
                    
                });

                
                 $.ajax({
                    url: 'PHP/officerMain.php',
                    type: 'POST',
                    dataType: "json",
                    data: {name: $('input#name').val()},
                    success: function(response) {
                    $.each(response, function(key, val) {
                    	$('table#resultTable tbody').append('<tr> <td>'+val.offID+'</td><td>'+val.depID+'</td><td>'+
                    	val.offFirstname+'</td>'+'<td>'+ val.offLastname +'</td>'+'<td>' +val.offRank+'</td>' +'</tr>');
                    	});

                    }
                });
            
            }
    	});
    	
    	
                            function openDialog() {
       var page = "Officer_Edit.html";

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
       var page = "officer_add.html";

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
      					open: function (event, ui) {
    $(this).css('overflow', 'hidden'); //this line does the actual hiding
  }
               });
$dialog.dialog('open');
}
    	
    	
    	