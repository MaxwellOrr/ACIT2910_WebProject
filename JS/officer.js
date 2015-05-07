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
                                createopt = 'PHP/officerMain.php?action=create';
                                editopt = 'PHP/officerMain.php?action=update';
                                deleteopt = 'PHP/officerMain.php?action=delete';
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
				title: 'Officers',
				paging: true, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'offID ASC', //Set default sorting
             toolbarsearch:true,
				actions: {
					listAction: 'PHP/officerMain.php?action=list',
					createAction: createopt,
					updateAction: editopt,
					deleteAction: deleteopt
				},
				fields: {
					offID: {
						title: 'Officer ID',
						width: '20%',
						key: true,
						create: true,
						edit: true
					},
					depID: {
						title: 'Department ID',
                        options: 'PHP/officerMain.php?action=getdep',
						width: '40%'
					},
					offFirstname: {
						title: 'Officer First Name',
						width: '20%'
					}
                    ,
					offLastname: {
						title: 'Officer Last Name',
						width: '20%'
					},
					offRank: {
						title: 'Officer Rank',
                        options: { 'Chief Constable': 'Chief Constable', 'Deputy Chief Constable': 'Deputy Chief Constable',
                                 'Staff Superintendent': 'Staff Superintendent', 'Superintendent': 'Superintendent',
                                 'Staff Inspector': 'Staff Inspector', 'Inspector': 'Inspector',
                                 'Sergeant Major': 'Sergeant Major', 'Staff Sergeant': 'Staff Sergeant',
                                 'Detective': 'Detective', 'Detective Constable': 'Detective Constable',
                                 'Police Constable 2nd Class': 'Police Constable 2nd Class', 
                                  'Police Constable 3rd Class': 'Police Constable 3rd Class',
                                 'Police Constable 4th Class': 'Police Constable 4th Class', 'Cadet': 'Cadet'},
						width: '20%'
					},
                    offBirthday: {
						title: 'Officer Birthday',
						list: false,
                        type: 'date',
                    displayFormat: 'mm/dd/yy',
                      create: window.edit, 
                        edit: window.edit
					},
					
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		};