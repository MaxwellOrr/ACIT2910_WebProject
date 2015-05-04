
    $( "#Logout" ).click(function() {


$.ajax({
                    url: 'PHP/logout.php',
                    type: 'GET',
                    dataType: "json",
                    data: {naem: null},
                    success: function(response) {
                        window.location.assign("../index.html");
                    }
                });
        });
