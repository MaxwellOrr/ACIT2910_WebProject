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
                    url: 'PHP/offEdit.php',
                    type: 'POST',
                    data: {offID: $('#offIDval').val(), depID: $('#depIDval').val(), offFirstname: $('#offFirstnameval').val(), offLastname: $('#offLastnameval').val(), offBirthday: $('#offBirthdateval').val(), offRank: $('#offRankval').val()},
                    success: function(response) {
                        $('#test').html(response);
                    }
                });
            }
            });





window.onload = function(){
				document.getElementById('offIDop').value += sessionStorage.editID;
    			document.getElementById('offIdDiv').innerHTML += sessionStorage.editID;
            	$.ajax({
                    url: 'PHP/depSelect.php',
                    type: 'get',
                    data: {name: null, incType: null},
                    success: function(response) {
                        $('#depID').html(response);
                    }
                });
                

            
            }