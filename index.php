<!-- Header section -->
<header>
  <h1>
    <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
    Les Argonautes
  </h1>
  <link rel="stylesheet" href="style.css">
</header>

<!-- Main section -->
<main>
<?php
    define("DBSERVEUR","localhost");
    define("DBUTILISATEUR","root");
    define("DBMDP","");
    define("DBNOM","wild");
    $dsn = "mysql:dbname=".DBNOM.";host=".DBSERVEUR;
    try
    {
        $connexion = new PDO($dsn, DBUTILISATEUR, DBMDP);
        $connexion->exec("SET NAME utf8");
    }
    catch(PDOException $e)
    {
        die("Erreur:".$e->getMessage());
    };
?> 
<?php
	if (isset($_POST['envoyer'])) 
    { 
        if(!empty($_POST['nom']))
        {
            $nom = htmlspecialchars($_POST['nom']);
            $insert = $connexion->prepare ("INSERT INTO equipage(name) VALUES (?)");
            $insert->execute(array($nom));
        }
        else
        {
            $erreur= "vous devez renseigner un nom";
        }
    }

?>
  <!-- New member form -->
  <h2>Ajouter un(e) Argonaute</h2>
  <form class="new-member-form" action="" method="POST">
    <label for="name">Nom de l&apos;Argonaute</label>
    <input id="name" name="nom" type="text" placeholder="écrire un nom" />
    <input type="submit" name="envoyer" value="Envoyer"/>
    <!-- <button type="submit">Envoyer</button> -->
  </form>
  <?php
	if (isset($erreur))
    {
     echo '<font color ="red">'.$erreur."</font>";
    }

  ?>
  <!-- Member list -->
  <h2>Membres de l'équipage</h2>
  <!--<section class="member-list"> -->
    <div class="member-item">
    <?php
        $reponse = $connexion->query('SELECT name FROM equipage');
        while ($donnees = $reponse->fetch())
        {
            echo $donnees['name'] . '<br />';
        }
        $reponse->closeCursor();
    ?>
    </div>
  <!-- </section> -->
</main>

<footer>
  <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
</footer>