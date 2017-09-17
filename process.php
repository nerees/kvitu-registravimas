<?php
require 'db.php';
$db = new Db();

$fname = $_POST['FNAME'];
$email = $_POST['EMAIL'];
$tel = $_POST['TEL'];
$kvnr = $_POST['KVNR'];
$exists = $db -> select("SELECT * FROM `kvitai` WHERE kvnr = $kvnr");

if(!empty($fname) && !empty($email) && !empty($tel) && !empty($kvnr) && empty($exists)){
	//Formos duomenys keliauja į duomenų bazę
	$result = $db -> query("INSERT INTO `kvitai` (`fname`,`email`,`tel`,`kvnr`) VALUES ('$fname','$email','$tel','$kvnr')");
	echo "done";
}
else{	
	echo "fail";
}
?>