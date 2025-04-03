<?php
    session_start();
    include("connessione.php");
    $username = $_SESSION["loggedUser"];
    if($_SESSION["logged"] != false) {
        $welcomeMessage = "Benvenuto $username";
    } else {
        $_SESSION["errMessage"] = "Sessione Scaduta";
        header('Location: paginalogin.php');
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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
                    <!-- print user info -->
                    <?php while($row = $result->fetch_assoc()) { ?>
                        <li><strong>Nome:</strong> <?php echo $row["nome"]; ?></li>           
                        <li><strong>Cognome:</strong> <?php echo $row["cognome"]; ?></li>       
                        <li><strong>Email:</strong> <?php echo $row["email"]; ?></li>
                    <?php } ?>  
                </ul>
                <!-- trigger button modal "logout" -->
                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#logoutModal">Log-Out</button>
                <!-- modal -->
                <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <!-- insert title here-->
                        <h1 class="modal-title fs-5" id="logoutModalLabel">Sei Sicuro?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- insert message here -->
                    <div class="modal-body">
                        Sarai reindirizzato alla pagina principale
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annulla</button>
                        <a href="scriptlogout.php" class="btn btn-primary">Conferma</a>                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>