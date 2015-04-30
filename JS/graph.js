jQuery(document).ready(function($) {
                     $assault = 10;
                     $battery  = 0;
                     $homicide  = 0;
                     var pieData;
                     $('.btnadd').click(function(){
    			makeAjaxRequest();
    		});

function makeAjaxRequest() {
$.ajax({
                    url: 'PHP/Pie.php',
                    type: 'GET',
                    data: {name: null, incType: null},
                    success: function(data) {
                     var data = data;
                    },
                    error: function (data) {
                    assault = 1;
                    }
                }); 
                }; 
                
                    
      
      
        var pieData = [
  										 {
     					value: data.assault,
     							label: 'assault',
      							color: '#34495e'
   							},
   							{
      						value: 2,
      						label: 'battery',
      						color: '#95a5a6'
   							},
   							{
      						value: data.homicde,
      						label: 'homicide',
      						color: '#bdc3c7'
   							}
							];
      
var context = document.getElementById('PieType').getContext('2d');
var skillsChart = new Chart(context).Pie(pieData);
});