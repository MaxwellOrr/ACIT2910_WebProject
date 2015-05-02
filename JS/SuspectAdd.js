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
                    dataType: 'JSON',
                    data: {name: null, incType: null},
                    success: function(response) {
                        $.each(response, function(key, val) {
                        $('#incIDval').append('<option>' + val.incID + '</option>');
                        });
                    }
                });
                
                 $.ajax({
                    url: 'PHP/offSelect.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {name: null},
                    success: function(response) {
                        $.each(response, function(key, val) {
                        $('#offIDval').append('<option>' + val.offID + '</option>');
                        });
                    }
                });
            
            }