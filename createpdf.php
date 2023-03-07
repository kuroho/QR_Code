<?php
include "inc/qrcode/qrlib.php";
include "inc/functions.php";
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QR Code</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="page" class="container">
	<div id="header">
        <div id="logo">
            <img src="images/qr-code-icon.png" alt="" height="150" width="150" />
        </div>
        <div id="section">
			<h1><a href="#">QR Code</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="index.php" accesskey="1" title="">Générer un QR Code</a></li>
				<li><a href="read.php" accesskey="2" title="">Lire un QR Code</a></li>
			</ul>
		</div>
         <div id="section">
			<!--<img src="images/qr-code-icon.png" alt="" height="150" width="150" />-->
			<h1><a href="#">PDF</a></h1>
		</div>
        <div id="menu">
			<ul>
				<li class="current_page_item"><a href="createpdf.php" accesskey="1" title="">Générer un PDF</a></li>
				<li><a href="readpdf.php" accesskey="2" title="">Lire un PDF</a></li>
			</ul>
		</div>
	</div>
	<div id="main">
		<div id="banner">
			<img src="" alt="" class="image-full" />
		</div>
		<div id="welcome">
			<div class="title">
				<h2>Générer un PDF</h2>
				<span class="byline">Un outil simple et rapide afin de générer et lire son propre PDF</span>
			</div>
		</div>
		<form method="post" action="">
			<div id="featured">
				<div class="title">
					<h3>Données</h3>
					<span class="byline">Entrez le contenu qui sera présent à l'intérieur du QR Code de votre PDF</span>
				</div>
				
				<input type="text" name="donnees" required /></br></br>
                <div class="title">
                <span class="byline">(OPTIONNEL) Entrez le texte qui sera présent à l'intérieur du PDF</span></br>
                </div>
                <input type="text" name="texte" /></br></br>
				<input type="submit" name="generer" value="Générer votre PDF"/></br></br>
                <span class="description">Votre fichier PDF se téléchargera automatiquement</span>
				
			</div>
		</form>
		<?php
			if(isset($_POST['generer'])){
                echo '<div id="featured">
                        <div class="title">
                            <h3>Résultat</h3>
                        </div>';
                        $data = CreateQRCodePDF();
                        GeneratePDF($data);
                echo '</div>';
            }else{
                echo '<div id="featured">
                        <div class="title">
                            <h3>Exemple du document</h3>
                        </div>
                        <img border="1px" src="data/pdf/PDF_QR_example.jpg" alt="Example QR Code PDF"></img>
                    </div>';
            }
		?>
		<div id="copyright">
			<span>&copy; Optilian. All rights reserved. | Site by SAM-TOW-WENG Jérémy</span>
		</div>
	</div>
</div>
</body>
</html>
