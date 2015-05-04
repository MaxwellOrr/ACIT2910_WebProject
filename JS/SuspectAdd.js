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
                    url: 'PHP/SuspectAdd.php',
                    type: 'POST',
                    data: {name: $('#suspIDval').val(), incID: $('#incIDval').val(), offID : $('#offIDval').val(), suspFirstName: $('#suspFirstNameval').val(), suspLastName: $('#suspLastNameval').val(), suspGender: $('#suspGenderval').val(), suspBirthday: $('#suspBirthval').val()},
                    success: function(response) {
                        $('#test').html(response);
                    }
                });
            }
            });





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
                    url: 'PHP/offSelect.php',
                    type: 'POST',
                    data: {name: null},
                    success: function(response) {
                        $('#offID').html(response);
                    }
                });
            
            }