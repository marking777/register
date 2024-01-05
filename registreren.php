<?php
    include 'db.php';

    try {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = new Database();
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $db->registreren($_POST['naam'], $_POST['achternaam'],$_POST['geboortedatum'], $_POST['email'], $hash);
            header("Location:inloggen.php?accountAangemaakt");
        } 
    } catch (\Exception $e) {
        echo "Error: ".$e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="registreren .css">
</head>
<body>
    <h1>Registreren</h1>
    <div class="input">
    <form method="POST">
    
        <input type="text" name="naam" placeholder="Naam" required>
   
        <input type="text" name="achternaam" placeholder="Achternaam" required>

        <input type="date" name="geboortedatum" required>

        <input type="text" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="submit">
    </form>
</div>
</body>
</html>