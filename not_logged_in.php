<?php
// Rodomos prisijungimo klaidos 
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>
<html lang="LT">
<head>
	<meta charset="utf-8">
    <!-- ===========================
    INFORMACIJA
    =========================== -->    
    <meta name="description" content="KALĖDINIS LOTO, Registruok pirkimo kvitą ir laimėk vertingus prizus">
    <meta name="keywords" content="Kalėdos, Kalėdinis, loterija, loto">
        
    <!-- ===========================
    PUSLAPIO PAVADINIMAS
    =========================== -->
    <title>LOTERIJA - Prisijungti</title>
    
    <!-- ===========================
    FAVICONS
    =========================== -->
    <link rel="icon" href="img/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-ipad-retina.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-iphone.png" />
    
    <!-- ===========================
    CSS
    =========================== --> 
    
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/loginform.css">
	
</head>
<body>

<!-- Prisijungimo forma -->
	<form method="post" action="duom.php" name="loginform">
		<header>PRISIJUNGTI</header>
		<label><b>VARTOTOJO VARDAS</b> (test)</label>
		<input type="text" name="user_name" required />
		<label><b>SLAPTAŽODIS</b> (testtest)</label>
		<input type="password" name="user_password" autocomplete="off" required />
		<input type="submit"  name="login" value="Prisijungti" class="btn btn-inverse"/>
		<center><a href="register.php">Sukurti paskyrą</a></center>
	</form>


</body>
</html>