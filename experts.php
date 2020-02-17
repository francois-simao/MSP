<?php
    session_name("formulaire");
    session_start();
    include 'dbe_connect.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Liste</title>
</head>
<body>

<div class="formulaire1">
    <?php
        if ( isset($_SESSION['username']))
        {
            echo '<button class ="button" type="submit"><a href="http://localhost/assurance-auto/index.php">Retour</a></button><div class="text">Bonjour ' . $_SESSION['username'].'</div>';
        }
        else {
            header('Location: http://localhost/assurance-auto/form');
        }
    ?>
    <form action="deconnexion.php" method="post" >
        <input class ="button" type="submit" value = "Deconnecter">
    </form>
    </div>

    <h1>EXPERTS</H1>
    <h3>AJOUTER</h3>
    <?php 
//ajout expert
    echo "<form method='post' action='' class='d-flex justify-content-center flex-column'>";
    echo "<div class='w-min-content d-flex justify-content-center row mx-auto'>";
    echo        "<input type='text' class='mb-1 mr-1' name='nom' id='user' placeholder='nom' />";
    echo        "<input type='text' class='mb-1 mr-1' name='prenom' id='user' placeholder='prenom' />";
    echo        "<input type='text' class='mb-1 mr-1' name='adresse' id='user' placeholder='adresse' />";
    echo        "<input type='text' class='mb-1 mr-1' name='telephone' id='user' placeholder='telephone' />";
    echo        "<input type='email' class='mb-1' name='mail' id='user' placeholder='email' />";
    echo "</div>";
    echo        "<input type='submit' class='button w-min-content d-flex mx-auto justify-content-center' value='ajouter' name='validation' />";
    echo"</form>";

    if(isset($_POST['validation'])){
      
		
		$ajout="INSERT INTO t_expert (nom_expert,prenom_expert,adresse, tel_expert,mail_expert) VALUES ('".$_POST['nom']."','".$_POST['prenom']."','".$_POST['adresse']."','".$_POST['telephone']."','".$_POST['mail']."')";
        $stmt = $connection->query($ajout);
        //var_dump($stmt);
        //die;
		$result = $stmt->fetch();
		
		}

    
//supprimer expert
    ?>
    <h3>SUPPRIMER</h3>
    <?php
$suppression="SELECT * FROM t_expert";
$suppr = $connection->query($suppression);


    echo"<form method='post' action=''>";
    echo        "<select name='expert_suppr' class='d-flex justify-content-center mx-auto'>";
    echo            "<option selected='selected'>Sélectionner expert</option>";  

    while ($resultat = $suppr->fetch()){
    echo "<option value='".$resultat[ID_EXPERT]."'>".$resultat[NOM_EXPERT]."</option>";

  }
    echo        "</select>";
    echo        "<input type='submit' class='button w-min-content d-flex mx-auto justify-content-center'>";
    echo"</form>";

    if(isset($_POST['expert_suppr']) && !empty($_POST['expert_suppr'])){
    $suppr2="DELETE FROM t_expert WHERE ID_EXPERT=".$_POST['expert_suppr']." ";
	$stmt2 = $connection->prepare($suppr2);
	$stmt2->execute();
    }


// modifier expert
?>

<h3>MODIFICATION</h3>

<?php

