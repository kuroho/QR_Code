<?php

    use Spipu\Html2Pdf\Html2Pdf;
 
function readQRCode($file){
    try {
        
        //****************************TRAITEMENT QR CODE******************************\\
        
        require("QReader/vendor/autoload.php");
        $QRCodeReader = new Libern\QRCodeReader\QRCodeReader();
        $file = file_get_contents($file['qrcode']['tmp_name']);
        $qrcode_text = $QRCodeReader->decode(base64_encode($file));
        
        //********************************AFFICHAGE***********************************\\
        
        if($qrcode_text){
            echo '<div id="featured">
                    <div class="title">
                        <h3>Résultat</h3>';
                        echo "<p color='green'>QR Code detecté et décodé.</br></p>";
                        echo "<h4> QR Code : </h4>
                        <img src='data/qrcode/read.png' alt='$qrcode_text'>";
            echo "<h4> Données : </h4>";
            if(preg_match("/youtube/", $qrcode_text)){
                echo $qrcode_text."</br>";
                echo preg_replace('/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i','<iframe width="640" height="360" src="http://www.youtube.com/embed/$1?autoplay=1" frameborder="0" allowfullscreen></iframe>',$qrcode_text)."</br></br>";
            }else{
                echo $qrcode_text."</br></br>";
            }

            
        //*********************************ERREUR*************************************\\    
            
        }else{
            echo '<div id="featured">
                    <div class="title">
                        <h3>Résultat</h3>';
            echo "<p color='red'>Aucun QR Code detecté.</p>";
            
        }
        
        echo '</div>
        </div>';
    } catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}

function readPDF(){
    try {

        //****************************TRAITEMENT QR CODE******************************\\
        
        $tmp_id = uniqid();
        move_uploaded_file($_FILES['file']['tmp_name'], 'data/pdf/'.$tmp_id.'.pdf');
        exec("convert 'data/pdf/".$tmp_id.".pdf[0]' 'data/pdf/".$tmp_id.".jpg'");
        
        require("QReader/vendor/autoload.php");
        $QRCodeReader = new Libern\QRCodeReader\QRCodeReader();
        $qrcode_text = $QRCodeReader->decode('data/pdf/'.$tmp_id.'.jpg');
        
        //********************************AFFICHAGE***********************************\\
        
        if($qrcode_text){
            echo '<div id="featured">
                    <div class="title">
                        <h3>Résultat</h3>';
                        echo "<p color='green'>QR Code détecté et décodé.</br></p>";
            echo "<h4> Données : </h4>";
            if(preg_match("/youtube/", $qrcode_text)){
                echo $qrcode_text."</br>";
                echo preg_replace('/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i','<iframe width="640" height="360" src="http://www.youtube.com/embed/$1?autoplay=1" frameborder="0" allowfullscreen></iframe>',$qrcode_text)."</br></br>";
            }else{
                echo $qrcode_text."</br></br>";
            }
            echo "<h4>Fichier pdf : </h4><img src='data/pdf/".$tmp_id.".jpg' border='1px'  alt='pdf'></img>";
        
        //*****************************SAUVEGARDE TEXTE*******************************\\
        
        
            $file = fopen("data/pdf/$tmp_id.txt", "w"); // ouvre le fichier en écriture
            fwrite($file, $qrcode_text); // ecrit l'e-mail dans le fichier
            fclose($file); // ferme le fichier
            
        //*********************************ERREUR*************************************\\    
            
        }else{
            echo '<div id="featured">
                    <div class="title">
                        <h3>Résultat</h3>';
            exec('rm data/pdf/'.$tmp_id.'.pdf');
            exec('rm data/pdf/'.$tmp_id.'.jpg');
            echo "<p color='red'>Aucun QR Code détecté.</p>";
            
        }
        
        echo '</div>
        </div>';
    } catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}

function GetListePDF() {
    echo '<div>
  <ul id="scroll">';
    $scan = scandir("data/pdf");
    foreach($scan as $file){
        $infofile = pathinfo($file);
        if($infofile["extension"] == "pdf"){
            echo '<li id="pdf">';
            echo "<b>Nom du fichier :</b> <a href='data/pdf/".$file."'>".$file."</a>";
        }elseif($infofile["extension"] == "txt"){
            $filetext = fopen('data/pdf/'.$file, "r");
            $textfile = fgets($filetext);
            echo "</br><b> Données : </b> ".$textfile."</br></br>";
            echo '</li>';
        }
    }
    echo '</ul>
</div>';
    
}

