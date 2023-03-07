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
				<li class="current_page_item"><a href="#" accesskey="2" title="">Lire un QR Code</a></li>
			</ul>
		</div>
         <div id="section">
			<!--<img src="images/qr-code-icon.png" alt="" height="150" width="150" />-->
			<h1><a href="#">PDF</a></h1>
		</div>
        <div id="menu">
			<ul>
				<li><a href="createpdf.php" accesskey="1" title="">Générer un PDF</a></li>
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
				<h2>Lire un QR Code</h2>
				<span class="byline">Un outil simple et rapide afin de générer et lire son propre QR Code</span>
			</div>
		</div>
		
        <form method="post" action="" enctype="multipart/form-data">
            <div id="featured">
                <div class="title">
                    <h3>Importez votre QR Code</h3>
                    <span class="byline">Importez votre QR Code sous forme d'image (.png, .jpg, .bmp)</span></br>
                    <span class="description">(il vous faudra d'abord rogner votre QR Code, avec Paint, Photoshop ou autres logiciels d'édition d'image)</span>
                </div>
                <div id="qrfile">
                    <input type="file" name="qrcode" accept="image/*" required ></br></br>
                    <input type="submit" name="analyse" value="Décoder QR Code">
                </div>
            </div>
        </form>
    
		<?php
            if(isset($_POST['analyse'])){
                readQRCode($_FILES);
            }
        ?>
		
		<div id="copyright">
			<span>&copy; Optilian. All rights reserved. | Site by SAM-TOW-WENG Jérémy</span>
		</div>
	</div>
</div>
</body>
</html>



