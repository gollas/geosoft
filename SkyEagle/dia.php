<?php include 'getobsval.php'; ?>

<!DOCTYPE HTML>
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

	<title>SkyEagle - Diagramm</title>
	<!--link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" /-->
    
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" />
	<link rel="stylesheet" type="text/css" href="lib/css/jquery.mobile-1.3.0.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/leaflet.css">
	<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
	<script src="https://www.google.com/jsapi"></script>
	<script type="text/javascript" src="lib/js/jquery-1.9.1.min.js"></script>
	<script src="https://www.google.com/jsapi"></script>
	<script type="text/javascript" src="lib/js/leaflet.js"></script>
	
	<style>article,#map{width:100%;height:300px;margin:0;padding:0;}.info{padding:6px 8px;font:14px/16px Arial,Helvetica,sans-serif;background:white;background:rgba(255,255,255,0.8);box-shadow:0 0 15px rgba(0,0,0,0.2);border-radius:5px;}.info h4{margin:0 0 5px;color:#777;}#map:-webkit-full-screen{width:100%!important;height:100%!important;}#map:-moz-full-screen{width:100%!important;height:100%!important;}#map:full-screen{width:100%!important;height:100%!important;}.leaflet-control-zoom-fullscreen{background-image:url(http://conmenu.com/resource/js/leaflet_plugins/fullscreen/icon-fullscreen.png);}.leaflet-control-zoom-fullscreen.last{margin-top:5px}</style>

	<script>
	    // Load the Visualization API and the piechart package.
	    google.load('visualization', '1', {'packages':['corechart']});
	     
	
		var jsonData = <?php getValues()  ?>;
		var jsonData2 = <?php getValues("TEMPERATURE")  ?>;
		var jsonData3 = <?php getValues("AIR_HUMIDITY") ?>;
	
	//function to draw the chart
	    function drawChart() {
	
	    	// Create our data table out of JSON data loaded from server.
	          var data = new google.visualization.DataTable(jsonData);
	          var data2 = new google.visualization.DataTable(jsonData2);
	          var data3 = new google.visualization.DataTable(jsonData3);
	
	          // Instantiate and draw our chart, passing in some options.
	          var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
	          var chart2 = new google.visualization.LineChart(document.getElementById('chart2_div'));
	          var chart3 = new google.visualization.LineChart(document.getElementById('chart3_div'));
	          
	          chart.draw(data, {width: 400, height: 240});
	          chart2.draw(data2, {width: 400, height: 240});
	          chart3.draw(data3, {width: 400, height: 240});
	        }
		
	
	
		// json-object are empty, do nothing	
		if (jsonData == "" || jsonData2 == "" || jsonData3 == ""){
		}
		// else draw the charts
		else {
	    // Set a callback to run when the Google Visualization API is loaded.
	    google.setOnLoadCallback(drawChart);
	   	}
	</script>
	
	<script type="text/javascript" src="lib/js/jquery.mobile-1.3.0.min.js"></script>

</head>

  <body>

	<div data-role="page" id="dia">
	  	<div data-role="header" data-position="fixed">
	  		<a href="index.html" data-rel="back">Zurück</a>
			<!--a href="index.html" data-icon="delete">Cancel</a-->
			<h1>SkyEagle - Diagramm</h1>
			<!--a href="index.html" data-icon="check">Save</a-->
			<div data-role="navbar">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="map.php" rel="external">Karte</a></li>
				<li><a href="#">Diagramm</a></li>
				<li><a href="tabelle.php">Tabelle</a></li>
			</ul>
			</div><!-- /navbar -->
		</div>
		  
		<form action = "dia2.php" method ="post" name="form" data-ajax="false">
			<fieldset>
			<legend>Selecting Test</legend>
			<p>
				<label>Messstation</label>
						<?php 
							include('selopt.php');
						?>
			</p>
			</fieldset>
			
			<fieldset>
			<legend>von - bis</legend>			
			<input  
	       name="startdate" 
	       type="date" 
	       data-role="datebox" 
	       id="datepicker" 
	       value = "2013-03-22"
	       />
	        <input   
	       name="enddate" 
	       type="date" 
	       data-role="datebox" 
	       id="datepicker2" 
	       value = "2013-03-27"
	       />
				<!--input type = "text" 
					id="datepicker"
					name = "startdate"
					value = "2013-03-22"
					/>
					
				<input type = "text"
					id="datepicker2"
					name = "enddate"
					value = "2013-03-27"
					/-->
							
			</fieldset>
			<label><b>Werte</b></label>
			<fieldset data-role="controlgroup" data-type="horizontal">
	    			
				<input type="radio" name="outliers" id="radio-choice-22" value="choice-2"  />
	         	<label for="radio-choice-22">unbereinigte</label>
	
	         	<input type="radio" name="outliers" id="radio-choice-23" value="choice-3"  />
	         	<label for="radio-choice-23">bereinigte</label>
			</fieldset>
			<fieldset data-role="controlgroup" data-type="horizontal">	
				
							
				<input type = "checkbox"
					id = "chkCO"
					value = "CO_CONCENTRATION"
					name = "observation[]" />
				<label for = "chkCO">CO</label>
				
				<input type = "checkbox"
					id = "chkNO2"
					value = "NO2_CONCENTRATION"
					name = "observation[]" />
				<label for = "chkNO2">NO2</label>
				<!--input type = "checkbox"
					id = "chkNO2"
					value = "NO2_CONCENTRATION"
					name = "observation[]" />
				<label for "chkNO2">NO2</label-->
							
				<input type = "checkbox"
					id = "chkO3"
					value = "O3_CONCENTRATION"
					name = "observation[]" />
				<label for = "chkO3">O3</label>
				<input type = "checkbox"
					id = "chkSO2"
					value = "SO2_CONCENTRATION"
					name = "observation[]" />
				<label for = "chkSO2">SO2</label>
				
				<input type = "checkbox"
					id = "chkPM10"
					value = "PM10"
					name = "observation[]" />
				<label for = "chkPM10">PM10</label>	
					
			</p>
			</fieldset>
			<fieldset>
				<input type="submit" value="Anzeigen" />
			</fieldset>	
			
		</form>
		
	    <div id="chart_div"></div>
	    <div id="chart2_div"></div>
	    <div id="chart3_div"></div>
   </div>

  </body>

</html>