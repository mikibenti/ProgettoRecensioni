<?php
    session_start();
    include("connessione.php");
    if($_SESSION["logged"] == false) {
        $_SESSION["errMessage"] = "Sessione Scaduta";
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo</title>
    <link rel="icon" type="image/x-icon" href="siteLogo.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styleProf.css">
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="benvenuto.php">
                <img src="logo.png" alt="Logo" width="55" height="32" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="profilo.php">
                            <i class="fas fa-user-circle me-2"></i>Profilo
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="profile-container">
        <div class="profile-header">
            <h1><i class="fas fa-user-circle me-2"></i>Il Tuo Profilo</h1>
        </div>
        
        <ul class="user-info list-unstyled mb-4">
            <li><strong><i class="fas fa-user me-2"></i>Username:</strong> <?php echo htmlspecialchars($_SESSION["username"]) ?></li>
            <li><strong><i class="fas fa-user me-2"></i>Nome:</strong> <?php echo htmlspecialchars($_SESSION["nome"]) ?></li>           
            <li><strong><i class="fas fa-user me-2"></i>Cognome:</strong> <?php echo htmlspecialchars($_SESSION["cognome"]) ?></li>       
            <li><strong><i class="fas fa-envelope me-2"></i>Email:</strong> <?php echo htmlspecialchars($_SESSION["email"]) ?></li> 
            <li><strong><i class="fas fa-star me-2"></i>Recensioni effetuate:</strong>
                <?php
                    $sql = "SELECT COUNT(*) as conto FROM `recensione` WHERE idutente = ".$_SESSION["id"];
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $conto = $row["conto"];
                    echo htmlspecialchars($conto);
                ?>
            </li>
            <li><strong><i class="fas fa-star me-2"></i>Data Registrazione:</strong> <?php echo $_SESSION["dataRegistrazione"] ?></li>
        </ul>
        
        <div class="card mb-4 mx-auto" style="max-width: 400px;">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-key me-2"></i>Cambia Password</h5>
            </div>
            <div class="card-body">
                <form action="cambiopassword.php" method="POST" id="cambiaPwdForm">
                    <div class="mb-3">
                        <label for="nuova_password" class="form-label">Nuova Password</label>
                        <input type="password" class="form-control" id="nuova_password" name="nuova_password" required>
                        <div class="form-text">La password deve essere diversa dalla precendente</div>
                    </div>
                    <button type="submit" class="btn btn-warning text-dark w-100">
                        <i class="fas fa-save me-2"></i>Modifica Password
                    </button>
                </form>
                <?php
                    if (isset($_SESSION['esito_password'])) {
                        if ($_SESSION['esito_password'] === true) {
                            echo '<div class="mt-3 alert alert-success">Password modificata con successo!</div>';
                        } else {
                            echo '<div class="mt-3 alert alert-danger">Impossibile modificare la password</div>';
                        }
                        unset($_SESSION['esito_password']);
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>