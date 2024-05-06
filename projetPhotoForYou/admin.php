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
        include("include/menu_inc.php");
    ?>
    <h1 style="text-align:center">La Gestion Des Utilisateurs</h1>
    <?php
    $userObject = new UserManager($db);
    $idUser = $_SESSION['user_id'];
    $users = $userObject->getUsers();

    if (!empty($users)) {
        echo '<table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID utilisateur</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Type</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Credit</th>
                        <th scope="col">Photo</th>
                    </tr>
                </thead>
                <tbody>';
        //var_dump($usersInfo);// NULL
        foreach ($users as $usersInfo) {
            
            echo "<tr>
                    <td>" . $usersInfo['id'] . "</td>
                    <td>" . $usersInfo['Nom'] . "</td>
                    <td>" . $usersInfo['Prenom'] . "</td>
                    <td>" . $usersInfo['Type'] . "</td>
                    <td>" . $usersInfo['Mail'] . "</td>
                    <td>" . $usersInfo['Credit'] . "</td>
                    <td>" ;
                    if($usersInfo['Type'] == 'photographe'){
                        ?>
                         <a href="admin_show_photo.php?userId=<?php echo $usersInfo['id']; ?>"> voir photos</a>
                        <?php
                    }
                    
                    echo "</td>
                    <td><button class='btn btn-secondary' onclick='deleteUser(" . $usersInfo['id'] . ")'>Supprimer</button></td>
                    <td><button class='btn btn-secondary' onclick='updateUser(" . $usersInfo['id'] . ")' >Modifier</button></td>
                  </tr>";
        }
    
        echo '</tbody>
            </table>';
    } else {
        echo "Aucun devis trouvé.";
    }
    ?>
    <script>
        function deleteUser(id) {
            console.log(id);
            if (confirm("Êtes-vous sûr de vouloir supprimer cette utilisateur ?")) {
                // Envoyer une requête AJAX pour supprimer le devis
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 201) {
                            location.reload();
                        } else {
                            alert('Erreur lors de la suppression du l\'utilisateur !' );
                        }
                    }
                };
                xhr.open('POST', 'delete_utilisateurs.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('UserId=' + id);
            }
        }
        function updateUser(id) {
            console.log(id);
            if (confirm("Êtes-vous sûr de vouloir modifier cette utilisateur ?")) {
                // Envoyer une requête AJAX pour supprimer le devis
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 201) {
                            location.reload();
                        } else {
                            alert('Erreur lors de la modification du l\'utilisateur !' );
                        }
                    }
                };
                xhr.open('POST', 'update_utilisateurs.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('devisId=' + id);
            }
        }
    </script>
</body>
</html>