<?php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
</head>
<body>
    <form action="index.php" method="post">
        <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo">
        <hr>
        <input type="text" id="password" name="password" placeholder="Votre mot de passe">
        <hr>
        <input type="text" id="lastname" name="lastname" placeholder="Votre nom">
        <hr>
        <input type="text" id="firstname" name="firstname" placeholder="Votre prénom">
        <hr>
        <input type="text" id="email" name="email" placeholder="Votre email">
        <hr>
        <input type="text" id="phone_number" name="phone_number" placeholder="Votre téléphone">
        <hr>
        <select name="sex" id="sex">
            <option value="homme">Homme</option>
            <option value="femme">Femme</option>
            <option value="autre">Autre</option>
        </select>
        <hr>
        <input type="submit" value="Inscription">
    </form>
</body>
</html>
