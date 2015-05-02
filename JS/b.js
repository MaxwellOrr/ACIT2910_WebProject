       $( window ).load(function() {
       var assault;
       var battery;
       var false_imprisonment;
       var kidnapping;
       var homicide;
       var sexual_assault;
       var larceny;
       var robbery;
       var burglary;
       var arson;
       var embezzlement;
       var forgery;
       var false_pretenses;
       var attempt;
       var solicitation;
       var conspiracy;
       var dui;
       
                /* call the php that has the php array which is json_encoded */
                $.getJSON('PHP/Pie.php', function(data) {
                        /* data will hold the php array as a javascript object */
                        $.each(data, function(key, val) {
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
                        false_pretenses = val.false_pretenses;
                        attempt = val.attempt;
                        solicitation = val.solicitation;
                        conspiracy = val.conspiracy;
                        dui = val.dui;
                        });
                
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
      						label: 'sexual_assault',
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
var skillsChart = new Chart(context).Pie(pieData);
var ctx = document.getElementById('BarType').getContext('2d');
new Chart(ctx).Bar(Bardata, {
    barShowStroke: false
});
var ctx2 = document.getElementById('RadarType').getContext('2d');
new Chart(ctx2).Radar(Bardata, {
    pointDot: false
});
$('ul').append(assault + 'Graph should work! ');
});

        });