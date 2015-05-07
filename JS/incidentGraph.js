        var skillsChart;
        var counter = 0;
$('#sbmt').click(function() {
    if(counter > 0){
        skillsChart.destroy();
    }
        
        
        var region1 = 0;
        var region2 = 0;
        var region3 = 0;
        var region4 = 0;
        var region5 = 0;
        var region6 = 0;
        var region7 = 0;
        var region8 = 0;
        var region9 = 0;
       var assault = 0;
       var battery = 0;
       var false_imprisonment = 0;
       var kidnapping = 0;
       var homicide = 0;
       var sexual_assault = 0;
       var larceny = 0;
       var robbery = 0;
       var burglary = 0;
       var arson = 0;
       var embezzlement = 0;
       var forgery = 0;
       var false_pretenses = 0;
       var attempt = 0;
       var solicitation = 0;
       var conspiracy = 0;
       var dui = 0;

    if (document.getElementById('region1').checked) {
                                region1 = 1;
                            }
     if (document.getElementById('region2').checked) {
                                region2 = "2";
                            }
     if (document.getElementById('region3').checked) {
                                region3 = 3;
                            }
     if (document.getElementById('region4').checked) {
                                region4 = 4;
                            }
     if (document.getElementById('region5').checked) {
                                region5 = 5;
                            }
     if (document.getElementById('region6').checked) {
                                region6 = 6;
                            }
     if (document.getElementById('region7').checked) {
                                region7 = 7;
                            }
     if (document.getElementById('region8').checked) {
                                region8 = 8;
                            }
     if (document.getElementById('region9').checked) {
                                region9 = 9;
                            }
       
    
    $.ajax({
                    url: 'PHP/Pie.php',
                    type: 'POST',
                    dataType: "json",
                    data: {Region1: region1, Region2: region2, Region3: region3,
                          Region4: region4, Region5: region5, Region6: region6,
                          Region7: region7, Region8: region8, Region9: region9},
                    success: function(data) {
                                                $.each(data, function(key, val) {
                            if (document.getElementById('assault').checked) {
                                assault = val.assault
                            }
                            if (document.getElementById('battery').checked) {
                                battery = val.battery;
                            }
                            if (document.getElementById('false_imprisonment').checked) {
                                false_imprisonment = val.false_imprisonment;
                            }
                            if (document.getElementById('kidnapping').checked) {
                                kidnapping = val.kidnapping;
                            }
                            if (document.getElementById('homicide').checked) {
                                homicide = val.homicide;
                            }
                            if (document.getElementById('sexual_assault').checked) {
                                sexual_assault = val.sexual_assault;
                            }
                            if (document.getElementById('larceny').checked) {
                                larceny = val.larceny;
                            }
                            if (document.getElementById('robbery').checked) {
                                robbery = val.robbery;
                            }
                            if (document.getElementById('burglary').checked) {
                                burglary = val.burglary;
                            }
                            if (document.getElementById('arson').checked) {
                                arson = val.arson;
                            }
                            if (document.getElementById('embezzlement').checked) {
                                embezzlement = val.embezzlement;
                            }
                            if (document.getElementById('forgery').checked) {
                                forgery = val.forgery;
                            }
                            if (document.getElementById('false_pretenses').checked) {
                                false_pretenses = val.false_pretenses;
                            }
                            if (document.getElementById('attempt').checked) {
                                attempt = val.attempt;
                            }
                            if (document.getElementById('solicitation').checked) {
                                solicitation = val.solicitation;
                            }
                            if (document.getElementById('conspiracy').checked) {
                                conspiracy = val.conspiracy;
                            }
                            if (document.getElementById('dui').checked) {
                                dui = val.dui;
                            }
                            if (document.getElementById('all').checked){
                                assault = val.assault;
                                battery = val.battery;
                                false_imprisonment = val.false_imprisonment;
                                kidnapping = val.kidnapping;
                                homicide = val.homicide;
                                sexual_assault = val.sexual_assault;
                                larceny = val.larceny;
                                robbery = val.robbery;
                                burglary = val.burglary;
                                arson = val.arson;
                                embezzlement = val.embezzlement;
                                forgery = val.forgery;
                                false_pretenses = val.false_pretenses;
                                attempt = val.attempt;
                                solicitation = val.solicitation;
                                conspiracy = val.conspiracy;
                                dui = val.dui;
                            }
                        });

    

                        /* data will hold the php array as a javascript object */
                       
                
	 var pieData = [

  							{
     						value: assault,
     						label: 'assault',
      						color: '#1abc9c'
   							},
   							{
      						value: false_imprisonment,
      						label: 'false imprisonment',
      						color: '#2ecc71'
   							},
   							{
      						value: kidnapping,
      						label: 'kidnapping',
      						color: '#3498db'
   							},
   							{
      						value: battery,
      						label: 'battery',
      						color: '#9b59b6'
   							},
   							{
      						value: homicide,
      						label: 'homicide',
      						color: '#34495e'
   							},
   							{
      						value: sexual_assault,
      						label: 'sexual assault',
      						color: '#f1c40f'
   							},
   							{
      						value: larceny,
      						label: 'larceny',
      						color: '#27ae60'
   							},
   							{
      						value: robbery,
      						label: 'robbery',
      						color: '#2980b9'
   							},
   							{
      						value: burglary,
      						label: 'burglary',
      						color: '#8e44ad'
   							},
   							{
      						value: arson,
      						label: 'arson',
      						color: '#2c3e50'
   							},
   							{
      						value: embezzlement,
      						label: 'embezzlement',
      						color: '#f1c40f'
   							},
         {
      						value: forgery,
      						label: 'Forgery',
      						color: '#7f8c8d'
   							},
   							{
      						value: false_pretenses,
      						label: 'false pretenses',
      						color: '#e67e22'
   							},
   							{
      						value: attempt,
      						label: 'attempt',
      						color: '#e74c3c'
   							},
   							{
      						value: solicitation,
      						label: 'solicitation',
      						color: '#ecf0f1'
   							},
   							{
      						value: conspiracy,
      						label: 'conspiracy',
      						color: '#95a5a6'
   							},
   							{
      						value: dui,
      						label: 'dui',
      						color: '#f39c12'
   							}
							];
							
var Bardata = {
    labels: ["assault", "false imprisonment", "kidnapping", "battery", "homicide", "sexual assault", "larceny"
    , "robbery", "burglary", "arson", "embezzlement", "false pretenses", "attempt", "solicitation", "conspiracy" , "dui"],
    datasets: [
        {
            label: "Crime Type Bar",
            fillColor: "rgba(231, 76, 60,1.0)",
            strokeColor: "rgba(142, 68, 173,1.0)",
            highlightFill: "rgba(192, 57, 43,1.0)",
            highlightStroke: "rgba(41, 128, 185,1.0)",
            data: [assault, false_imprisonment, kidnapping, battery, homicide, sexual_assault, larceny
            , robbery, burglary, arson, embezzlement, false_pretenses, attempt, solicitation, conspiracy, dui]
        }
    ]
};
							
      
var context = document.getElementById('PieType').getContext('2d');

//global skillChart;
skillsChart = new Chart(context).Pie(pieData);
counter++;
$('#content').append(assault + 'Graph should work! ');
                    }
});

        });
      $('#clr').click(function() {
//global skillChart;
skillsChart.destroy();
      
      });