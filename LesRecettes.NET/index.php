<?php
	session_start();
	include('inc/constantes.php');
	include('inc/fonctions.php');
	connectBD();
?>
<!DOCTYPE html>
  <html>
    
    <head>
      <meta charset="utf-8"/>
      <title> Les recettes .NET</title>
			<link rel="shortcut icon" type="image/jpg" href="img/logo.jpg"/>
		  <link href="css/style.css" rel="stylesheet" media="all" type="text/css">
    </head>
    
    <body id="body">
      
        <?php include('static/header.php');?>
		    <?php
          $page = 'static/accueil.php';
			    if (isset($_GET['page'])) {
				    if (file_exists(addslashes('php/'.$_GET['page']))) {
					     $page = addslashes('php/'.$_GET['page']);
				    } 
			    }
          ?>
          <div class="contenu">
          <?php
			    include($page);
		      ?>
          </div>
        <?php include('static/footer.php');?>
      <script type="text/javascript" src="js/jquery.js"></script>
      <script type="text/javascript" src="js/slideLiens.js"></script>
      <script type="text/javascript" src="js/ajoutElementsForm.js"></script>
      
    </body>
    <?php
    deconnectBD(); ?>
  
  </html>
