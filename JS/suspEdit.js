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
                    url: 'PHP/suspEdit.php',
                    type: 'POST',
                    data: {name: $('#suspIDval').val(), incID: $('#incIDval').val(), offID : $('#offIDval').val(), suspFirstName: $('#suspFirstNameval').val(), suspLastName: $('#suspLastNameval').val(), suspGender: $('#suspGenderval').val(), suspBirthday: $('#suspBirthval').val()},
                    success: function(response) {
                        $('#test').html(response);
                    }
                });
            }
            


window.onload = function(){
				document.getElementById('suspIDop').value += sessionStorage.editID;
    			document.getElementById('suspIdDiv').innerHTML += sessionStorage.editID;
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
            
            };
            });