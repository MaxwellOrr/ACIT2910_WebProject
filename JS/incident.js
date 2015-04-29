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
                    url: 'PHP/search.php',
                    type: 'POST',
                    data: {name: $('#incIDval').val(), incType: $('#incTypeval').val(), incAddress: $('#incAddressval').val()},
                    success: function(response) {
                        $('table#resultTable tbody').html(response);
                    }
                });
            }


            
            window.onload = function(){
            	$.ajax({
                    url: 'PHP/incSelect.php',
                    type: 'get',
                    data: {name: null, incType: null},
                    success: function(response) {
                        $('#incID').html(response);
                    }
                });
                
                 $.ajax({
                    url: 'PHP/search.php',
                    type: 'POST',
                    data: {name: $('input#name').val()},
                    success: function(response) {
                        $('table#resultTable tbody').html(response);
                    }
                });
            
            }
                  

    	});
    	
                            function openDialog() {
       var page = "incident_edit.html";

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
       var page = "incident_add.html";

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
    	
    	
    	