<?php 

require_once('../connections/tc.php'); 
require_once('../include/auth.php');
require_once('../include/settings.php');

$page_title = "Setup: Values";	  


/*************************************************************************************************************************************************************
POST gegevens wegschrijven naar de database of value lijst weergeven
**************************************************************************************************************************************************************/
if (isset($_POST['submit'])) 
{  
 

 $prefix= mysql_real_escape_string(htmlspecialchars($_POST['prefix'])); 
 $unit = mysql_real_escape_string(htmlspecialchars($_POST['unit'])); 
 $par1 = mysql_real_escape_string(htmlspecialchars($_POST['par1'])); 
 $type = mysql_real_escape_string(htmlspecialchars($_POST['type']));
 $display = mysql_real_escape_string(htmlspecialchars($_POST['display']));
 $input_output = mysql_real_escape_string(htmlspecialchars($_POST['input_output']));
 $input_control = mysql_real_escape_string(htmlspecialchars($_POST['input_control']));
 $input_slider_min = mysql_real_escape_string(htmlspecialchars($_POST['input_slider_min_val']));
 $input_slider_max = mysql_real_escape_string(htmlspecialchars($_POST['input_slider_max_val']));
 $input_step = mysql_real_escape_string(htmlspecialchars($_POST['input_step_val']));
 $input_step = str_replace(",", ".", $input_step); //Als een gebruiker 0,5 invoerd slaan we de data op als 0.5
 $graph_hours = mysql_real_escape_string(htmlspecialchars($_POST['graph_hours']));
 $graph_min_ticksize = mysql_real_escape_string(htmlspecialchars($_POST['graph_min_ticksize']));
 $graph_type = mysql_real_escape_string(htmlspecialchars($_POST['graph_type']));
  
//1=wiredin 2=variable
//Als het wiredin betreft of een variable met output geselecteerd gaat het om een output gaan dus zetten we alle input velden op 0
if ($_POST['type'] == 1 || $_POST['type'] == 2 && $_POST['input_output'] == 2 ) {
	$input_output = "2"; // wiredanalog is output vanuit de nodo richting webapp
	$input_control = "0";
	$input_slider_min = "0";
	$input_slider_max = "0";
	$input_step = "0";
		
	}

	else {
	
	//Een grafiek gebruiken we niet bij een output dus eventuele postdata leegmaken.
	$graph_hours = "";
	$graph_min_ticksize = "";
	$graph_type = "";
	
	
	}

 
 if ($_POST['display'] == 1) {
	$suffix = mysql_real_escape_string(htmlspecialchars($_POST['suffix']));
	}
	
 else {
	$suffix = "";
 }
 
 if ($_POST['display'] == 2) {
 
	 $suffix_true = mysql_real_escape_string(htmlspecialchars($_POST['suffix_true']));
	 $suffix_false = mysql_real_escape_string(htmlspecialchars($_POST['suffix_false']));
	 }
 
 else {
 
	 $suffix_true = "";
	 $suffix_false = "";
 }
 
 
  
 // save the data to the database 
 mysql_select_db($database_tc, $tc);
 
   
 mysql_query("INSERT INTO nodo_tbl_sensor (sensor_type, display, input_output, input_control, input_step, input_min_val, input_max_val, sensor_prefix, sensor_suffix, sensor_suffix_true, sensor_suffix_false, user_id, nodo_unit_nr,par1,graph_hours,graph_min_ticksize,graph_type) 
 VALUES 
 ('$type','$display','$input_output','$input_control','$input_step','$input_slider_min','$input_slider_max','$prefix','$suffix','$suffix_true','$suffix_false','$userId','$unit','$par1','$graph_hours','$graph_min_ticksize','$graph_type')");
 // once saved, redirect back to the view page 
 header("Location: values.php#saved");    }
 
else 
{
mysql_select_db($database_tc, $tc);
$RSsensor_result = mysql_query("SELECT * FROM nodo_tbl_sensor WHERE user_id='$userId'") or die(mysql_error());  
}
/*************************************************************************************************************************************************************
/POST gegevens wegschrijven naar de database of value lijst weergeven
**************************************************************************************************************************************************************/
?>




<!DOCTYPE html> 
<html> 
 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title><?php echo $title ?></title> 
	<?php require_once('../include/jquery_mobile.php'); ?>
</head> 
 
<body> 

<!-- Start of main page: -->

<div data-role="page" pageid="main">
 
	<?php require_once('../include/header_admin.php'); ?>
 
	<div data-role="content">	
			
	<div data-role="collapsible" data-content-theme="c">
		<h3>Add</h3>

		<form action="values.php" data-ajax="false" method="post"> 
					
		<br>
	
		<label for="select-choice-0" class="select" >Input type:</label>
		<select name="type" id="type" data-native-menu="false" >
			<option value="1" selected="selected">WiredIn</option>
			<option value="2">Variable</option>
		</select>	
		
		<br>
		
		<label for="select-choice-1" class="select" >Display:</label>
		<select name="display" id="display" data-native-menu="false" >
			<option value="1" selected="selected">Value</option>
			<option value="2">State</option>
		</select>				
		
		<br>
		
		<div id="input_output_div">
			<label for="select-choice-3" class="select" >In or output:</label>
		    <select name="input_output" id="input_output" data-native-menu="false" >
				<option value="1" selected="selected">Input</option>
				<option value="2">Output</option>
			</select>
		
		<br>	
		
			<div id="input_div">
				<div id="input_control_div">
					<label for="select-choice-4" class="select" >Input control:</label>
					<select name="input_control" id="input_control" data-native-menu="false" >
						<option value="1" selected="selected">+/- Buttons</option>
						<option value="2">Slider</option>
					</select>
					<br>	
				</div>
				
				<div id="slider_min_max_div">
					<label for="input_slider_min_val">Minimum value:</label>
					<input type="text" name="input_slider_min_val" id="input_slider_min_val" value=""  />
					<br>
					<label for="input_slider_max_val">Maximum value:</label>
					<input type="text" name="input_slider_max_val" id="input_slider_max_val" value=""  />
					<br>
				</div>
				
				<div id="input_step_div">
					<label for="input_step_val">Step: (Example: 0.5)</label>
					<input type="text" name="input_step_val" id="input_step_val" value=""  />
					<br>
				</div>
			
			</div>
			
		</div>
		
		<label for="prefix">Prefix: (Example: Temperature outside:, Door:)</label>
		<input type="text" name="prefix" id="prefix" value=""  />
		
		<br>
		
		<div id="value_div">
			<label for="suffix">Suffix: (Example: &deg;C, M&sup3;)</label>
			<input type="text" name="suffix" id="suffix" value=""  />
			<br>
		</div>
		
		<div id="state_div">
			<label for="suffix_false">Suffix: >0 (Example: Open)</label>
			<input type="text" name="suffix_true" id="suffix_true" value=""  />
			<br>
			<label for="suffix_true">Suffix: <=0 (Example: Closed)</label>
			<input type="text" name="suffix_false" id="suffix_false" value=""  />
			<br>
		</div>
		
		<label for="unit" >Nodo unit: (1...15)</label>
		<input type="text" name="unit" id="unit" value=""  />
		<br>
		<div id="label_wiredanalog_div">
			<label for="name">WiredIn port: (1...8)</label>
		</div>
		<div id="label_variable_div">
			<label for="name">Variable: (1...15)</label>
		</div>
		<input type="text" name="par1" id="par1" value=""  />
		<br>
		<div id="graph_div">
			<label for="graph_hours">Graph: maximum hours to show:</label>
			<input type="text" name="graph_hours" id="graph_hours" value="24"  />
			<br>
			<label for="select-choice-5" class="select" >Graph: minimum tick size x-axis:</label>
			<select name="graph_min_ticksize" id="graph_min_ticksize" data-native-menu="false" >
				<option value="1" selected="selected">Minutes</option>
				<option value="2">Hours</option>
				<option value="3">Days</option>
				<option value="4">Weeks</option>
				<option value="5">Months</option>
			</select>
			<br>
			<!--<label for="select-choice-6" class="select" >Graph type:</label>
			<select name="graph_type" id="graph_type" data-native-menu="false" >
				<option value="1" selected="selected">Line</option>
				
			</select> 
			<br>-->
		</div>
		<br>	
			
	           
		<input type="submit" name="submit" value="Save" >

		
	
	</form> 
			
	</div>		
			
	<div data-role="collapsible" data-collapsed="false" data-content-theme="c">
	<h3>Edit</h3>
	<?php

						   
	echo '<ul data-role="listview" data-split-icon="delete" data-split-theme="a" data-inset="true">';

	 
	// loop through results of database query, displaying them in the table        
	while($RSsensor_row = mysql_fetch_array($RSsensor_result)) 
	{                                
			   
	echo '<li><a href="values_edit.php?id=' . $RSsensor_row['id'] . '" title=Edit data-ajax="false">'. $RSsensor_row['sensor_prefix'] .'</a>';                
	echo '<a href="values_delete_confirm.php?id=' . $RSsensor_row['id'] . '" data-rel="dialog">Delete</a></li>';
	
	}         
	?>
	
	</div>
	
	</div><!-- /content -->
	
	<?php require_once('../include/footer_admin.php'); ?>
	
</div><!-- /main page -->

<!-- Start of saved page: -->
<div data-role="dialog" id="saved">

	<div data-role="header">
		<h1><?php echo $page_title?></h1>
	</div><!-- /header -->

	<div data-role="content">	
		<h2>Setting saved.</h2>
				
		<p><a href="values.php" data-role="button" data-inline="true" data-icon="back">Ok</a></p>	
	
	
	</div><!-- /content -->
	
	
</div><!-- /page saved -->
 <script type="text/javascript">		

$(document).ready(function() {

//Als het document geladen word dan verbergen we onderstaanden divs

$('#state_div').hide();
$('#label_variable_div').hide(); 
$('#input_output_div').hide();
$('#slider_min_max_div').hide(); 



 
	
});

$('#display').change(function() 
{

//Value
if ($(this).attr('value')==1) {   

$('#state_div').hide(); 
$('#value_div').show(); 
//$('#label_wiredanalog_div').show();
//$('#label_variable_div').hide(); 

      

}
//State   
if ($(this).attr('value')==2) {   

$('#state_div').show(); 
$('#value_div').hide(); 
//$('#label_wiredanalog_div').hide(); 
//$('#label_variable_div').show();

 

}


   
});




$('#type').change(function() 
{
//WiredIn
if ($(this).attr('value')==1) {   

$('#label_wiredanalog_div').show();  
$('#label_variable_div').hide();   
$('#input_output_div').hide(); 
$('#graph_div').show(); 

}
  
//Variable
if ($(this).attr('value')==2) {   

$('#label_wiredanalog_div').hide();  
$('#label_variable_div').show(); 
$('#input_output_div').show();  
$('#graph_div').hide(); 
 
}
});


$('#input_output').change(function() 
{

//Input
if ($(this).attr('value')==1) {   
$('#input_div').show();
$('#graph_div').hide();  

}

//Output  
if ($(this).attr('value')==2) {   


$('#input_div').hide(); 
$('#graph_div').show();    


}


   
});
$('#input_control').change(function() 
{

//+/-Buttons
if ($(this).attr('value')==1) {   
$('#slider_min_max_div').hide(); 

}

//Slider 
if ($(this).attr('value')==2) {   

$('#slider_min_max_div').show();   

}


   
});
</script>
</body>
</html>

