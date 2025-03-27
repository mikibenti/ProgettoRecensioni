<?php
    session_start();
    include("connessione.php");
    $username = $_SESSION["loggedUser"];
    if($_SESSION["logged"] != false) {
        $welcomeMessage = "Benvenuto $username";
    } else {
        $_SESSION["errMessage"] = "Sessione Scaduta";
        header('Location: errore_loginreg.php');
    }
    $sql = "SELECT * FROM utente WHERE username = '$username'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        echo "<ul><li>Nome: " . $row["nome"] . "</li><li>Cognome: " . $row["cognome"] . "</li><li>Email: " . $row["email"]. "</li></ul>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container text-center welcome-container">
        <div class="card shadow-lg">
            <div class="card-body">
                <h3 class="card-title text-primary">
                    <?php 
                        echo $welcomeMessage;
                    ?>
                </h3>
                <p class="card-text text-muted">Hai effettuato l'accesso con successo.</p>
                <a href="scriptlogout.php" class="btn btn-danger mt-3">Log-Out</a>
            </div>
        </div>
    </div>
</body>
</html>