function CreateQRCodePDF(){
    $qr = QRcode::png($_POST['donnees'], "data/qrcode/codeqr.png", "L", 4, 4);
    $resultat = "<img src='data/qrcode/codeqr.png' alt='qrcode_google.png'>";
    $image = 'data/qrcode/codeqr.png';
    $base64 = base64_encode(file_get_contents($image));
    
    $data = array('image'=> $base64,
    'texte' => $_POST['texte']);
               
    echo $resultat."</br>";
    $lien = $_POST['donnees'];
    if(preg_match("/youtube/", $lien)){
        echo preg_replace('/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i','<iframe width="640" height="360" src="http://www.youtube.com/embed/$1?autoplay=1" frameborder="0" allowfullscreen></iframe>',$lien);
    }else{
        echo "</br>".$_POST['donnees'];
    }
    
    return $data;
}

function CreateQRCode($donnees){
     echo '<div id="featured">';
        echo '<div class="title">';
            echo '<h3>Résultat</h3>';
        echo '</div>';
        
            //****************************CREATION QR CODE******************************\\
            
            $qr = QRcode::png($donnees, "data/qrcode/codeqr.png", "L", 4, 4);
            $resultat = "<img src='data/qrcode/codeqr.png' alt='qrcode_google.png'></img>";
            echo $resultat."</br>";
            
            //*****************************YOUTUBE QR CODE******************************\\
            
            $lien = $donnees;
            if(preg_match("/youtube/", $lien)){
                echo preg_replace('/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i','<iframe width="640" height="360" src="http://www.youtube.com/embed/$1?autoplay=1" frameborder="0" allowfullscreen></iframe>',$lien);
            }else{
                echo "</br>".$donnees;
            }
            
            //***************************************************************************\\
            
    echo '</div>';
}

