<?php
$subnets = array();
foreach (glob("plots/*_total.png") as $filename) {
	$bname = basename($filename);
	print "$basename\n";
	$pieces = explode("/\[/_]/", $filename);
	$fileparts = explode("/", $filename);
	$pieces = explode("_", $fileparts[1]);
	array_push($subnets, $pieces[0]);
}

?>
