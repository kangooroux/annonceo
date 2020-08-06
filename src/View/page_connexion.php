<?php

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title;?></title>
</head>
<body>
    <form action="index.php" method="post">
        <label for="login">Pseudo : </label>
        <input type="text" id="login" name="login">
        <hr>
        <label for="password">Password : </label>
        <input type="text" id="password" name="password">
        <hr>
        <input type="submit" value="Send">
    </form>
</body>
</html>
