jQuery(document).ready(function($) {
    		$('.btnsubmit').click(function(){
    			makeAjaxRequest();
    		});


            $('form').submit(function(e){
                e.preventDefault();
                makeAjaxRequest();
                return false;
            });

            function makeAjaxRequest() {
                $.ajax({
                    url: 'PHP/offAdd.php',
                    type: 'POST',
                    data: {offID: $('#offIDval').val(), depID: $('#depIDval').val(), offFirstname: $('#offFirstnameval').val(), offLastname: $('#offLastnameval').val(), offBirthday: $('#offBirthdateval').val(), offRank: $('#offRankval').val()},
                    success: function(response) {
                        $('#test').html(response);
                    }
                });
            }
            });





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
                

            
            }