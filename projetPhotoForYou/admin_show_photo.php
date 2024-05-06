<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhotoforYou</title>
</head>
<body>
    
    <?php
        include("connexion_bd.php");
        include("classes/User.class.php");
        include("classes/UserManager.class.php");
        include("classes/Photo.class.php");
        include("classes/PhotoManager.class.php");
        include("include/menu_inc.php");
if(isset($_GET['userId'])){
    $photoManager = new PhotoManager($db);
    $userId = $_GET['userId'];
   $photos = $photoManager-> showUserPhotos($userId);
   if (!empty($photos)) {
    echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">ID photo</th>
                    <th scope="col">Nom de la photo</th>
                    <th scope="col">categorie</th>
                    
                </tr>
            </thead>
            <tbody>';
    //var_dump($usersInfo);// NULL
    foreach ($photos as $photoInfo) {
        //var_dump($photoInfo);die();
        echo "<tr>
                <td>" . $photoInfo['id_photo'] . "</td>
                <td>" ; ?>
                <img width='100px' src="uploads/<?php echo  $photoInfo['nom_photo'];?>">
                
               <?php echo  "</td>
                <td>" . $photoInfo['categorie'] . "</td>
                <td><button class='btn btn-secondary >Supprimer</button></td>
                <td><button class='btn btn-secondary' disabled>Modifier</button></td>
              </tr>";
    }

    echo '</tbody>
        </table>';
} else {
    echo "Aucune photos trouvé.";
}
}
?>
</body>
</html>