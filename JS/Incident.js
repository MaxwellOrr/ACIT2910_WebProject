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
            selecting: true, //Enable selecting
            multiselect: true, //Allow multiple selecting
            selectingCheckboxes: true, //Show checkboxes on first column
            //selectOnRowClick: false,
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
						width: '30%',
                      create: window.edit, 
                        edit: window.edit
					},
                    incDate: {
						title: 'Incident Date',
						list: false,
                        type: 'date',
                    displayFormat: 'mm/dd/yy',
                      create: window.edit, 
                        edit: window.edit
					},
                    
					incType: {
						title: 'Incident Type',
						width: '30%',
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
					},
                    incRegion: {
						title: 'Incident Region',
						width: '30%',
                       
                        options: { '1': 'Northwest', '2': 'North',
                                 '3': 'Northeast', '4': 'West',
                                 '5': 'Central', '6': 'East',
                                 '7': 'Southwest', '8': 'South',
                                 '9': 'Southeast'},
                      create: window.edit, 
                        edit: window.edit
					},
                    incReport: {
                        title: 'Incident Report',
                        list: false,
                        type: 'textarea',
                        create: window.edit,
                        edit: window.edit
                    },
                    incEvidence: {
                        title: 'Incident Evidence',
                        list: false,
                        type: 'textarea',
                        create: window.edit,
                        edit: window.edit
                    },
                    vehType: {
                        title: 'Vehicle Type',
						list: false,
                        options: { 'Truck': 'Truck', 'Sedan': 'Sedan',
                                 'Sports Car': 'Sports Car', 'Bike': 'Bike'},
                      create: window.edit, 
                        edit: window.edit
                    },
                    
                    vehRegNum: {
                        title: 'Vehicle Registration Number',
						list: false,
                      create: window.edit, 
                        edit: window.edit
                    },
                    weapID: {
                        title: 'Weapon ID',
                        list: false,
                        create: window.edit, 
                        edit: window.edit
                },
                    weapType: {
                       title: 'Weapon Type',
                        list: false,
                        create: window.edit, 
                        edit: window.edit
                }
                    
                },
                    selectionChanged: function () {
                //Get all selected rows
                var $selectedRows = $('#PeopleTableContainer').jtable('selectedRows');
 
                $('#SelectedRowList').empty();
                if ($selectedRows.length > 0) {
                    //Show selected rows
                    $selectedRows.each(function () {
                        var record = $(this).data('record');
                        $('#SelectedRowList').append(
                            '<b>Incident ID</b>: ' + record.incID +
                            '<br /><b>Incident Type</b>: ' + record.incType +
                            '<br /><b>Incident Report</b>: ' + record.incReport +
                            '<br /><b>Incident Evidence</b>: ' + record.incEvidence +
                            '<br /><b>Vehicle Type</b>: ' + record.vehType + 
                            '<br /><b>Weapon Type</b>: ' + record.weapType + '<br /><br />'
                            );
                    });
                } else {
                    //No rows selected
                    $('#SelectedRowList').append('No row selected! Select rows to see here...');
                }
            }, 
                
           

					
				
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');
              
            

		};