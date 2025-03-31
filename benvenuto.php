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
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styleHome.css">
</head>
<body>
    <div class="container text-center welcome-container">
        <div class="card shadow-lg">
            <div class="card-body">
                <h3 class="card-title text-primary">
                    <?php echo $welcomeMessage; ?>
                </h3>
                <p class="card-text text-muted">Hai effettuato l'accesso con successo.</p>
                <ul class="user-info">
                    <?php while($row = $result->fetch_assoc()) { ?>
                        <li><strong>Nome:</strong> <?php echo $row["nome"]; ?></li>
                        <li><strong>Cognome:</strong> <?php echo $row["cognome"]; ?></li>
                        <li><strong>Email:</strong> <?php echo $row["email"]; ?></li>
                    <?php } ?>
                </ul>
                <a href="scriptlogout.php" class="btn btn-danger mt-3">Log-Out</a>
            </div>
        </div>
    </div>
</body>
</html>
