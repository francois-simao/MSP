<?php 
session_name("formulaire");
session_start();
include 'dbe_connect.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
    <h3> Ajouter un contrat</h3>
<form action="" method="post" class="text-align-center">
    <div class="d-flex flex-column w-100 mb-2">
        <label>selectionnez un nom</label>
        <div class="d-flex justify-content-center mb-2">
        <select name="select-client" class="select1">
        <?php 
        $sql1="SELECT ID_CLIENT, NOM_CLIENT FROM t_client";
        $req1 = $connection->query($sql1);
        while ($requete1=$req1->fetch()){
            echo '<option value="'.$requete1['ID_CLIENT'].'">'.$requete1['NOM_CLIENT'].'</option>';
        }
        ?>
        </select>
        </div>
        <label>type de contrat</label>
        <div class="d-flex justify-content-center mb-2">
        <select name="select-contrat" class="select1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        </select>
        </div>
    </div>
    <div class="d-flex row justify-content-around">
    <div class="d-flex flex-column w-30 justify-content-center">
        <label>catégorie professionnelle</label>
        <div class="d-flex justify-content-center mb-2">
            <select name="cat-pro">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        </select>
        </div>
        <label>trajets</label>
        <div class="d-flex justify-content-center mb-2">
            <select name="trajets">
        <option>privé</option>
        <option>travail</option>
        </select>
        </div>
        <label>Adresse de travail</label><div class="d-flex justify-content-center mb-2"><input type = "text" name = "adresse-travail" placeholder="00 rue Bernard" class="w-70" required></div>
        <label>kilomètres par ans</label><div class="d-flex justify-content-center mb-2">
        <select name="km-ans">
        <option>moins de 10 000km</option>
        <option>10 000km</option>
        <option>20 000km</option>
        <option>30 000km</option>
        <option>40 000km</option>
        <option>Plus de 50 000km</option>
        </select>
        </div>
        <label>combien de temps avez-vous gardé vôtre premiere voiture ?</label>
        <div class="d-flex justify-content-center mb-2">
        <select name="age-voiture">
        <option>moins de 1 ans</option>
        <option>1 ans</option>
        <option>2 ans</option>
        <option>3 ans</option>
        <option>plus de 4 ans</option>
        </select>
        </div>
        </div>
        <div class="d-flex flex-column w-30 justify-content-center">
        <label>titulaire</label><div class="d-flex justify-content-center mb-2"><input type = "text" name = "titulaire" required></div>
        <label>conducteur secondaire</label><div class="d-flex justify-content-center mb-2"><input type = "text" name = "conduc-sec" required></div>
        <label>véhicule enregistré</label><div class="d-flex justify-content-center mb-2"><input type = "text" name = "vehicule-registre" required></div>
        <label>immatriculation</label><div class="d-flex justify-content-center mb-2"><input type = "text" name = "immatriculation" required></div>
        <label>date d'obtention du permis</label><div class="d-flex justify-content-center mb-2"><input type="date" name="date-permis" required></div>
        </div>
        <div class="d-flex flex-column w-30 justify-content-center">
        <label>type de permis</label><div class="d-flex justify-content-center mb-2"><select name="type-permis">
        <option>AM</option>
        <option>2</option>
        </select>
        </div>
        <label>permis suspendu</label><div class="d-flex justify-content-center mb-2"><select name="permis-sup">
        <option>oui</option>
        <option>non</option>
        </select>
        </div>
        <label>date enregistrement</label><div class="d-flex justify-content-center mb-2"><input type = "date" name = "date-registre" required></div>
        <label>date de fin</label><div class="d-flex justify-content-center mb-2"><input type = "date" name = "date-fin" required></div>
        <label>bonus / malus</label><div class="d-flex justify-content-center mb-2"><select name="malus-bonus">
        <option>oui</option>
        <option>non</option>
        </select>
        </div>
    </div>
    </div>
    <div class="d-block my-4">
        <input class="button" type = "submit" value = "Envoyer">
    </div>
    </div>
