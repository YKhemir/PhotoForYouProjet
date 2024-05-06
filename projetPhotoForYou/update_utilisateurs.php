<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



<!DOCTYPE html>
<html>
<head>
    <title>PhotoforYou</title>
</head>
<body>
<style>
    /* Ajoutez le style pour la classe active */
    .btn.active {
    background-color: #007bff;
    color: #fff;
    }      
    
</style>
<?php 
    include_once('./include/menu_inc.php');
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) ){
        if($_SESSION['user_type'] == "admin"){
            if(isset($_POST['id']) && isset($_POST['Nom']) && (isset($_POST['Prenom']))  && (isset($_POST['Type']))
&& (isset($_POST['Mail']))  && (isset($_POST['Credit']))
){
$UserId = $_POST["id"];
$nomInput = $_POST["Nom"];
$prenomInput = $_POST["Prenom"];
$typeInput = $_POST['Type'];
$mailInput = $_POST['Mail'];
$creditInput = $_POST['Credit'];



  $userManager = new UserManager($db);
  //$idUser = $_SESSION['user_id'] ;
  $user = $userManager->getUser($UserId);
  if($user){
  $user->setNom($_POST['Nom']);
  $user->setPrenom($_POST['Prenom']);
  $user->setMail($_POST['Mail']);
  $user->setCredit($_POST['Credit']);
  $userManager->update($user);
  echo "<p>la modification du utilisateur a été effectué avec succès !<p>";
}

}
            }
      }else{
        

        if(isset($_GET['idDevis'])  ){
            $idUser = $_GET["idUser"];
            $devisObject = new UserManager($db);
            $devis = $devisObject->getUser($idDevis);
            
        } else {
            // redirection php vers la page connexion
            echo 'vous ne pouvez pas accéder à cette page ';
            die();
        } 

    }  


             
    ?>
   
    
<!-- formulaire d'inscription-->       

