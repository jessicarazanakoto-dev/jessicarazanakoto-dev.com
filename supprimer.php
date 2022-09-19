<?php

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    require_once 'config.php';

    $sql = "DELETE FROM utilisateur WHERE id=?";

    if ($statement = mysqli_prepare($connexion, $sql)) {

        mysqli_stmt_bind_param($statement, "i", $param_id);

        $param_id = htmlspecialchars($_POST['id']);

        if (mysqli_stmt_execute($statement)) {

            header("location:index.php");
        } else {
            echo "une erreur est survenue, veuillez réessayer plus tard! ";
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

        <div class="row">
            <div class="col-lg-10 offset-1" id="suppr">
                <h1>SUPPRIMER UN UTILISATEUR</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET["id"]); ?>" />
                    <p>Etes-vous sûre de supprimer un utilisateur</p>
                    <div class="envoye">
                        <a href="index.php"><input type="submit" value="OUI"></a>
                        <button><a href="liste.php">NON</a></button>
                    </div>

                </form>


            </div>
        </div>
    </div>

</body>

</html>