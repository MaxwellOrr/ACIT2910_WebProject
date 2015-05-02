$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Table of people',
				paging: true, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'incID ASC', //Set default sorting
				actions: {
					searchAction: 'PersonActions.php?action=search',
					listAction: 'PersonActions.php?action=list',
					createAction: 'PersonActions.php?action=create',
					updateAction: 'PersonActions.php?action=update',
					deleteAction: 'PersonActions.php?action=delete'
				},
				fields: {
					incID: {
						title: 'Incident ID',
						width: '20%',
						key: true,
						create: true,
						edit: true
					},
					incAddress: {
						title: 'Incident Address',
						width: '40%'
					},
					incType: {
						title: 'Incident Type',
						width: '20%'
					}
					
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});
