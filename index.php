<?php 
require_once 'config.php';
if(isset($_GET)){
    $sql = "SELECT distinct nom FROM utilisateur";
    $resultat = mysqli_query($connexion,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div id="liste">
            <h1>LISTE DES UTILISATEURS</h1>
            <button class="button2"><a href="ajouter.php">Ajouter un utilisateur</a></button>
              <?php
            require_once 'config.php';

            //recuperation des donnees dans la basse
            $sql = "SELECT * FROM utilisateur";
            //affichage des donnees
            if ($result = mysqli_query($connexion, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<table class='table table-bordered table-striped'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Id</th>";
                    echo "<th>Nom</th>";
                    echo "<th>Prénom</th>";
                    echo "<th>Email</th>";
                    echo "<th>Pseudo</th>";
                    //  echo "<th>Image</th>";
                    echo "<th>Date de creation</th>";
                    echo "<th>Date de modification</th>";
                    echo "<th>Actions</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                  //methode utilise
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "<td>" . $row['prenom'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['pseudo'] . "</td>";
                        //  echo "<td>" . $row['image'] . "</td>";
                        echo "<td>" . $row['date_creation'] . "</td>";
                        echo "<td>" . $row['date_modification'] . "</td>";
                        echo "<td>";
                        echo '<a href="voir.php?id=' . $row['id'] . '"> <i class="fa fa-eye"></i> 
                                        </a>';
                        echo '<a href="modifier.php?id=' . $row['id'] . '"><i class="fa fa-pencil"></i></a>';
                        echo '<a href="supprimer.php?id=' . $row['id'] . '"><i class="fa fa-trash"></i></a>';
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";

                    mysqli_free_result($result);
                }
            }
//fermeture de la connexion
            mysqli_close($connexion);
        }
            ?>
            <div class="pagination">
                <a href="#">&laquo;</a>
                <a class="active" href="">1</a>
                <a href="">2</a>
                <a href="">3</a>
                <a href="#">&raquo;</a>
            </div>
            <br>
  <a href="index.php" class="btn btn-info">Retour </a>
        </div>
    </div>
</body>

</html>