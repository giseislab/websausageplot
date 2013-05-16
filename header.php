<?php

# Standard XHTML header
$page_title = "Weekly Seismicity";
# Added left menu which includes left text align for li, but does not make any difference
$css = array( "../spectrograms/css/newspectrograms.css", "../spectrograms/css/mosaicMaker.css", "leftmenu.css" );
$googlemaps = 0;
$js = array('toggle_menus.js', 'toggle_visibility.js');
include('../spectrograms/includes/header.php');
include('../spectrograms/includes/curPageURL.php');
?>

<body>

<!-- Create a menu across the top -->
<div id="nav">
        <ul>
		<?php
			if (!preg_match("/index.php$/",curPageURL())) {
			        echo '<li><a title="Volcanoes active in past week" href="index.php">Last Week</a></li>';
			}
			if (!preg_match("/all.php$/",curPageURL())) {
			        echo '<li><a title="Volcanoes active in last 3 months" href="all.php">Last 3 months</a></li>';
			}
			if (!preg_match("/legend.php$/",curPageURL())) {
			        echo '<li><a title="Show legend" href="legend.php">Legend</a></li>';
			}
		?>
        </ul>
	<a href="http://gi.alaska.edu"><img src="../spectrograms/images/gi-logo-small.png" alt="GI logo small" style="float:right;clear:right;margin:4px"/></a>
</div>
<div>
<br/>
<hr/>
</div>
