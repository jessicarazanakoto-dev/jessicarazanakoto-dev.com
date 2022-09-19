<?php
require_once 'config.php';
$stockage = 'image/';
//declaration des variables
$nom = $prenom = $email = $pseudo =$password= $image = "";
$nomError = $prenomError = $emailError = $pseudoError= $passwordError = $imageError = "";
 //recuperation des donnees  methode post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //validation nom
  $nom = htmlspecialchars($_POST["nom"]);
  if (empty($nom)) {
    $nomError = " Entrer votre nom s'il vous plaît.";
  } elseif (!filter_var($nom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
    $nomError = " Entrer un nom valide.";
  } else {
    $nom = $nom;
  }
  //validation prénoms
  $prenom = htmlspecialchars($_POST["prenom"]);
  if (empty($prenom)) {
    $prenomError = " Entrer votre prénoms s'il vous plaît.";
  } elseif (!filter_var($prenom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
    $prenomError = " Entrer un prénoms valide.";
  } else {
    $prenom = $prenom;
  }

  //validation e_mail
  $email = htmlspecialchars($_POST["email"]);
  if (empty($email)) {
    $emailError = " Entrer votre e_mail s'il vous plaît.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL, array("options" => array("regexp" => "/^[a-z0-9.-]+@[a-z0-9._-]{2,}.[a-z]{2,4}$/")))) {
    $emailError = " Entrer un e_mail valide.";
  } else {
    $email = $email;
  }

  //validation nom utilisateur
  $pseudo = htmlspecialchars($_POST["pseudo"]);
  if (empty($pseudo)) {
    $pseudoError = " Entrer votre nom utilisateur s'il vous plaît.";
  } elseif (!filter_var($pseudo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
    $pseudoError = " Entrer un nom utilisateur valide.";
  } else {
    $pseudo = $pseudo;
  }
  //validation mmot de passe
  $password = htmlspecialchars($_POST["password"]);
  if (empty($password)) {
    $passwordError = " Entrer votre mot de passe s'il vous plaît.";
  } elseif (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
    $passwordError = " Entrer un mot de passe valide.";
  } else {
    $password = $password;
  }

   //validate contact 

   /*$input_contact= trim($_POST["contact"]);
   if(empty($input_contact)){
       $contact_err = "Please enter the phone amount.";     
   } elseif(!ctype_digit($input_contact)){
       $contact_err = "Please enter a positive integer value.";
   } else{
       $contact = $input_contact;
   }*/

  //validation image
  $image = $_FILES['image'];
  $image = $_FILES['image']['name'];
  $imgTmp = $_FILES['image']['tmp_name'];
  $imgSize = $_FILES['image']['size'];

  if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
    $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    $extension  = array('jpeg', 'jpg', 'png', 'gif');

    $userPic = time() . '_' . rand(1000, 9999) . '.' . $imgExt;

    if (in_array($imgExt, $extension)) {

      if ($imgSize < 5000000) {
      move_uploaded_file($imgTmp, $stockage . $userPic);
      } else {
        $imageError = 'Selectionner une image valide.';
      }
    } else {
      $imageError = 'Sélectionner une image valide.';
    }
  }

 
  //verification des champs
  if (empty($nomError) && empty($prenomError) && empty($emailError) && empty($pseudoError) && empty($passwordError) && empty($imageError)) {
    // insertion dans la base de donnee
    $sql = "INSERT INTO utilisateur (nom, prenom ,email ,pseudo,password, image) VALUES (?,?,?,?,?)";
   // la requete
    if ($statement = mysqli_prepare($connexion, $sql)) {
  //initiation des parametre
      mysqli_stmt_bind_param($statement, "ssssss", $param_nom, $param_prenom, $param_email, $param_pseudo,$param_password, $param_image);
    }

    $param_nom = $nom;
    $param_prenom = $prenom;
    $param_email = $email;
    $param_pseudo = $pseudo;
    $param_password=$password;
    $param_image = $image;
  //execution de la requete
    if (mysqli_stmt_execute($statement)) {    
      header("location:index.php");
      exit();
    } else {
      echo "une erreur a survenu, veuillez réessayer s'il vous plaît";
    }

       mysqli_stmt_close($statement);
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
      <h1>AJOUTER UN UTILISATEUR</h1>
      <form id="form-contact" method="post" action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]); ?>" role="form" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-5">
        <div class="form-group" <?php echo (!empty($nomError)) ? 'has-error' : ''; ?>>
          <label for="nom">Nom</label>
          <input id="nom" type="text" name="nom" placeholder="Votre nom" class="control" value="<?php echo $nom; ?>">
          <br>
          <span class="erreur"><?php echo $nomError; ?></span>

        </div>
        <div class="form-group" <?php echo (!empty($prenomError)) ? 'has-error' : ''; ?>>
          <label for="prenom">Prénoms</label>
          <input id="prenom" type="text" name="prenom" class="control" placeholder="Votre prénoms" value="<?php echo $prenom; ?>">
          <br>
          <span class="erreur"><?php echo $prenomError; ?></span>


        </div>
        <div class="form-group" <?php echo (!empty($emailError)) ? 'has-error' : ''; ?>>
          <label for="email">E-mail</label>
          <input id="email" type="email" name="email" class="control" placeholder="Votre email" value="<?php echo $email; ?>">
          <br>
          <span class="erreur"><?php echo $emailError; ?></span>

        </div>
        </div>
        <div class="col-lg-5">
        <div class="form-group" <?php echo (!empty($pseudoError)) ? 'has-error' : ''; ?>>
          <label for="pseudo">Nom utilisateur</label>
          <input id="pseudo" type="text" name="pseudo" class="control" placeholder="Votre nom d'itulisateur" value="<?php echo $pseudo; ?>">
          
          <br><span class="erreur"><?php echo $pseudoError; ?></span>

        </div>
        <div class="col-lg-5">
        <div class="form-group" <?php echo (!empty($passwordError)) ? 'has-error' : ''; ?>>
          <label for="password">Nom utilisateur</label>
          <input id="password" type="password" name="password" class="control" placeholder="mot de passe" value="<?php echo $pseudo; ?>">
          
          <br><span class="erreur"><?php echo $passwordError; ?></span>

        </div>
        <div class="form-group" <?php echo (!empty($imageError)) ? 'has-error' : ''; ?>>
          <label for="image">Sélectionner une image</label>
          <input id="image" type="file" name="image" class="control" placeholder="" value="<?php echo $image;?>">
         <br> <span class="erreur"><?php echo $imageError; ?></span>
        </div>

        <div class="form-action" id="envoye">
  <input type="submit" class="button1" value="Enregistrer">
<br>
  <a href="index.php" class="btn btn-info">Retour </a>
        </div>
        </div>
    </div>
  </div>
  </div>
  </div>


  </div>
  </div>
  </form>

  </div>
  </div>
  </div>

</body>

</html>