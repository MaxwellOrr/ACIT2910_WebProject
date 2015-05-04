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
                                createopt = 'PHP/Incident.php?action=create';
                                editopt = 'PHP/Incident.php?action=update';
                                deleteopt = 'PHP/Incident.php?action=delete';
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
            
            
           
            
             if(edit == true){
                                   $('#test').append("step 2 working");
                                }
                                else{
                                    $('#test').append("step 2 Not working");
                                }
            

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Incident',
				paging: true, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'incID ASC', //Set default sorting
             toolbarsearch:true,
				actions: {
					listAction: 'PHP/Incident.php?action=list',
					createAction: createopt,
					updateAction: editopt,
					deleteAction: deleteopt
				},
				fields: {
					incID: {
						title: 'Incident ID',
						width: '20%',
						key: true,
                      create: window.edit, 
                        edit: window.edit
                        
                    
					},
					incAddress: {
						title: 'Incident Address',
						width: '100%',
                      create: window.edit, 
                        edit: window.edit
					},
					incType: {
						title: 'Incident Type',
						width: '100%',
                        options: { 'Assault': 'Assault', 'Battery': 'Battery',
                                 'False Imprisonment': 'False Imprisonment', 'Kidnapping': 'Kidnapping',
                                 'Homicide': 'Homicide', 'Sexual assault': 'Sexual assault',
                                 'Larceny': 'Larceny', 'Robbery': 'Robbery',
                                 'Burglary': 'Burglary', 'Arson': 'Arson',
                                 'Embezzlement': 'Embezzlement', 'Forgery': 'Forgery',
                                 'False pretenses': 'False pretenses', 'Attempt': 'Attempt',
                                 'Solicitation': 'Solicitation', 'Conspiracy': 'Conspiracy',
                                 'DUI': 'DUI'},
                      create: window.edit, 
                        edit: window.edit
					}
					
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');
              
            

		};