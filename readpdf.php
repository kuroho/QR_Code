<?php 
    include "inc/functions.php";
?>

<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>QR Code</title>
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/fonts.css" rel="stylesheet" type="text/css" media="all" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<style>
 
#scroll {
  list-style-type: none;
  height: 500px;
  overflow: auto;
}
 
#pdf:hover {
  background: #eee;
  cursor: pointer;
}

</style>

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
				<li><a href="createpdf.php" accesskey="1" title="">Générer un PDF</a></li>
				<li class="current_page_item"><a href="readpdf.php" accesskey="2" title="">Lire un PDF</a></li>
			</ul>
		</div>
	</div>
	<div id="main">
		<div id="banner">
			<img src="" alt="" class="image-full" />
		</div>
		<div id="welcome">
			<div class="title">
				<h2>Lire un PDF</h2>
				<span class="byline">Un outil simple et rapide afin de générer et lire son propre PDF</span>
			</div>
		</div>
		
        <form method="post" action="" enctype="multipart/form-data">
            <div id="featured">
                <div class="title">
                    <h3>Importez votre PDF</h3>
                    <span class="byline">Importez votre PDF contenant un QR Code</span></br>
                </div>
                <div>
                    <input type="file" name="file" id="file" accept="application/pdf" required/></br></br>
                    <input type="submit" name="generer" value="Lire votre fichier pdf"/>
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST['generer'])){
                $result = ReadPDF();
            }
		?>
        <div id="featured">
            <div class="title">
                <h3>PDF scannés</h3>
                <span class="byline">Liste de vos PDF précédents (Du plus ancien au plus récent)</span></br>
            </div>
            <div>
                <?php
                    GetListePDF();
                ?>
            </div>
        </div>   

		<div id="copyright">
			<span>&copy; Optilian. All rights reserved. | Site by SAM-TOW-WENG Jérémy</span>
		</div>
	</div>
</div>
</body>
</html>
