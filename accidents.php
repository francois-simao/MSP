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
<h1 class="titre-h1">ASSURTOUT</h1>
    <h3>Ajouter un accident</h3>
    <form action="" method="post" class="d-flex justify-content-center mb-2">
    <div class="align-item-center"><label class="mr-1">Selectionner le client</label><select name = "client">
            <?php
            $sql = "select NOM_CLIENT,ID_CLIENT FROM t_client"; //instruction/requete sql
            $result=$connection->query($sql); //demande a la base de donnée de executer la requete
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$resultrow['ID_CLIENT'].'">'.$resultrow['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
    <input class="button" type = "submit"></div>
    </form>
    <?php
    if (isset($_POST['client'])){
    $client=$_POST['client'];
    echo '<form action="" method="post">';
    echo '<div class="d-flex justify-content-center mb-2"><label class="mr-1">SELECTIONNER LE CONTRAT</label><select name = "client">';
    $sql2 = "select id_client,ID_CONTRAT,TYPE_CONTRAT from t_contrat WHERE id_client = '$client'"; //instruction/requete sql
    $result=$connection->query($sql2); //demande a la base de donnée de executer la requete
    while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$resultrow['ID_CONTRAT'].'">'.$resultrow['TYPE_CONTRAT'].'</option>';
    }
    echo '</select></div>';
    echo "<div class='d-flex'>";
    echo "<div class='d-flex flex-column flex-start w-50'>";
    echo "<div class='w-100 d-flex justify-content-around mb-2'><label>Selectionner lA date de l'accident</label><input class='d-flex flex-end' type='date' name = 'date-accident'></div>";
    echo "<div class='w-100 d-flex justify-content-around mb-2'><label>Selectionner le lieu de l'accident</label><input class='d-flex flex-end' type='text' name = 'lieu'></div>";
    echo "<div class='w-100 d-flex justify-content-around mb-2'><label>Selectionner la nature de l'accident</label><input class='d-flex flex-end' type='text' name = 'nature'></div>";
    echo "<div class='w-100 d-flex justify-content-around mb-2'><label>Selectionner les dommages de l'accident</label><input class='d-flex flex-end' type='text' name = 'dommage'></div>";
    echo "<div class='w-100 d-flex justify-content-around mb-2'><label>Selectionner les temoins de l'accident</label><input class='d-flex flex-end' type='text' name = 'temoins'></div>";
    echo "</div>";
    echo "<div class='d-flex flex-column flex-end w-50'>";
    echo "<div class='w-100 d-flex justify-content-around mb-2 font-size2'><label>Selectionner le nom de la ou des personnes impliquées</label><input class='d-flex flex-end' type='text' name = 'nom-perso'></div>";
    echo "<div class='w-100 d-flex justify-content-around mb-2'><label>Selectionner coordonnées de l'assurance</label><input class='d-flex flex-end' type='text' name = 'coordonnees'></div>";
    echo "<div class='w-100 d-flex justify-content-around mb-2'><label>Selectionner responsabilité</label><input class='d-flex flex-end' type='text' name = 'responsabilite'></div>";
    echo "<div class='w-100 d-flex justify-content-around mb-2'><label>Selectionner la date d'envoi du constat</label><input class='d-flex flex-end' type='date' name = 'date_constat'></div>";
    echo "</div>";
    echo "</div>";
    echo "<div class='d-flex justify-content-center mb-2'>";
    echo '<input class="button" type ="submit"></input>';
    echo "</div>";
    echo '</form>';  
    }

    if (isset($_POST['date_constat']) && !empty($_POST['date_constat'])){
    $client=$_POST['client'];
    $date_accident=$_POST['date-accident'];
    $lieu=$_POST['lieu'];
    $nature=$_POST['nature'];
    $dommage=$_POST['dommage'];
    $temoins=$_POST['temoins'];
    $nom_perso=$_POST['nom-perso'];
    $coordonnees=$_POST['coordonnees'];
    $responsablite=$_POST['responsabilite'];
    $date_constat=$_POST['date_constat'];
  
    $sql = "INSERT INTO t_accidents (id_contrat, DATE_ACCIDENT, LIEU, NATURE, DOMMAGE, TEMOINS, NOM_PERSONNE, COORDONNEES, RESPONSABILITE, DATE_CONSTAT) VALUES ('$client','$date_accident','$lieu','$nature','$dommage','$temoins','$nom_perso','$coordonnees','$responsablite','$date_constat');";
    $result=$connection->query($sql);}

