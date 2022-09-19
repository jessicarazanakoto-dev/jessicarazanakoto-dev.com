<?php
 require_once "config.php";
$pseudo =$password = "";
 $pseudoError =$passwordError=  "";
 if(isset($_POST["id"]) && !empty($_POST["id"])){ 
  $id = $_POST["id"];
  //validation nom utilisateur
  $pseudo = htmlspecialchars($_POST["pseudo"]);
  if (empty($pseudo)) {
    $pseudoError = " Entrer votre nom utilisateur s'il vous plaît.";
  } elseif (!filter_var($pseudo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
    $pseudoError = " Entrer un nom utilisateur valide.";
  } else {
    $pseudo = $pseudo;
  }
    //validation mot de passe
    $password = htmlspecialchars($_POST["password"]);
    if (empty($password)) {
      $passwordError = " Entrer votre mot de passe s'il vous plaît.";
    } elseif (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
      $passwordError = " Entrer un mot de passe valide.";
    } else {
      $password = $password;
    }
    if(empty($pseudoError) && empty($passwordError)) {

    //recuperation deans la basse de donne
    $sql = "SELECT utilisateur SET pseudo=? ,password=? WHERE  id=?";
    if ($statement = mysqli_prepare($connexion, $sql)){
      mysqli_stmt_bind_param($statement, "ssi", $param_pseudo,$param_password, $param_id);
      $param_pseudo = $pseudo;
      $param_password=$password;
      $param_id =$id;
    if (mysqli_stmt_execute($statement)) {
      header("location:liste.php");
      exit();
    } else {
      echo "une erreur est survenue, veuillez réessayer s'il vous plaît";
    }
    mysqli_stmt_close($statement);
}
}
     mysqli_close($connexion);
}

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
        <div id="somme">
            <div class="row">
                <div class="col-lg-12">
                <h1>GESTION DES UTILISATEURS</h1> 
                </div> 
                <form id="form-contact" method="post" action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]); ?>" role="form" enctype="multipart/form-data">
        
         
        <div class="form-group" <?php echo (!empty($pseudoError)) ? 'has-error' : ''; ?>>
          <label for="pseudo">Nom utilisateur</label><br>
          <input id="pseudo" type="text" name="pseudo" class="control" placeholder="Votre nom d'itulisateur" value="<?php echo $pseudo; ?>">
          
          <br><span class="erreur"><?php echo $pseudoError; ?></span>

        </div>
        <div class="form-group" <?php echo (!empty($passwordError)) ? 'has-error' : ''; ?>>
          <label for="password">Mot de passe</label><br>
          <input id="password" type="password" name="password" class="control" placeholder="Votre  mot de passe">
          
          <br><span class="erreur"><?php echo $passwordError; ?></span>

        </div>

        <div class="form-action" id="envoye">
        <p><input type="submit" class="button1" value="Se connecter">

Pas encore membre?<a href="ajouter.php">S'inscrire</a></p>
        </div>
    </div>
  </form>


              
     </div>
    </div>
</body>

</html>
    