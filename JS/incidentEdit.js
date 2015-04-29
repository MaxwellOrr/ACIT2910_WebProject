jQuery(document).ready(function($) {
    		$('.btnSearch').click(function(){
    			makeAjaxRequest();
    		});
    		 $('.btnedit').click(function(){
       		openDialog();
    		});

    		$('.Button').click(function(){
    			openDialog();
    		});


            $('form').submit(function(e){
                e.preventDefault();
                makeAjaxRequest();
                return false;
            });

            function makeAjaxRequest() {
                $.ajax({
                    url: 'PHP/incEdit.php',
                    type: 'POST',
                    data: {name: $('#incIDval').val(), incAddress: $('#incAddressval').val(), incDate : $('#incDateval').val(), incType: $('#incTypeval').val()},
                    success: function(response) {
                        $('#test').html(response);
                    }
                });
            }

    