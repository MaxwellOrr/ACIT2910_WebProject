var edit = true;
          var test;
          var createopt;
          var editopt;
          var deleteopt;

           window.onload = function(){
            	$.ajax({
                    url: 'PHP/Session.php',
                    type: 'GET',
                    dataType: "json",
                    data: {name: null, incType: null},
                    success: function(response) {
                        $.each(response, function(key, val) {
                        $userName = val.user;
                        var permission = parseInt(val.permission);
                            if(permission > 1){
						       edit = true;
                                test = 2;
                                createopt = 'PHP/suspectMain.php?action=create';
                                editopt = 'PHP/suspectMain.php?action=update';
                                deleteopt = 'PHP/suspectMain.php?action=delete';
                               $('#test').append("step 1 working ");
                                Table();
                            }
                            else{
                             edit = false;
                            createopt = null;
                            editopt = null;
                            deleteopt = null;
                                Table();
                            }
                            
                        });
                    }
                });
                }
		function Table() {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Suspect',
				paging: true, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'suspID ASC', //Set default sorting
             toolbarsearch:true,
				actions: {
					listAction: 'PHP/suspectMain.php?action=list',
					createAction: createopt,
					updateAction: editopt,
					deleteAction: deleteopt
				},
				fields: {
					suspID: {
						title: 'Suspect ID',
						width: '20%',
						key: true,
						create: true,
						edit: true
					},
                    incID: {
						title: 'Incident ID',
						list: false,
                        options: 'PHP/suspectMain.php?action=getInc',
                      create: window.edit, 
                        edit: window.edit
					},
                    offID: {
						title: 'Officer ID',
						list: false,
                        options: 'PHP/suspectMain.php?action=getOff',
                      create: window.edit, 
                        edit: window.edit
					},
                    suspBirthday: {
						title: 'Suspect Birthday',
						list: false,
                        type: 'date',
                    displayFormat: 'mm/dd/yy',
                      create: window.edit, 
                        edit: window.edit
					},
					suspFirstname: {
						title: 'Suspect First Name',
						width: '30%'
					}
                    ,
					suspLastname: {
						title: 'Suspect Last Name',
						width: '30%'
					},
					suspGender: {
						title: 'Suspect Gender',
						width: '20%',
                        options: { 'Male': 'Male', 'Female': 'Female' }
					}
					
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		};