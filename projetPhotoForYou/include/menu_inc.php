
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include("connexion_bd.php");
include_once("classes/UserManager.class.php");

$userManager = new UserManager($db);
$userType= null;
// vérification de connection
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
  $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
  $userType=isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

}
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">PhotoForYou</a>
    <div class="container-fluid">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
        <?php
        
        if ($userType === "admin"){ ?>
          <a class="nav-link" href="admin.php">Admin</a>
          <?php
        }
        ?>
        </li>  
        <li class="nav-item">
          <a class="nav-link active" href="photo.php">Photo</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Tarifs</a>
          <ul class="dropdown-menu">
          <?php
              
              $userId = null;  
                  // vérification du type user
                  if (($userId !== null)&& ($_SESSION['user_type'] !=null )) {
                    $userType = $_SESSION['user_type'];
                    // Maintenant, vous pouvez chercher Habilisation dans la table menu
                     if ($userType === "client") {
                      echo '<li><a class="dropdown-item" href="acheter.php">Acheter</a></li>';
                    } if ($userType === "photographe") {
                      echo '<li><a class="dropdown-item" href="vendre.php">Vendre</a></li>';
                    } 
                    
                }
                    
              
              ?>
          
            
            <li><a class="dropdown-item" href="pluspopulaires.php">Les plus populaires</a></li>
            <li><a class="dropdown-item" href="nouvautes.php">Les nouveautés</a></li>
          </ul>
        </li>
        <div class="ms-auto">
          <form class="d-flex"  onsubmit="searchCategories(event)">
            <input onchange="searchCategoriesLive()" id="search-input" class="form-control me-3" type="text" placeholder="Chercher">
            <input class="btn btn-primary"  style = "margin-right: 10px"; type="submit" value="Search"/>
          </form>
        </div>
        <?php
        // si il y a une session avoir le bouton déconnection sinon non 
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
          echo '
          <ul class="navbar-nav mr-right">
            <li class="nav-item">
              <a class="nav-link btn btn-outline-dark" " style="background-color: red; margin-right: 100px;"  href="deconnexion.php">Deconnexion</a>
            </li>
        </ul> 
            ';
        } else {
          echo '
           
            <ul class="navbar-nav mr-right">
              <li class="nav-item">
                <a class="nav-link btn btn-outline-dark" href="inscription.php">S\'inscrire</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-dark"  href="identification.php">S\'identifier</a>
              </li>
            </ul>';
        }
        ?>
        
    </div>
  </div>
</nav>
<script>

</script>