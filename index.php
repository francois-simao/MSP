<?php
    session_name("formulaire");
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container-fluid ">
<form action="deconnexion.php" method="post" >
    <div class="formulaire1">
    <?php
        if ( isset($_SESSION['username']))
        {
            echo '<div class="text">Bonjour ' . $_SESSION['username'].'</div>';
        }
        else {
            header('Location: http://localhost/assurance-auto/form');
        }
    ?>
        <input class ="button" type="submit" value = "Deconnecter">
    </div>
    </div>
    <div class="container h-100 bg-body">
        <h1>Assurtout</h1>
        <div class="flex">
            <a href="http://localhost/assurance-auto/clients.php"><div class="cube">
                <img src="team.png" alt="">
                <h2>Clients</h2>
            </div></a>
            <a href="http://localhost/assurance-auto/experts.php"><div class="cube">
                <img src="team.png" alt="">
                <h2>Experts</h2>
            </div></a>
            <a href="http://localhost/assurance-auto/contrat.php"><div class="cube">
                <img src="team.png" alt="">
                <h2>Contrats</h2>
            </div></a>
            <a href="http://localhost/assurance-auto/accidents.php"><div class="cube">
                <img src="car.png" alt="">
                <h2>Accidents</h2>
            </div></a>
            <a href="http://localhost/assurance-auto/interventions.php"><div class="cube">
                <img src="expert.png" alt="">
                <h2>Interventions</h2>
            </div></a>
        </div>
    </div>
    <footer>
        <div class="container-footer">
            <div class="d-flex justify-content-around pt-2 font-family-roboto">
                <p>Projet php réalisé du 10/02/2020 au 14/02/2020</p>
                <p><span class="color-primary">MOULEROT</span> Manon / <span class="color-primary">SIMAO</span> Francois / <span class="color-primary">LAFARGE</span> Arthur</p>
            </div>
        </div>
    </footer>
</form>
    
</body>
</html>