?>
    <h3>Modifier</h3>
    <form action="" method="post" class="d-flex justify-content-center flex-column">
        <div class="d-flex justify-content-center mb-1">
    <label class="mr-1">Selectionner le client</label><select class="w-min-content" name = "client2">
            <?php
            $sql = "select * FROM t_client"; //instruction/requete sql
            $result=$connection->query($sql); //demande a la base de donnée de executer la requete
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$resultrow['ID_CLIENT'].'">'.$resultrow['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
            </div>
    <div class="d-flex justify-content-center mb-1"><label class="mr-1">Selctionner le contrat</label><select name = "contrat">
        <?php
        $sql2 = "select ID_CONTRAT,TYPE_CONTRAT from t_contrat"; //instruction/requete sql
        $result=$connection->query($sql2); //demande a la base de donnée de executer la requete
        while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$resultrow['ID_CONTRAT']."'>".$resultrow['TYPE_CONTRAT']."</option>";
        }
        ?>
        </select></div>
        <div class="d-flex justify-content-center mb-1"><label class="mr-1">Selectionner la date de l'accident</label><select name = "date">
        <?php
        $sql2 = "select DATE_ACCIDENT from t_accidents"; //instruction/requete sql
        $result=$connection->query($sql2); //demande a la base de donnée de executer la requete
        while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$resultrow['DATE_ACCIDENT']."'>".$resultrow['DATE_ACCIDENT']."</option>";
        }
        ?>
        </select></div>
        <div class="d-flex justify-content-center mb-2">
    <input class="button w-min-content" type = "submit" />
    </div>
    </form>
    <?php
        if (isset($_POST['date'])){
            $client2=$_POST['client2'];
            $contrat=$_POST['contrat'];
            $date=$_POST['date'];
            $sql4 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $contrat=t_contrat.ID_CONTRAT and  $client2=t_contrat.id_client and '$date'=t_accidents.DATE_ACCIDENT"; //instruction/requete sql
            $result=$connection->query($sql4); //demande a la base de donnée de executer la requete
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {    
                echo '<form action="" method="post" class="flex-column">';
                echo "<div><label>SELECTIONNER LA date de l'accident</label><input type='text' name = 'id-accident' value= '".$resultrow['ID_ACCIDENT']."'></div>";
                echo "<div><label>SELECTIONNER LA date de l'accident</label><input type='date' name = 'date-accident2' value= '".$resultrow['DATE_ACCIDENT']."'></div>";
                echo "<div><label>SELECTIONNER Le lieu de l'accident</label><input type='text' name = 'lieu2' value= '".$resultrow['LIEU']."'></div>";
                echo "<div><label>SELECTIONNER La nature de l'accident</label><input type='text' name = 'nature2' value= '".$resultrow['NATURE']."'></div>";
                echo "<div><label>SELECTIONNER Les dommages de l'accident</label><input type='text' name = 'dommage2' value= '".$resultrow['DOMMAGE']."'></div>";
                echo "<div><label>SELECTIONNER Les temoins de l'accident</label><input type='text' name = 'temoins2' value= '".$resultrow['TEMOINS']."'></div>";
                echo "<div><label>SELECTIONNER Le nom de la ou des personnes impliquées</label><input type='text' name = 'nom-perso2' value= '".$resultrow['NOM_PERSONNE']."'></div>";
                echo "<div><label>SELECTIONNER coordonnées de l'assurance</label><input type='text' name = 'coordonnees2' value= '".$resultrow['COORDONNEES']."'></div>";
                echo "<div><label>SELECTIONNER responsabilité</label><input type='text' name = 'responsabilite2' value= '".$resultrow['RESPONSABILITE']."'></div>";
                echo "<div><label>SELECTIONNER La date d'envoi du constat</label><input type='date' name = 'date_constat2' value= '".$resultrow['DATE_CONSTAT']."'></div>";
                echo '<button type = "submit">Envoyer</button>';
                echo '</form>'; 
                
            }
        }

    if (isset($_POST['id-accident']) && !empty($_POST['id-accident'])){
  
    $sql5 = "update t_accidents set LIEU = '".$_POST['lieu2']."', NATURE = '".$_POST['nature2']."', 
    DOMMAGE = '".$_POST['dommage2']."', TEMOINS = '".$_POST['temoins2']."', 
    NOM_PERSONNE = '".$_POST['nom-perso2']."', COORDONNEES = '".$_POST['coordonnees2']."', 
    RESPONSABILITE = '".$_POST['responsabilite2']."', DATE_CONSTAT = '".$_POST['date_constat2']."' WHERE ID_ACCIDENT='".$_POST['id-accident']."';";
    $result=$connection->query($sql5);}
