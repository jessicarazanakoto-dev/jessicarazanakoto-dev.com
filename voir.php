<?php

if (isset($_GET["id"]) && !empty(htmlspecialchars($_GET["id"]))) {

    require_once "config.php";
    //recuperation deans la basse de donne
    $sql = "SELECT * FROM utilisateur WHERE id = ?";
    if ($statement = mysqli_prepare($connexion, $sql)) {

        mysqli_stmt_bind_param($statement, "i", $param_id);


        $param_id = htmlspecialchars($_GET["id"]);
        if (mysqli_stmt_execute($statement)) {
            $result = mysqli_stmt_get_result($statement);

            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $nom = $row["nom"];
                $prenom = $row["prenom"];
                $email = $row["email"];
                $pseudo = $row["pseudo"];
                $image = $row["image"];
                $date_creation = $row["date_creation"];
                $date_modification = $row["date_modification"];
            }
        } else {
            echo "Oops! un erreur est survenu, veuillez réessayer plus tard ! ";
        }
    }
    mysqli_stmt_close($statement);
    mysqli_close($connexion);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-moi</title>
    <link rel="stylesheet" href="font/css/all.css" type="text/css">
    <link rel="stylesheet" href="bootstrap-4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</head>

<body>

    <div class="container">

        <div id="somme">

            <h1> GESTION DES UTILISATEURS</h1>

            <div class="row">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label>Nom</label>
                        <p class="form-control-static"><?php echo $row["nom"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <p class="form-control-static"><?php echo $row["prenom"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Nom d'utilisateur</label>
                        <p class="form-control-static"><?php echo $row["pseudo"]; ?></p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">

                        <label>Image</label>
                        <img src="image/<?php echo $row["image"]; ?>" alt="image">
                    </div>
                    <div class="form-group">
                        <label>Date de création</label>
                        <p class="form-control-static"><?php echo $row["date_creation"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date de modification</label>
                        <p class="form-control-static"><?php echo $row["date_modification"]; ?></p>
                    </div>
                    <div class="form-action" id="envoye">
                        <a href="index.php " class="btn btn-info">Retour</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

</body>

</html>