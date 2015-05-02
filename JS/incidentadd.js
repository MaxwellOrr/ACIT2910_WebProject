jQuery(document).ready(function($) {
    		//$('.btnsubmit').click(function(){
    		//	makeAjaxRequest();
    		//});


            $('form').submit(function(e){
                e.preventDefault();
                makeAjaxRequest();
                return false;
            });

            function makeAjaxRequest() {
                $.ajax({
                    url: 'PHP/incAdd.php',
                    type: 'POST',
                    data: {name: $('#incIDval').val(), incAddress: $('#incAddressval').val(), incDate : $('#incDateval').val(), incType: $('#incTypeval').val()},
                    success: function(response) {
                        alert("Incident has been added");
                    }
                });
            }
            });