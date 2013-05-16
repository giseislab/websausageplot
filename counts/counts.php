<?php

# header files
$SGRAMDIR = "../../spectrograms";
#$SGRAMDIR = "http://www.aeic.alaska.edu/spectrograms";
$INCLUDES = "$SGRAMDIR/includes";
$CSS = "$SGRAMDIR/css";
include("$INCLUDES/antelope.php");
include("includes/fetchsubnets.php");
#include("includes/placesdb2subnets.php");
include("$INCLUDES/curPageURL.php");
include("$INCLUDES/findprevnextsubnets.php");
include("$INCLUDES/scriptname.php");
include("$INCLUDES/mosaicMakerTable.php"); # for epoch2YmdHM function
#include("$INCLUDES/valvegeographicalfilters2latlonrange.php"); 

# Standard XHTML header
$page_title = "$subnet Counts";
$css = array( "$CSS/newspectrograms.css", "$CSS/sgram10min.css" );
$googlemaps = 0;
$js = array();
include("$INCLUDES/header.php");
$timeperiodoptions = array('month' => 'last month', 'year' => 'last year', 'total' => 'since the catalog began' );
$webdir = 'plots/';
# filter subnets out that have no plots
$newsubnets = array(); 

foreach ($subnets as $subnetitem) {
	if (file_exists($webdir.$subnetitem."_total.png")) {
		array_push($newsubnets, $subnetitem);
	}
}
$subnets = $newsubnets;
?>

<body>


<?php

	$debugging = !isset($_REQUEST['debugging'])? False : $_REQUEST['debugging'];	
	$subnet = !isset($_REQUEST['subnet'])? "Pavlof" : $_REQUEST['subnet'];	
	$catalog = !isset($_REQUEST['catalog'])? "AVO" : $_REQUEST['catalog'];	
	$timeperiod = !isset($_REQUEST['timeperiod'])? "total" : $_REQUEST['timeperiod'];	
	$timeperiod_label = $timeperiodoptions[$timeperiod];
        date_default_timezone_set('UTC');
	#list ($minlon, $maxlon, $minlat, $maxlat) = valvegeographicalfilters2latlonrange($subnet);
	$countsploturl = $webdir.$subnet."_".$timeperiod.".png";
	list ($previousSubnet, $nextSubnet) = findprevnextsubnets($subnet, $subnets);

	#list ($previousSubnet, $nextSubnet) = findprevnextsubnetswithtotalpng($subnet, $subnets, $catalog);


	if ($debugging) {
		echo "<p>debugging = $debugging</p>\n";
		echo "<p>subnet = $subnet</p>\n";
		echo "<p>catalog = $catalog</p>\n";
		echo "<p>timeperiod = $timeperiod</p>\n";
		echo "<p>$countsploturl</p>\n";
		echo "<p>$subnets</p>\n";
		echo "<hr/>\n";
	}


?>

<!-- Create a menu across the top -->
<div id="nav">
        <ul>
  	<li class="subnetlink">
		<?php
			echo "<a title=\"Jump to the previous subnet along the arc, same time period\" href=\"$scriptname?subnet=$previousSubnet&timeperiod=$timeperiod&catalog=$catalog\">&#9650 ".substr($previousSubnet,0,10)."</a>\n";
		?>
	</li>
  	<li class="subnetpulldown">
		<?php
			# Subnet widgit
                  	echo "<select title=\"Jump to a different subnet\" onchange=\"window.open('?subnet=' + this.options[this.selectedIndex].value + '&timeperiod=$timeperiod&catalog=$catalog', '_top')\" name=\"subnet\">\n";
			echo "\t\t\t<option value=\"$subnet\" SELECTED>".substr($subnet, 0, 10)."</option>\n";
			foreach ($subnets as $subnet_option) {
				print "\t\t\t<option value=\"$subnet_option\">".substr($subnet_option, 0, 10)."</option>\n";
			}
			print "\t\t</select>\n";
		?>
	</li>
  	<li class="subnetlink">
		<?php
			echo "<a title=\"Jump to the next subnet along the arc, same time period\" href=\"$scriptname?subnet=$nextSubnet&timeperiod=$timeperiod&catalog=$catalog\">&#9660 ".substr($nextSubnet,0,10)."</a>\n";
		?>
	</li>
	<?php
		foreach (array_keys($timeperiodoptions) as $timeperiodoption) {
			if ($timeperiodoption != $timeperiod) {
				echo "<li>\n";
				echo "<a title=\"Show counts for ".$timeperiodoptions[$timeperiodoption]."\" href=\"$scriptname?subnet=$subnet&timeperiod=$timeperiodoption&catalog=$catalog\">$timeperiodoption</a>\n";
				echo "</li>\n";
			}
		}
	?>
        </ul>
</div>
<div id="plot">
<?php
 
	# CURRENT PLOT

	if (file_exists($countsploturl)) {
		print "<p/><img src=\"$countsploturl\" alt=\"counts plot image should be here\">\n"; 
	} else {
		if ($timepeiod == "total") {
			print "<p/>No earthquakes ".$timeperiodoptions[$timeperiod]."</p>";
		} else {
			print "<p/>No earthquakes in the ".$timeperiodoptions[$timeperiod]."</p>";
		}
	}
?>

<br/>


</body>
</html>