$modification="SELECT * FROM t_expert";
$modif = $connection->query($modification);


    echo"<form method='post' action=''>";
    echo        "<select name='expert_modif' class='d-flex justify-content-center mx-auto'>";
    echo            "<option selected='selected'>Sélectionner expert</option>";  

    while ($resultat_modif = $modif->fetch()){
    echo "<option value='".$resultat_modif[ID_EXPERT]."'>".$resultat_modif[NOM_EXPERT]."</option>";

  }
    echo        "</select>";
    echo        "<input type='submit' class='button w-min-content d-flex mx-auto justify-content-center' name='valid_modif'>";
    echo"</form>";
    if(isset($_POST['expert_modif']) && !empty($_POST['expert_modif'])){
       echo  "<form method='POST'>";
       echo "<div class='d-flex justify-content-center'>";
        $expert = $_POST['expert_modif'];
        $_SESSION['identifiantduexpert'] = $_POST['expert_modif'];
        $modif2="SELECT * FROM t_expert WHERE ID_EXPERT = $expert";
        $stmt3 = $connection->query($modif2);
        while ($resultat = $stmt3->fetch()){
            echo "<input type='text' class='mr-1' name ='nom_modif' value='".$resultat['NOM_EXPERT']."'>";
            echo "<input type='text' class='mr-1' name='prenom_modif' value='".$resultat['PRENOM_EXPERT']."'>";
            echo "<input type='text' class='mr-1' name='adresse_modif' value='".$resultat['ADRESSE']."'>";
            echo "<input type='text' class='mr-1' name='telephone_modif' value='".$resultat['TEL_EXPERT']."'>";
            echo "<input type='email' name='mail_modif' value='".$resultat['MAIL_EXPERT']."'>";
            echo "</div>";
            echo "<input type='submit' class='button w-min-content d-flex mx-auto justify-content-center' name='modifier' value='Confirmer modifications'>";
        }
        echo "</form>";
    }
    

    if(isset($_POST['nom_modif']) && !empty($_POST['nom_modif']) && ($_POST['prenom_modif']) && !empty($_POST['prenom_modif']) && ($_POST['adresse_modif']) && !empty($_POST['adresse_modif'])&& ($_POST['telephone_modif']) && !empty($_POST['telephone_modif']) && ($_POST['mail_modif']) && !empty($_POST['mail_modif'])){

        $update="UPDATE t_expert SET NOM_EXPERT='".$_POST['nom_modif']."', PRENOM_EXPERT='".$_POST['prenom_modif']."', ADRESSE='".$_POST['adresse_modif']."', TEL_EXPERT='".$_POST['telephone_modif']."',MAIL_EXPERT='".$_POST['mail_modif']."' WHERE ID_EXPERT='".$_SESSION['identifiantduexpert']."' ";   
        // var_dump ($update);
        // die;        
        $stmt = $connection->prepare($update);
        $stmt->execute();
        
    }
    

//recherche
?>
<h3>RECHERCHE</h3>
<?php
    if(isset($_POST['search']) AND !empty($_POST['search'])){
        $search = htmlspecialchars ($_POST['search']);
        $recherche ="SELECT * FROM t_expert WHERE NOM_EXPERT LIKE '%".$search."%' ORDER BY ID_EXPERT ASC";
        $search = $connection->query($recherche);
    }

    echo    "<form method='post' action='' class='mb-4'>";
    echo    "<input type='search' placeholder='Recherche...' name='search' class='d-flex justify-content-center mx-auto'>";
    echo    "<input type='submit' class='button w-min-content d-flex mx-auto justify-content-center' name='search_valid' value='Valider'>";
    echo    "</form>";

    if(isset($search) AND !empty($search)){
    while($search_result = $search->fetch()){
            echo "<input type='text' name ='nom_modif' value='".$search_result['NOM_EXPERT']."'>";
            echo "<input type='text' name='prenom_modif' value='".$search_result['PRENOM_EXPERT']."'>";
            echo "<input type='text' name='adresse_modif' value='".$search_result['ADRESSE']."'>";
            echo "<input type='text' name='telephone_modif' value='".$search_result['TEL_EXPERT']."'>";
            echo "<input type='email' name='mail_modif' value='".$search_result['MAIL_EXPERT']."'>";
    }
    }




    ?>
    <footer>
        <div class="container-footer">
            <div class="d-flex justify-content-around pt-2 font-family-roboto">
                <p>Projet php réalisé du 10/02/2020 au 14/02/2020</p>
                <p><span class="color-primary">MOULEROT</span> Manon / <span class="color-primary">SIMAO</span> Francois / <span class="color-primary">LAFARGE</span> Arthur</p>
            </div>
        </div>
    </footer>
</body>

</html>