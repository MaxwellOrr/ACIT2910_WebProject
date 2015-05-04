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
						width: '20%'
					}
					
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		};