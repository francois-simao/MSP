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

    <h1>CLIENTS</H1>
    <h3>AJOUTER</h3>
    <?php 
//ajout client
    echo "<form method='post' action=''>";
    echo "<div class='d-flex justify-content-center'>";
    echo        "<input type='text' class='mr-1' name='nom' id='user' placeholder='nom' />";
    echo        "<input type='text' class='mr-1' name='prenom' id='user' placeholder='prenom' />";
    echo        "<input type='text' class='mr-1' name='adresse' id='user' placeholder='adresse' />";
    echo        "<input type='text' class='mr-1' name='telephone' id='user' placeholder='telephone' />";
    echo        "<input type='email' name='mail' id='user' placeholder='email' />";
    echo "</div>";
    echo        "<input type='submit' class='button w-min-content d-flex mx-auto justify-content-center' value='ajouter' name='validation' />";
    echo"</form>";

    if(isset($_POST['validation'])){
      
		
		$ajout="INSERT INTO t_client (nom_client,prenom_client,adresse_client, tel_client,mail_client) VALUES ('".$_POST['nom']."','".$_POST['prenom']."','".$_POST['adresse']."','".$_POST['telephone']."','".$_POST['mail']."')";
		$stmt = $connection->query($ajout);
		$result = $stmt->fetch();
		
		}

    
//supprimer client
?>

<h3>SUPPRIMER</h3>

<?php
$suppression="SELECT * FROM t_client";
$suppr = $connection->query($suppression);


    echo"<form method='post' action=''>";
    echo        "<select name='client_suppr' class='d-flex justify-content-center mx-auto'>";
    echo            "<option selected='selected'>Sélectionner client</option>";  

    while ($resultat = $suppr->fetch()){
    echo "<option value='".$resultat[ID_CLIENT]."'>".$resultat[NOM_CLIENT]."</option>";

  }
    echo        "</select>";
    echo        "<input type='submit' class='button w-min-content d-flex mx-auto justify-content-center'>";
    echo"</form>";

    if(isset($_POST['client_suppr']) && !empty($_POST['client_suppr'])){
    $suppr2="DELETE FROM t_client WHERE ID_CLIENT=".$_POST['client_suppr']." ";
	$stmt2 = $connection->prepare($suppr2);
	$stmt2->execute();
    }


// modifier client
?>

<h3>MODIFICATION</h3>

<?php
$modification="SELECT * FROM t_client";
$modif = $connection->query($modification);


    echo"<form method='post' action=''>";
    echo        "<select name='client_modif' class='d-flex justify-content-center mx-auto'>";
    echo            "<option selected='selected'>Sélectionner client</option>";  

    while ($resultat_modif = $modif->fetch()){
    echo "<option value='".$resultat_modif[ID_CLIENT]."'>".$resultat_modif[NOM_CLIENT]."</option>";

  }
    echo        "</select>";
    echo        "<input type='submit'  class='button w-min-content d-flex mx-auto justify-content-center' name='valid_modif'>";
    echo"</form>";
    if(isset($_POST['client_modif']) && !empty($_POST['client_modif'])){
       echo  "<form method='POST'>";
       echo "<div class='d-flex justify-content-center'>";
        $client = $_POST['client_modif'];
        $_SESSION['identifiantduclient'] = $_POST['client_modif'];
        $modif2="SELECT * FROM t_client WHERE ID_CLIENT = $client";
        $stmt3 = $connection->query($modif2);
        while ($resultat = $stmt3->fetch()){
            echo "<input class='mr-1' type='text' name ='nom_modif' value='".$resultat['NOM_CLIENT']."'>";
            echo "<input class='mr-1' type='text' name='prenom_modif' value='".$resultat['PRENOM_CLIENT']."'>";
            echo "<input class='mr-1' type='text' name='adresse_modif' value='".$resultat['ADRESSE_CLIENT']."'>";
            echo "<input class='mr-1' type='text' name='telephone_modif' value='".$resultat['TEL_CLIENT']."'>";
            echo "<input type='email' name='mail_modif' value='".$resultat['MAIL_CLIENT']."'>";
            echo "</div>";
            echo "<input type='submit' class='button w-min-content d-flex mx-auto justify-content-center' name='modifier' value='Confirmer modifications'>";
        }
        echo "</form>";
    }
    echo    "</fieldset>";
    

    if(isset($_POST['nom_modif']) && !empty($_POST['nom_modif']) && ($_POST['prenom_modif']) && !empty($_POST['prenom_modif']) && ($_POST['adresse_modif']) && !empty($_POST['adresse_modif'])&& ($_POST['telephone_modif']) && !empty($_POST['telephone_modif']) && ($_POST['mail_modif']) && !empty($_POST['mail_modif'])){

        $update="UPDATE t_client SET NOM_CLIENT='".$_POST['nom_modif']."', PRENOM_CLIENT='".$_POST['prenom_modif']."', ADRESSE_CLIENT='".$_POST['adresse_modif']."', TEL_CLIENT='".$_POST['telephone_modif']."',MAIL_CLIENT='".$_POST['mail_modif']."' WHERE ID_CLIENT='".$_SESSION['identifiantduclient']."' ";   
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
        $recherche ="SELECT * FROM t_client WHERE NOM_CLIENT LIKE '%".$search."%' ORDER BY ID_CLIENT ASC";
        $search = $connection->query($recherche);
    }
    echo"<form method='post' action='' class='mb-4'>";
    echo    "<input type='search' class='d-flex justify-content-center mx-auto' placeholder='Recherche...' name='search'>";
    echo    "<input type='submit' class='button w-min-content d-flex mx-auto justify-content-center' name='search_valid' value='Valider'>";
    echo"</form>";

    if(isset($search) AND !empty($search)){
    while($search_result = $search->fetch()){
        $jointure="SELECT * 
        FROM t_client
        JOIN t_contrat
        ON t_client.ID_CLIENT = t_contrat.id_client
        JOIN t_accidents
        on t_contrat.id_client = t_accidents.id_contrat
        JOIN t_intervention
        on t_accidents.id_contrat = t_intervention.ID
        JOIN t_expert
        on t_intervention.id_expert = t_expert.ID_EXPERT";
        
        $search_joint = $connection->query($jointure);
        
        while ($connect_jointure = $search_joint->fetch()){

            echo "<input type='text' name ='nom_modif' value='".$search_result['NOM_CLIENT']."'>";
            echo "<input type='text' name='prenom_modif' value='".$search_result['PRENOM_CLIENT']."'>";
            echo "<input type='text' name='adresse_modif' value='".$search_result['ADRESSE_CLIENT']."'>";
            echo "<input type='text' name='telephone_modif' value='".$search_result['TEL_CLIENT']."'>";
            echo "<input type='email' name='mail_modif' value='".$search_result['MAIL_CLIENT']."'>";
            echo "<input type='text' name ='' value='".$connect_jointure['IMMATRICULATION']."'>";
            echo "<input type='text' name ='' value='".$connect_jointure['BONUS_MALUS']."'>";
            echo "<input type='text' name ='' value='".$connect_jointure['DATE_ACCIDENT']."'>";
            echo "<input type='text' name ='' value='".$connect_jointure['LIEU']."'>";
            echo "<input type='text' name ='' value='".$connect_jointure['RAPPORT_EXPERTISE']."'>";
            echo "<input type='text' name ='' value='".$connect_jointure['NOM_EXPERT']."'>";
            echo "</br>";
        }
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