</form>
    <?php 
    if (isset ($_POST['date-fin'])){
    $catPro=$_POST['cat-pro'];
    $trajets=$_POST['trajets'];
    $adresseTRavail=$_POST['adresse-travail'];
    $kilometres=$_POST['km-ans'];
    $ageVoiture=$_POST['age-voiture'];
    $titulaire=$_POST['titulaire'];
    $conducteurSecondaire=$_POST['conduc-sec'];
    $vehiculeRegistre=$_POST['vehicule-registre'];
    $immatriculation=$_POST['immatriculation'];
    $datePermis=$_POST['date-permis'];
    $permisType=$_POST['type-permis'];
    $permiSup=$_POST['permis-sup'];
    $typeContrat=$_POST['select-contrat'];
    $dateRegistre=$_POST['date-registre'];
    $dateFin=$_POST['date-fin'];
    $malusBonus=$_POST['malus-bonus'];
    $selectClient=$_POST['select-client'];
    $sql2="INSERT INTO t_contrat (CAT_PRO, TRAJETS, ADRESSE_TRAVAIL, KM_ANS, TEMPS_VOITURE, TITULAIRE, CONDUCTEUR_SEC, VEHIC_ENREGISTRER, IMMATRICULATION, PERMIS, TYPE_PERMIS, PERMIS_SUSPENDU, TYPE_CONTRAT, DATE_ENREGISTREMENT, DATE_FIN, BONUS_MALUS, id_client) VALUES ('$catPro', '$trajets', '$adresseTRavail', '$kilometres', '$ageVoiture', '$titulaire', '$conducteurSecondaire', '$vehiculeRegistre', '$immatriculation', '$datePermis', '$permisType', '$permiSup', '$typeContrat', '$dateRegistre', '$dateFin', '$malusBonus', '$selectClient')";
    $result2=$connection->query($sql2);} 
    ?>
    <h3>Supprimer un contrat d'un client</h3>
    <form method="post" action="" class="d-flex justify-content-center mb-2">
            <select name="nomuser">
            <?php 
            $sql4="SELECT ID_CLIENT, NOM_CLIENT FROM t_client";
            $req4 = $connection->query($sql4);
            while ($requete4=$req4->fetch()){
                echo '<option value="'.$requete4['ID_CLIENT'].'">'.$requete4['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
            <input type="submit" value="confirmer"></input>
        </form>
        
        <?php 
        if (isset($_POST['nomuser'])){
            $nomuser=$_POST['nomuser'];
            $sql3="SELECT * FROM t_contrat inner join t_client on t_client.ID_CLIENT=t_contrat.id_client where t_contrat.id_client =$nomuser";
            $req3=$connection->query($sql3);
            echo "<form method='post' action='' class='d-flex justify-content-center mb-3'>";
            echo "<select name='reqsup'>";
            while ($requete3=$req3->fetch()){
                echo "<option value='".$requete3['ID_CONTRAT']."'>".$requete3['DATE_ENREGISTREMENT'].' '.$requete3['TYPE_CONTRAT']."</option>";
            }
            echo "</select>";
            echo "<input type='submit' value='supprimer'>";
            echo"</form>";
        }
        if (isset($_POST['reqsup'])){
            echo $_POST['reqsup'];
            $supprimer="DELETE FROM t_contrat where ID_CONTRAT =".$_POST['reqsup']."";
            $stmt = $connection->prepare($supprimer);
            $stmt->execute();
        }
        ?>
<h3>Modifier un contrat d'un client</h3>
<form method="post" action="" class="d-flex justify-content-center mb-4">

            <select name="nomuser2">
            <?php 
            $sql6="SELECT ID_CLIENT, NOM_CLIENT FROM t_client";
            $req6 = $connection->query($sql6);
            while ($requete6=$req6->fetch()){
                echo '<option value="'.$requete6['ID_CLIENT'].'">'.$requete6['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
            <input type="submit" value="confirmer"></input>
        </div>
        </form>
        
        <?php 
        if (isset($_POST['nomuser2'])){
            $nomuser2=$_POST['nomuser2'];
            $sql5="SELECT * FROM t_contrat inner join t_client on t_client.ID_CLIENT=t_contrat.id_client where t_contrat.id_client =$nomuser2";
            $req5=$connection->query($sql5);
            echo "<form method='post' action='' class='d-flex justify-content-center'>";
            echo "<div class='mt-1'>";
            echo "<select name='modif' class='h-min-content'>";
            while ($requete5=$req5->fetch()){
                echo "<option value='".$requete5['ID_CONTRAT']."'>".$requete5['DATE_ENREGISTREMENT'].' '.$requete5['TYPE_CONTRAT']."</option>";
            }
            echo "</select>";
            echo "</div>";
            echo "<div class='mb-4 mt-1'><input type='submit' value='modifier'></div>";
            echo"</form>";
        }
        if (isset($_POST['modif'])){
            $modifier="SELECT * FROM t_contrat inner join t_client on t_client.ID_CLIENT=t_contrat.id_client where ID_CONTRAT =".$_POST['modif']."";
            $stmt2 = $connection->prepare($modifier);
            $stmt2->execute();
            while ($requete5=$stmt2->fetch()){
            echo "<form action='' method='post' class='mt-2'>";
            echo "<div class='d-flex w-100 justify-content-around row'>";
            echo "<div class='d-flex w-30 flex-column'>";
            echo "<label>type de contrat</label><div class='d-flex justify-content-center mb-2'><select name='select-contrat2'><option selected>".$requete5['ID_CONTRAT']."</option></select>";
            echo "</div>";
            echo "<label>catégorie professionnelle</label><div class='d-flex justify-content-center mb-2'><select name='cat-pro2'><option selected>".$requete5['CAT_PRO']."</option><option>1</option><option>2</option><option>3</option><select>";
            echo "</div>";
            echo "<label>trajets</label><div class='d-flex justify-content-center mb-2'><select name='trajets2'><option>".$requete5['TRAJETS']."</option><option>privé</option><option>travail</option><select>";
            echo "</div>";
            echo "<label>Adresse de travail</label><div class='d-flex justify-content-center mb-2'><input type = 'text' name = 'adresse-travail2' value='".$requete5['ADRESSE_TRAVAIL']."' required>";
            echo "</div>";
            echo "<label>kilomètres par ans</label><div class='d-flex justify-content-center mb-2'><select name='km-ans2'><option>".$requete5['KM_ANS']."</option><option>moins de 10 000km</option><option>10 000km</option><option>20 000km</option><option>30 000km</option><option>40 000km</option><option>Plus de 50 000km</option></select>";
            echo "</div>";
            echo "</div>";
            echo "<div class='d-flex w-30 flex-column'>";
            echo "<label>combien de temps avez-vous gardé vôtre premiere voiture?</label><div class='d-flex justify-content-center mb-2'><select name='age-voiture2'><option>".$requete5['TEMPS_VOITURE']."</option><option>moins de 1 ans</option><option>1 ans</option><option>2 ans</option><option>3 ans</option><option>plus de 4 ans</option></select>";
            echo "</div>";
            echo "<label>titulaire</label><div class='d-flex justify-content-center mb-2'><input type ='text' name ='titulaire2' value='".$requete5['TITULAIRE']."' required>";
            echo "</div>";
            echo "<label>conducteur secondaire</label><div class='d-flex justify-content-center mb-2'><input type = 'text' name = 'conduc-sec2' value='".$requete5['CONDUCTEUR_SEC']."' required>";
            echo "</div>";
            echo "<label>véhicule enregistré</label><div class='d-flex justify-content-center mb-2'><input type = 'text' name = 'vehicule-registre2' value='".$requete5['VEHIC_ENREGISTRER']."' required>";
            echo "</div>";
            echo "<label>immatriculation</label><div class='d-flex justify-content-center mb-2'><input type = 'text' name = 'immatriculation2' value='".$requete5['IMMATRICULATION']."' required>";
            echo "</div>";
            echo "<label>date d'obtention du permis</label><div class='d-flex justify-content-center mb-2'><input type='date' name='date-permis2' value='".$requete5['PERMIS']."' required>";
            echo "</div>";
            echo "</div>";
            echo "<div class='d-flex w-30 flex-column'>";
            echo "<label>type de permis</label><div class='d-flex justify-content-center mb-2'><select name='type-permis2'><option>".$requete5['TYPE_PERMIS']."</option><option>AM</option><option>2</option></select>";
            echo "</div>";
            echo "<label>permis suspendu</label><div class='d-flex justify-content-center mb-2'><select name='permis-sup2'><option>".$requete5['PERMIS_SUSPENDU']."</option><option>oui</option><option>non</option></select>";
            echo "</div>";
            echo "<label>date enregistrement</label><div class='d-flex justify-content-center mb-2'><input type ='date' name ='date-registre2' value='".$requete5['DATE_ENREGISTREMENT']."' required>";
            echo "</div>";
            echo "<label>date de fin</label><div class='d-flex justify-content-center mb-2'><input type ='date' name ='date-fin2' value='".$requete5['DATE_FIN']."' required>";
            echo "</div>";
            echo "<label>bonus / malus</label><div class='d-flex justify-content-center mb-2'><select name='malus-bonus2'><option>".$requete5['BONUS_MALUS']."</option><option>oui</option><option>non</option></select>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='d-flex justify-content-center mt-1'>";
            echo "<input class='button' type ='submit' value = 'Modifier'>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
            }
        }
        if (isset ($_POST['malus-bonus2'])){
        $catPro2=$_POST['cat-pro2'];
        $trajets2=$_POST['trajets2'];
        $adresseTRavail2=$_POST['adresse-travail2'];
        $kilometres2=$_POST['km-ans2'];
        $ageVoiture2=$_POST['age-voiture2'];
        $titulaire2=$_POST['titulaire2'];
        $conducteurSecondaire2=$_POST['conduc-sec2'];
        $vehiculeRegistre2=$_POST['vehicule-registre2'];
        $immatriculation2=$_POST['immatriculation2'];
        $datePermis2=$_POST['date-permis2'];
        $permisType2=$_POST['type-permis2'];
        $permiSup2=$_POST['permis-sup2'];
        $typeContrat2=$_POST['select-contrat2'];
        $dateRegistre2=$_POST['date-registre2'];
        $dateFin2=$_POST['date-fin2'];
        $malusBonus2=$_POST['malus-bonus2'];
        $sql8= "UPDATE t_contrat SET CAT_PRO='$catPro2', TRAJETS='$trajets2', ADRESSE_TRAVAIL='$adresseTRavail2', KM_ANS='$kilometres2', TEMPS_VOITURE='$ageVoiture2', TITULAIRE='$titulaire2', CONDUCTEUR_SEC='$conducteurSecondaire2', VEHIC_ENREGISTRER='$vehiculeRegistre2', IMMATRICULATION='$immatriculation2', PERMIS='$datePermis2', TYPE_PERMIS='$permisType2', PERMIS_SUSPENDU='$permiSup2', TYPE_CONTRAT='$typeContrat2', DATE_ENREGISTREMENT='$dateRegistre2', DATE_FIN='$dateFin2', BONUS_MALUS='$malusBonus2'";
        $result8=$connection->query($sql8);} 
        ?>
    <!-- <form method="GET">
        <div class="d-flex justify-content-center">
        <input type="search" name="q" placeholder="Recherche..." />
        <input type="submit" value="Valider" />
        <?php 
        $articles = $connection->query('SELECT NOM_CLIENT FROM t_client ORDER BY ID_CLIENT DESC');
        if(isset($_GET['q']) AND !empty($_GET['q'])) {
        $q = htmlspecialchars($_GET['q']);
        $articles = $connection->query('SELECT NOM_CLIENT FROM t_client WHERE NOM_CLIENT LIKE "%'.$q.'%" ORDER BY ID_CLIENT DESC');
        }
        ?> 
        </div>
    </form> -->
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