<?php 
include_once("connexion_bd.php");
include_once("./classes/User.class.php");
include_once("./classes/UserManager.class.php");
// verification de donnees du formulaire fictif du bouton javascript 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserId = $_POST['UserId'];
    var_dump($UserId);

    

    //instancier devis
    $userManager = new UserManager($db);
    try {
        $userManager->delete($UserId);
        http_response_code(201); // Indique que la suppression a été effectuée avec succès
        echo "User successfully deleted!";
    } catch (Exception $e) {
       // http_response_code(500); // Indique une erreur interne du serveur
        echo "Error: Unable to delete the user ".$e->getMessage();
    }
} else {
    http_response_code(400); // Indique une mauvaise requête
    echo "Error: Bad request";
}
?>