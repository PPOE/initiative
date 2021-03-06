<?php session_start(); ?>
<?php
$empfaenger["Bildung, Wissenschaft, Forschung"] = "bildung-wissenschaft-forschung@forum.piratenpartei.at";
$empfaenger["Digitales, Urheber-/Patentrecht, Datenschutz"] = "digitales-urheber-patentrecht-datenschutz@forum.piratenpartei.at";
$empfaenger["Europa, Außen, Internationales, Frieden"] = "aussen-internationales-frieden@forum.piratenpartei.at";
$empfaenger["Gesundheit, Drogen-/Suchtpolitik"] = "gesundheit-drogen-suchtpolitik@forum.piratenpartei.at";
$empfaenger["Gleichstellung, Diversität, Integration"] = "gleichstellung-diversitaet-integration@forum.piratenpartei.at";
$empfaenger["Innen, Recht, Demokratie, Sicherheit"] = "innen-recht-demokratie-sicherheit@forum.piratenpartei.at";
$empfaenger["Kinder, Jugend, Familie"] = "kinder-jugend-familie@forum.piratenpartei.at";
$empfaenger["Umwelt, Tierschutz, Verkehr, Energie"] = "umwelt-verkehr-energie@forum.piratenpartei.at";
$empfaenger["Wirtschaft, Soziales, Konsumentenschutz"] = "wirtschaft-soziales@forum.piratenpartei.at";
$empfaenger["Sonstiges"] = "sonstige-politische-themen@forum.piratenpartei.at";

if($_POST['submit'] != "true") {goto end;}

if($empfaenger[$_POST['thema']] != "") {
	$zieladresse = $empfaenger[$_POST['thema']];
} else {
	$error = 'Irgendwas läuft schief, Error-Code: 1';
	goto end;
}

if($_POST['name'] != ""){$absendername = $_POST['name'];} else {$error = "Bitte einen Namen angeben!";goto end;}
if($_POST['mail'] != ""){$absenderadresse = $_POST['mail'];} else {$absenderadresse = "anonym@initiative.piratenpartei.at";}
if($_POST['subject'] != ""){$betreff = '[Initiative] '.$_POST['subject'];} else {$error = "Bitte einen Titel angeben!";goto end;}

$urlDankeSeite = 'danke.html';

if($_POST['content'] != ""){$mailtext = "Die Piratenpartei sollte sich dafür einsetzen, dass ... ".$_POST['content'];} else {$error = "Bitte einen Text eingeben!";goto end;}

/*include_once '/securimage/securimage.php';

$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  $error = "The security code entered was incorrect.<br /><br />Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
  goto end;
}*/

if ($_SERVER['REQUEST_METHOD'] === "POST") {

	$header = array();
	$header[] = "From: ".mb_encode_mimeheader($absendername, "utf-8", "Q")." <".$absenderadresse.">";
	$header[] = "MIME-Version: 1.0";
	$header[] = "Content-type: text/plain; charset=utf-8";
	$header[] = "Content-transfer-encoding: 8bit";

    mail(
    	$zieladresse, 
    	mb_encode_mimeheader($betreff, "utf-8", "Q"), 
    	$mailtext,
    	implode("\n", $header)
    ) or die("Die Mail konnte nicht versendet werden.");
    header("Location: $urlDankeSeite");
    exit;
}

header("Content-type: text/html; charset=utf-8");

end:
?>


<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>Deine Idee bei den Piraten!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Piratenpartei Österreichs">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
	background-color: #4c2582;
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /*Custom container by burnoutberni */
      #white-container {
	height: 100%;
	margin: 0 auto;
	max-width: 1000px;
	background-color: white;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <div id="white-container">
    <div class="container-narrow">

      <hr>

      <div class="jumbotron">
        <h1>Deine Idee bei den Piraten!</h1>
        <p class="lead">Wir Piraten freuen uns über jede Idee, besonders von Nicht-Mitgliedern. Hier hast auch du die Möglichkeit deine Stimme zu erheben und deine Ideen bei uns einzubringen!</p>
      </div>

      <hr>

      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Was passiert mit meinem Anliegen?</h4>
          <p>Alle Piraten, die sich für den Themenbereich deines Anliegens interessieren, werden über deine Idee informiert. Daraufhin wird deine Idee in unseren Arbeitsgruppen besprochen, erweitert, verbessert und es werden Alternativen eingebracht. Schlussendlich wird die Basis der Piratenpartei über <a href="http://lqfb.piratenpartei.at">LiquidFeedback</a> über die erarbeiteten Programmpunkte abstimmen, und vielleicht ins Parteiprogramm aufnehmen.</p>
        </div>

        <div class="span6" id="formular">
	  <?if(isset($error)){echo '<div class="alert alert-error">'.$error.'</div>';}?>
	<form action="index.php#formular" method="post">
		<div class="alert">
			<h4>Achtung!</h4>
			Alle hier angegebenen Daten werden veröffentlicht!
		</div>
                <h5>Dein Name oder Pseudonym:</h5>
                <input type="text" name="name" />
                <h5>Deine E-Mail-Adresse: (optional)</h5>
                <input type="text" name="mail" />
		<h5>Themenbereich deines Anliegens:</h5>
		<select name="thema">
<?
foreach ($empfaenger as $key => $value) {
	echo '<option value="'.$key.'">'.$key.'</option>';
}
?>
		</select>
                <h5>Der Titel deines Anliegens:</h5>
                <input type="text" name="subject" />
                <h5>Die Piratenpartei sollte sich dafür einsetzen, dass&nbsp;... (,&nbsp;weil&nbsp;...)</h5>
                <textarea name="content" rows="5"></textarea>
            <p>
	    <input type="hidden" value="true" name="submit"/>
<!--
<img id="captcha" src="/securimage/securimage_show.php" alt="CAPTCHA Image" /><br />
<input type="text" name="captcha_code" size="10" maxlength="6" />
<a href="#" onclick="document.getElementById('captcha').src = '/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
-->
            <input class="btn btn-primary" type="submit" value="Senden" />
            <input class="btn" type="reset" value="Zurücksetzen" />
            </p>
        </form>
        </div>
      </div>

      <hr>

    </div> <!-- /container -->
    </div> <!-- #white-container -->

    <div class="container-narrow" style="color:white;">
      <div class="footer">
	<p>Piratenpartei Österreichs, Lange Gasse 1/4, 1080 Wien</p>
	<p>Für den Inhalt verantwortlich: bv@piratenpartei.at · bgf@piratenpartei.at</p>
      </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>
</html>

