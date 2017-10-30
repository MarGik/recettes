<header id="header" >
  <div class="boutonStat">
    <a class="bStatDeroulant" href = "#" >Statistique</a>
      <?php include("php/statistique.php"); ?>
  </div>
  <div class="logo">
    <a href = "index.php"><img class = "imgLogo" src="img/logo.jpg" /></a>
  </div>
  <nav id="menu">
    <div class="fondNoir">
      <div class="arrow-right"></div>
    </div>
    <div class="liens">
      <a href = "index.php" ><strong>Accueil</strong></a>
      <div class="bLienDeroulant">
        <div style="position:relative;">
          <a href = "#"><strong>Ingrédients</strong></a>
          <div class="lienDeroulant">
           <a href = "index.php?page=ajoutIngredient.php"><strong>Ajout</strong></a>
           </br>
           <a href = "index.php?page=rechercheIngredient.php"><strong>Recherche</strong></a>
          </div>
        </div>
      </div>
      <div class="bLienDeroulant"><a href = "#"><strong>Recettes</strong></a>
        <div style="position:relative;">
          <div class="lienDeroulant">
            <a href = "index.php?page=ajoutRecette.php"><strong>Ajout</strong></a>
            </br>
            <a href = "index.php?page=rechercheRecette.php"><strong>Recherche</strong></a>
          </div>
        </div> 
      </div>
      <div class="bLienDeroulant"><a href = "#"><strong>Cartographie</strong></a>
        <div style="position:relative;">
          <div class="lienDeroulant" style="width:200px;">
            <a href = "index.php?page=provient.php"><strong>Ajout de lieu de provenance</strong></a>
            </br>
            <a href = "index.php?page=cartographie.php"><strong>Recherche de lieux</strong></a>
          </div>
        </div> 
      </div>
  
      <?php
        if(!isset($_SESSION["pseudo"])) {
          echo "<div class='lienPage'><a href='index.php?page=connexion.php'><strong>Connexion</strong></a></div>";
          echo "<div class='lienPage'><a href='index.php?page=inscription.php'><strong>Inscription</strong></a></div>";
        }
        elseif($_SESSION["pseudo"] != '') {
          echo "<div class='lienPage'><a href='index.php?page=monCompte.php'><strong>Mon Compte</strong></a></div>
                <div class='lienPage'><a href='index.php?page=deconnexion.php'><strong>Déconnexion</strong></a></div>";
        }
      ?>
    </div>
    <div class="fondNoir">
      <div class="arrow-left"></div>
    </div>
  </nav>
</header>