function GeneratePDF($params){
        
    require("html2pdf/vendor/autoload.php");
    
    ob_start();
    
    $html2pdf = new Html2Pdf();
    
    ?>
    
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Sample Invoice</title>
    </head>
    <body>
        <div id="container">
            <div id="intro">
                <div id="pageHeader">
                    <img src="data:image/png;base64, <?=$params['image']?>" alt="Red dot" />
                    <h1><span>Your Company Name</span></h1>
                    <h2><span>Your Slogan Here</span></h2>
                </div>
            </div>

            <div id="supportingText">
                    <div id="explanation">
                    <h3><span>What is Lorem Ipsum?</span></h3>
                    <p class="p1"><span><?=$params['texte']?></span></p>
                </div>
                <div id="explanation">
                    <h3><span>Where does it come from?</span></h3>
                    <p class="p1"><span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</span></p>
                    <p class="p2"><span>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</span></p>
                </div>

                <div id="participation">
                    <h3><span>Where can I get some?</span></h3>
                    <p class="p1"><span>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</span></p>
                </div>

                <div id="benefits">
                    <h3><span>Why do we use it?</span></h3>
                    <p class="p1"><span>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span></p>
                </div>

                <div id="footer">
                    Copyright © 2006 Your Company Name
                </div>
            </div>
        </div>
    </body>
    </html>

    <?php
    
    $content = ob_get_clean();
    $html2pdf->writeHTML($content);
    
        
    ob_end_clean();
    $uniq = uniqid();
    
    //$html2pdf->output('data/pdf/'.$uniq.'.pdf', 'F');
    $html2pdf->output('my_doc.pdf', 'D');
    
    
    //echo $content;
    //$uniq = uniqid();
    //$htmlFile = $uniq.'.html';
    //file_put_contents('data/pdf/'.$htmlFile,$content);
    //exec("wkhtmltopdf --dpi 300 --margin-bottom 20mm --margin-left 10mm --margin-top 25mm --margin-right 10mm --page-size A4 'data/pdf/".$htmlFile."' '".$uniq.".pdf'",$output);
    
        /*ob_start();
        
        ?>
        
        <html lang="fr">
          <head>
            <meta charset="UTF-8">
            <title>Sample Invoice</title>
          </head>
          <body>
            <div class="container">
              <div class="row">
                <div class="col-xs-6">
                  <h1 id="qrcode">
                    <img src="data:image/png;base64, <?=$params['image']?>" alt="Red dot" />
                  </h1>
                </div>
                <div class="col-xs-6 text-right">
                  <h1>INVOICE</h1>
                  <h1><small>Invoice #001</small></h1>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-5">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4>From: <a href="#">Your Name</a></h4>
                    </div>
                    <div class="panel-body">
                      <p>
                        Address <br>
                        details <br>
                        more <br>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-5 col-xs-offset-2 text-right">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4>To : <a href="#">Client Name</a></h4>
                    </div>
                    <div class="panel-body">
                      <p>
                        Address <br>
                        details <br>
                        more <br>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-5">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h4>Bank details</h4>
                    </div>
                    <div class="panel-body">
                      <p>Your Name</p>
                      <p>Bank Name</p>
                      <p>SWIFT : --------</p>
                      <p>Account Number : --------</p>
                      <p>IBAN : --------</p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-7">
                  <div class="span7">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <h4>Contact Details</h4>
                      </div>
                      <div class="panel-body">
                        <p>
                          Email : you@example.com <br><br>
                          Mobile : -------- <br><br><br>
                        </p>
                        <h4>Payment should be made by Bank Transfer</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </body>
        </html>
        
        <?php
        
        $content = ob_get_clean();
        
        echo $content;
        //$uniq = uniqid();
        //$htmlFile = $uniq.'.html';
        //file_put_contents('data/pdf/'.$htmlFile,$content);
        //exec("wkhtmltopdf --dpi 300 --margin-bottom 20mm --margin-left 10mm --margin-top 25mm --margin-right 10mm --page-size A4 'data/pdf/".$htmlFile."' '".$uniq.".pdf'",$output);
        
        ob_end_clean();

        */
        //var_dump($tmpContent);
        
        /*
        
        $uniq = uniqid();
        $tmpFile = $uniq.'.html';
        //copy('templates/'.$template,$tmpFile);

        ob_start();
        require('html_to_pdf/test.php');
        $tmpContent = ob_get_contents();
        ob_end_clean();

        file_put_contents('/tmp/'.$tmpFile, $tmpContent);
        
        exec("wkhtmltopdf --dpi 300 --margin-bottom 20mm --margin-left 10mm --margin-top 25mm --margin-right 10mm --page-size A4 /tmp/".$tmpFile." ".$uniq.".pdf",$output);

        //var_dump($tmpContent);
          
        */
}
    
    /*
 // INCLUDE THE phpToPDF.php FILE
require("phptopdf/phpToPDF.php"); 

// PUT YOUR HTML IN A VARIABLE
if(isset($_POST['generer'])){
    $qr = QRcode::png($_POST['donnees'], "data/qrcode/codeqr.png", "L", 4, 4);
    $resultat = "<img src='data/qrcode/codeqr.png' alt='qrcode_google.png'></img>";
    $image = 'data/qrcode/codeqr.png';
    $base64 = base64_encode(file_get_contents($image));
    $img = '<img src="data:image/png;base64, '.$base64.'" alt="Red dot" />';
    $my_html="<html lang=\"en\">
  <head>
    <meta charset=\"UTF-8\">
    <title>Sample Invoice</title>
    <link rel=\"stylesheet\" href=\"http://phptopdf.com/bootstrap.css\">
    <style>
      @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
      body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }
      #qrcode{
        margin-bottom: 50px;
        }
    </style>
  </head>
  <body>
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-xs-6\">
          <h1 id=\"qrcode\">          
            ".$img."
          </h1>
        </div>
        <div class=\"col-xs-6 text-right\">
          <h1>INVOICE</h1>
          <h1><small>Invoice #001</small></h1>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-xs-5\">
          <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
              <h4>From: <a href=\"#\">Your Name</a></h4>
            </div>
            <div class=\"panel-body\">
              <p>
                Address <br>
                details <br>
                more <br>
              </p>
            </div>
          </div>
        </div>
        <div class=\"col-xs-5 col-xs-offset-2 text-right\">
          <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
              <h4>To : <a href=\"#\">Client Name</a></h4>
            </div>
            <div class=\"panel-body\">
              <p>
                Address <br>
                details <br>
                more <br>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-xs-5\">
          <div class=\"panel panel-info\">
            <div class=\"panel-heading\">
              <h4>Bank details</h4>
            </div>
            <div class=\"panel-body\">
              <p>Your Name</p>
              <p>Bank Name</p>
              <p>SWIFT : --------</p>
              <p>Account Number : --------</p>
              <p>IBAN : --------</p>
            </div>
          </div>
        </div>
        <div class=\"col-xs-7\">
          <div class=\"span7\">
            <div class=\"panel panel-info\">
              <div class=\"panel-heading\">
                <h4>Contact Details</h4>
              </div>
              <div class=\"panel-body\">
                <p>
                  Email : you@example.com <br><br>
                  Mobile : -------- <br><br><br>
                </p>
                <h4>Payment should be made by Bank Transfer</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>";

    // SET YOUR PDF OPTIONS -- FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/
    $pdf_options = array(
      "source_type" => 'html',
      "source" => $my_html,
      "action" => 'download',
      "save_directory" => 'data/',
      "file_name" => 'QR_Code.pdf');

    // CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE
    phptopdf($pdf_options);
}
*/
    
?>