?>






    <h3>Supprimer</h3>
    <form action="" method="post" class="d-flex justify-content-center flex-column">
    <div class="d-flex justify-content-center mb-1">
    <label class="mr-1">Selectionner le client</label><select name = "client3">
            <?php
            $sql = "select * FROM t_client"; //instruction/requete sql
            $result=$connection->query($sql); //demande a la base de donnée de executer la requete
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$resultrow['ID_CLIENT'].'">'.$resultrow['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
        </div>
    <div class="d-flex justify-content-center mb-1"><label class="mr-1">Selctionner le contrat</label><select name = "contrat3">
        <?php
        $sql2 = "select ID_CONTRAT,TYPE_CONTRAT from t_contrat"; //instruction/requete sql
        $result=$connection->query($sql2); //demande a la base de donnée de executer la requete
        while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$resultrow['ID_CONTRAT']."'>".$resultrow['TYPE_CONTRAT']."</option>";
        }
        ?>
        </select></div>
        <div class="d-flex justify-content-center mb-1"><label class="mr-1">Selectionner la date de l'accident</label><select name = "date3">
        <?php
        $sql2 = "select DATE_ACCIDENT from t_accidents"; //instruction/requete sql
        $result=$connection->query($sql2); //demande a la base de donnée de executer la requete
        while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$resultrow['DATE_ACCIDENT']."'>".$resultrow['DATE_ACCIDENT']."</option>";
        }
        ?>
        </select></div>
        <div class=" d-flex justify-content-center mb-2">
    <input class="button w-min-content" type = "submit"></input>
    </div>
    </form>
    <?php
        if (isset($_POST['date3'])){
            $client3=$_POST['client3'];
            $contrat3=$_POST['contrat3'];
            $date3=$_POST['date3'];
            $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $contrat3=t_contrat.ID_CONTRAT and  $client3=t_contrat.id_client and '$date3'=t_accidents.DATE_ACCIDENT"; //instruction/requete sql
            $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {    
                $ID_ACCIDENT=$resultrow['ID_ACCIDENT'];
                $sql5 = "DELETE FROM `t_accidents`  WHERE ID_ACCIDENT= $ID_ACCIDENT";
                $result=$connection->query($sql5);}
            }
    ?>
    <h3>Rechercher</h3>
    <form action="" method="post" class="d-flex justify-content-center flex-column">
    <div class="d-flex justify-content-center mb-1">
    <label class="mr-1">Selectionner le client</label><select name = "client4">
            <?php
            $sql = "select * FROM t_client"; //instruction/requete sql
            $result=$connection->query($sql); //demande a la base de donnée de executer la requete
            echo "<option selected='selected'></option>";
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$resultrow['ID_CLIENT'].'">'.$resultrow['NOM_CLIENT'].'</option>';
            }
            ?>
            </select>
        </div>
        <div class="d-flex justify-content-center mb-1"><label class="mr-1">Selctionner le contrat</label><select name = "contrat4">
        <?php
        $sql = "select ID_CONTRAT,TYPE_CONTRAT from t_contrat"; //instruction/requete sql
        $result=$connection->query($sql); //demande a la base de donnée de executer la requete
        echo "<option selected='selected'></option>";
        while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$resultrow['ID_CONTRAT']."'>".$resultrow['TYPE_CONTRAT']."</option>";
        }
        ?>
        </select></div>
        <div class="d-flex justify-content-center mb-1"><label class="mr-1">Selectionner la date de l'accident</label><select name = "date4">
        <?php
        $sql = "select DATE_ACCIDENT from t_accidents"; //instruction/requete sql
        $result=$connection->query($sql); //demande a la base de donnée de executer la requete
        echo "<option selected='selected'></option>";
        while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$resultrow['DATE_ACCIDENT']."'>".$resultrow['DATE_ACCIDENT']."</option>";
        }
        ?>
        </select></div>
        <div class="d-flex justify-content-center mb-4">
    <input class="button w-min-content" type = "submit" />
    </div>
    </form>
    <?php
        if (isset($_POST['client4']) && !empty($_POST['client4']) && isset($_POST['contrat4']) && !empty($_POST['contrat4']) && isset($_POST['date4']) && !empty($_POST['date4'])){
            $client4=$_POST['client4'];
            $contrat4=$_POST['contrat4'];
            $date4=$_POST['date4'];
            $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $contrat4=t_contrat.ID_CONTRAT and  $client4=t_contrat.id_client and '$date4'=t_accidents.DATE_ACCIDENT"; //instruction/requete sql
            $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
            echo "<div class='flex-taille'><div class='taille'><p>NOM CLIENT</p></div><div class='taille'><p>DATE ACCIDENT</p></div><div class='taille'><p>LIEU DE L'ACCIDENT</p></div><div class='taille'><p>NATURE</p></div><div class='taille'><p>DOMMAGE</p></div><div class='taille'><p>TEMOINS</p></div><div class='taille'><p>NOM DES PERSONNES CONCERNEES</p></div><div class='taille'><p>COORDONNEES DE L'ASSURANCE</p></div><div class='taille'><p>RESPONSABILITE</p></div><div class='taille'><p>DATE DU CONSTAT</p></div></div>";
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {    
                echo "<div class='flex-taille'><div class='taille'><p>".$resultrow['NOM_CLIENT']."</p></div><div class='taille'><p>".$resultrow['DATE_ACCIDENT']."</p></div><div class='taille'><p>".$resultrow['LIEU']."</p></div><div class='taille'><p>".$resultrow['NATURE']."</p></div><div class='taille'><p>".$resultrow['DOMMAGE']."</p></div><div class='taille'><p>".$resultrow['TEMOINS']."</p></div><div class='taille'><p>".$resultrow['NOM_PERSONNE']."</p></div><div class='taille'><p>".$resultrow['COORDONNEES']."</p></div><div class='taille'><p>".$resultrow['RESPONSABILITE']."</p></div><div class='taille'><p>".$resultrow['DATE_CONSTAT']."</p></div></div>"; 
            }
        }
        else if (isset($_POST['client4']) && empty($_POST['client4']) && isset($_POST['date4']) && empty($_POST['date4']) && isset($_POST['contrat4']) && empty($_POST['contrat4'])){

            $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat"; //instruction/requete sql
            $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
            echo "<div class='flex-taille'><div class='taille'><p>NOM CLIENT</p></div><div class='taille'><p>DATE ACCIDENT</p></div><div class='taille'><p>LIEU DE L'ACCIDENT</p></div><div class='taille'><p>NATURE</p></div><div class='taille'><p>DOMMAGE</p></div><div class='taille'><p>TEMOINS</p></div><div class='taille'><p>NOM DES PERSONNES CONCERNEES</p></div><div class='taille'><p>COORDONNEES DE L'ASSURANCE</p></div><div class='taille'><p>RESPONSABILITE</p></div><div class='taille'><p>DATE DU CONSTAT</p></div></div>";
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='flex-taille'><div class='taille'><p>".$resultrow['NOM_CLIENT']."</p></div><div class='taille'><p>".$resultrow['DATE_ACCIDENT']."</p></div><div class='taille'><p>".$resultrow['LIEU']."</p></div><div class='taille'><p>".$resultrow['NATURE']."</p></div><div class='taille'><p>".$resultrow['DOMMAGE']."</p></div><div class='taille'><p>".$resultrow['TEMOINS']."</p></div><div class='taille'><p>".$resultrow['NOM_PERSONNE']."</p></div><div class='taille'><p>".$resultrow['COORDONNEES']."</p></div><div class='taille'><p>".$resultrow['RESPONSABILITE']."</p></div><div class='taille'><p>".$resultrow['DATE_CONSTAT']."</p></div></div>"; 
            }
        }
        else if (isset($_POST['client4']) && !empty($_POST['client4']) && isset($_POST['date4']) && !empty($_POST['date4'])){
            $client4=$_POST['client4'];
            $date4=$_POST['date4'];
            $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $client4=t_contrat.id_client and '$date4'=t_accidents.DATE_ACCIDENT"; //instruction/requete sql
            $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
            echo "<div class='flex-taille'><div class='taille'><p>NOM CLIENT</p></div><div class='taille'><p>DATE ACCIDENT</p></div><div class='taille'><p>LIEU DE L'ACCIDENT</p></div><div class='taille'><p>NATURE</p></div><div class='taille'><p>DOMMAGE</p></div><div class='taille'><p>TEMOINS</p></div><div class='taille'><p>NOM DES PERSONNES CONCERNEES</p></div><div class='taille'><p>COORDONNEES DE L'ASSURANCE</p></div><div class='taille'><p>RESPONSABILITE</p></div><div class='taille'><p>DATE DU CONSTAT</p></div></div>";
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='flex-taille'><div class='taille'><p>".$resultrow['NOM_CLIENT']."</p></div><div class='taille'><p>".$resultrow['DATE_ACCIDENT']."</p></div><div class='taille'><p>".$resultrow['LIEU']."</p></div><div class='taille'><p>".$resultrow['NATURE']."</p></div><div class='taille'><p>".$resultrow['DOMMAGE']."</p></div><div class='taille'><p>".$resultrow['TEMOINS']."</p></div><div class='taille'><p>".$resultrow['NOM_PERSONNE']."</p></div><div class='taille'><p>".$resultrow['COORDONNEES']."</p></div><div class='taille'><p>".$resultrow['RESPONSABILITE']."</p></div><div class='taille'><p>".$resultrow['DATE_CONSTAT']."</p></div></div>"; 
            }
        }
        else if (isset($_POST['client4']) && !empty($_POST['client4']) && isset($_POST['contrat4']) && !empty($_POST['contrat4'])){
            $client4=$_POST['client4'];
            $contrat4=$_POST['contrat4'];
            $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $client4=t_contrat.id_client AND $contrat4=t_contrat.ID_CONTRAT"; //instruction/requete sql
            $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
            echo "<div class='flex-taille'><div class='taille'><p>NOM CLIENT</p></div><div class='taille'><p>DATE ACCIDENT</p></div><div class='taille'><p>LIEU DE L'ACCIDENT</p></div><div class='taille'><p>NATURE</p></div><div class='taille'><p>DOMMAGE</p></div><div class='taille'><p>TEMOINS</p></div><div class='taille'><p>NOM DES PERSONNES CONCERNEES</p></div><div class='taille'><p>COORDONNEES DE L'ASSURANCE</p></div><div class='taille'><p>RESPONSABILITE</p></div><div class='taille'><p>DATE DU CONSTAT</p></div></div>";
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='flex-taille'><div class='taille'><p>".$resultrow['NOM_CLIENT']."</p></div><div class='taille'><p>".$resultrow['DATE_ACCIDENT']."</p></div><div class='taille'><p>".$resultrow['LIEU']."</p></div><div class='taille'><p>".$resultrow['NATURE']."</p></div><div class='taille'><p>".$resultrow['DOMMAGE']."</p></div><div class='taille'><p>".$resultrow['TEMOINS']."</p></div><div class='taille'><p>".$resultrow['NOM_PERSONNE']."</p></div><div class='taille'><p>".$resultrow['COORDONNEES']."</p></div><div class='taille'><p>".$resultrow['RESPONSABILITE']."</p></div><div class='taille'><p>".$resultrow['DATE_CONSTAT']."</p></div></div>";   
            }
        }
        else if (isset($_POST['client4']) && !empty($_POST['client4'])){
            $client4=$_POST['client4'];
            $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $client4=t_contrat.id_client"; //instruction/requete sql
            $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
            echo "<div class='flex-taille'><div class='taille'><p>NOM CLIENT</p></div><div class='taille'><p>DATE ACCIDENT</p></div><div class='taille'><p>LIEU DE L'ACCIDENT</p></div><div class='taille'><p>NATURE</p></div><div class='taille'><p>DOMMAGE</p></div><div class='taille'><p>TEMOINS</p></div><div class='taille'><p>NOM DES PERSONNES CONCERNEES</p></div><div class='taille'><p>COORDONNEES DE L'ASSURANCE</p></div><div class='taille'><p>RESPONSABILITE</p></div><div class='taille'><p>DATE DU CONSTAT</p></div></div>";
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='flex-taille'><div class='taille'><p>".$resultrow['NOM_CLIENT']."</p></div><div class='taille'><p>".$resultrow['DATE_ACCIDENT']."</p></div><div class='taille'><p>".$resultrow['LIEU']."</p></div><div class='taille'><p>".$resultrow['NATURE']."</p></div><div class='taille'><p>".$resultrow['DOMMAGE']."</p></div><div class='taille'><p>".$resultrow['TEMOINS']."</p></div><div class='taille'><p>".$resultrow['NOM_PERSONNE']."</p></div><div class='taille'><p>".$resultrow['COORDONNEES']."</p></div><div class='taille'><p>".$resultrow['RESPONSABILITE']."</p></div><div class='taille'><p>".$resultrow['DATE_CONSTAT']."</p></div></div>";     
            }
        }
        else if (isset($_POST['contrat4']) && !empty($_POST['contrat4'])){
            $contrat4=$_POST['contrat4'];
            $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where $contrat4=t_contrat.ID_CONTRAT"; //instruction/requete sql
            $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
            echo "<div class='flex-taille'><div class='taille'><p>NOM CLIENT</p></div><div class='taille'><p>DATE ACCIDENT</p></div><div class='taille'><p>LIEU DE L'ACCIDENT</p></div><div class='taille'><p>NATURE</p></div><div class='taille'><p>DOMMAGE</p></div><div class='taille'><p>TEMOINS</p></div><div class='taille'><p>NOM DES PERSONNES CONCERNEES</p></div><div class='taille'><p>COORDONNEES DE L'ASSURANCE</p></div><div class='taille'><p>RESPONSABILITE</p></div><div class='taille'><p>DATE DU CONSTAT</p></div></div>";
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='flex-taille'><div class='taille'><p>".$resultrow['NOM_CLIENT']."</p></div><div class='taille'><p>".$resultrow['DATE_ACCIDENT']."</p></div><div class='taille'><p>".$resultrow['LIEU']."</p></div><div class='taille'><p>".$resultrow['NATURE']."</p></div><div class='taille'><p>".$resultrow['DOMMAGE']."</p></div><div class='taille'><p>".$resultrow['TEMOINS']."</p></div><div class='taille'><p>".$resultrow['NOM_PERSONNE']."</p></div><div class='taille'><p>".$resultrow['COORDONNEES']."</p></div><div class='taille'><p>".$resultrow['RESPONSABILITE']."</p></div><div class='taille'><p>".$resultrow['DATE_CONSTAT']."</p></div></div>";     
            }
        }
        else if (isset($_POST['date4']) && !empty($_POST['date4'])){
            $date4=$_POST['date4'];
            $sql5 = "select * from t_client inner join t_contrat on t_client.ID_CLIENT=t_contrat.id_client inner join t_accidents on t_contrat.ID_CONTRAT=t_accidents.id_contrat where '$date4'=t_accidents.DATE_ACCIDENT"; //instruction/requete sql
            $result=$connection->query($sql5); //demande a la base de donnée de executer la requete
            echo "<div class='flex-taille'><div class='taille'><p>NOM CLIENT</p></div><div class='taille'><p>DATE ACCIDENT</p></div><div class='taille'><p>LIEU DE L'ACCIDENT</p></div><div class='taille'><p>NATURE</p></div><div class='taille'><p>DOMMAGE</p></div><div class='taille'><p>TEMOINS</p></div><div class='taille'><p>NOM DES PERSONNES CONCERNEES</p></div><div class='taille'><p>COORDONNEES DE L'ASSURANCE</p></div><div class='taille'><p>RESPONSABILITE</p></div><div class='taille'><p>DATE DU CONSTAT</p></div></div>";
            while ($resultrow=$result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='flex-taille'><div class='taille'><p>".$resultrow['NOM_CLIENT']."</p></div><div class='taille'><p>".$resultrow['DATE_ACCIDENT']."</p></div><div class='taille'><p>".$resultrow['LIEU']."</p></div><div class='taille'><p>".$resultrow['NATURE']."</p></div><div class='taille'><p>".$resultrow['DOMMAGE']."</p></div><div class='taille'><p>".$resultrow['TEMOINS']."</p></div><div class='taille'><p>".$resultrow['NOM_PERSONNE']."</p></div><div class='taille'><p>".$resultrow['COORDONNEES']."</p></div><div class='taille'><p>".$resultrow['RESPONSABILITE']."</p></div><div class='taille'><p>".$resultrow['DATE_CONSTAT']."</p></div></div>";     
            }
        } else {

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