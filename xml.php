<?php

//require_once("pages/download.php");

$lnk = $_GET['link'];

//new download(".\\download\\".$lnk.".xml");

//header('Content-Type: application/xml');
//header('Content-disposition: attachment;filename=download/'.$lnk.'.xml');
//readfile('download/'.$lnk.'.xml');

header('Content-Type: application/pdf');
header('Content-Length: 202');
header('Content-Disposition: attachment; name="field2"; filename="'.$lnk.'"');
$fp=fopen(''.$lnk.'','r');
fpassthru($fp);
fclose($fp);


?>