<form  class="p-3 mb-2" method="post"  novalidate>
    <div class="col-md-4 mb-3" >
            <!-- prenom -->  
        <div class="form-group row" >
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" oninput="saisieTextePrenom(this)" value = "<?php echo $user->getPrenom(); ?>"placeholder="Votre prenom">
            <div class="valid-feedback">
                Prénom Ok !
            </div>
            <div class="invalid-feedback">
                Le champ prénom est obligatoire et doit faire entre 4 et 30 caractères
            </div>
        </div>
    </div >
        <!-- nom -->  
    <div class="col-md-4 mb-3" >
        <div class="form-group row ">
            <label for="Nom">Nom</label>
            <input type="text"  class="form-control" name="nom" id="nom" oninput="saisieTexteNom(this)" value = "<?php echo $user->getNom(); ?>" aria-describedby="emailHelp" placeholder="Votre prénom"  required>
            <div class="valid-feedback">
                Nom Ok !
            </div>
            <div class="invalid-feedback">
                Le champ nom est obligatoire et doit faire entre 4 et 30 caractères
            </div>
        </div>
            </div>
    </div>
        <!-- mail -->  
    <div class="col-md-4 mb-3" >   
        <div class="form-group row ">
            <label for="exampleInputEmail1">Adresse éléctronique</label>
            <input type="email" class="form-control" name="Email1" oninput="saisiEmail(this)" value = "<?php echo $user->getMail(); ?>"aria-describedby="emailHelp" placeholder="Enter email" id="mail">
            <small id="emailHelp" class="form-text text-muted">Nous ne partegons votre mail.</small>
            <div class="valid-feedback">
                Mail Ok !
            </div>
            <div class="invalid-feedback">
                Le champ mail est obligatoire 
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Envoyez</button>       
</form>

    <script>
        // verification du nom 
        function saisieTexteNom(input) {
            var nomInput = input;
            var isValidFormat = /^[a-zA-Z]+$/.test(nomInput.value);
            var isValidLength = nomInput.value.length >= 4 && nomInput.value.length <= 30;

            nomInput.classList.toggle('is-valid', isValidFormat && isValidLength);
            nomInput.classList.toggle('is-invalid', !isValidFormat || !isValidLength);
        }
        // verification du prenom 
        function saisieTextePrenom(input) {
            var prenomInput = input;
            var isValidFormat = /^[a-zA-Z]+$/.test(prenomInput.value);
            var isValidLength = prenomInput.value.length >= 4 && prenomInput.value.length <= 30;

            prenomInput.classList.toggle('is-valid', isValidFormat && isValidLength);
            prenomInput.classList.toggle('is-invalid', !isValidFormat || !isValidLength);
        }
        // verification du mail 
        function saisiEmail(input) {
        var mailInput = input;
        var isValidEmail = mailInput.value.includes("@");

        if (isValidEmail) {
            mailInput.classList.remove('is-invalid');
            mailInput.classList.add('is-valid');
        } else {
            mailInput.classList.remove('is-valid');
            mailInput.classList.add('is-invalid');
        }
        };
        // verification mot de passe num 1
        document.getElementById('Password1').addEventListener('input', function () {
        var password1Input = this;
        var isValidPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(password1Input.value);

        password1Input.classList.toggle('is-valid', isValidPassword);
        password1Input.classList.toggle('is-invalid', !isValidPassword);

        // Appel à une fonction pour gérer la vérification de l'égalité mot de passe
        checkPasswordsEquality();
        });

        document.getElementById('Password2').addEventListener('input', function () {
            var password2Input = this;
            checkPasswordsEquality();
        });
        //  vérification de l'égalité mot de passe 
        function checkPasswordsEquality() {
            var password1Input = document.getElementById('Password1');
            var password2Input = document.getElementById('Password2');

            // Vérification d'égalité
            var passwordsMatch = (password1Input.value === password2Input.value);

            password1Input.classList.toggle('is-valid', passwordsMatch);
            password1Input.classList.toggle('is-invalid', !passwordsMatch);

            password2Input.classList.toggle('is-valid', passwordsMatch);
            password2Input.classList.toggle('is-invalid', !passwordsMatch);
        }

        // validation du formulaire en fonction des boutons photographe ou client 
        function handleToggle(action) {
            var photographeBtn = document.getElementById('photographeBtn');
            var clientBtn = document.getElementById('clientBtn');

            // Ajouter/retirer la classe 'active' en fonction de l'appui sur le bouton
            if (action === 'photographe') {
                photographeBtn.classList.add('active');
                clientBtn.classList.remove('active');
                document.getElementById('choixTypeInput').value = 'photographe';
            } else if (action === 'client') {
                clientBtn.classList.add('active');
                photographeBtn.classList.remove('active');
                document.getElementById('choixTypeInput').value = 'client';
            }
        }
        // fonction rechargement affichage photographe (siret et siteweb)
        document.addEventListener("DOMContentLoaded", function () {
                // Définissez la sélection par défaut sur 'Photographe'
                document.getElementById('photographe').checked = true;

                // Affiche 'blockPhotographe' et masque 'blockClient' lors du chargement de la page
                document.getElementById('blockPhotographe').style.visibility = "visible";
                document.getElementById('blockClient').style.visibility = "hidden";
        });
        
    </script>
        <?php

            // vérifier les informations du formulaire saisie 

            if (isset($_POST['prenom']) && isset($_POST['nom']) && 
                isset($_POST["Email1"]) && isset($_POST["Password1"])&&
                isset($_POST["Password2"]) && isset($_POST["choixType"])){
                // connection à la base de données 
                include_once("connexion_bd.php");
                // Ajoutez des var_dump pour déboguer
                //echo var_dump($_POST);
                include_once('classes/User.class.php');
                include_once('classes/UserManager.class.php');

                $manager = new UserManager($db);

                $emailExists = $manager->emailExists($_POST['Email1']);
                // verification mail existe
                if ($emailExists) {
                    echo "Cet e-mail est déjà associé à un compte. Veuillez choisir un autre e-mail.Ou vous connectez !";
                } else {
                
                $user = new User([
                    'Nom' => $_POST['nom'],
                    'Prenom' => $_POST['prenom'] ,
                    'Type' => $_POST['choixType'], 
                    'Mail' => $_POST['Email1'], 
                    'Mdp' => $_POST['Password1']
                    ]);
                // ajouter user
                $manager->add($user);
                echo "<p>Bienvenue chez nous !<p>";
                }
            } 


        ?>
        <?php  include('include/footer_inc.php');?>

    
</body>
</html>
 