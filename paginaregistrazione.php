<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styleReg.css">
</head>
<body>
    <div class="form-container col-md-6 col-lg-4">
        <h1>Registrati</h1>
        <form action="scriptregistrazione.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Inserisci il tuo nome" required/>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Cognome</label>
                <input type="text" class="form-control" name="surname" id="surname" placeholder="Inserisci il tuo cognome" required/>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Crea un username" required/>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Inserisci la tua email" required/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Crea una password" required/>
            </div>
            <button type="submit" class="btn btn-primary">Registrati</button>
            <a href="./paginalogin.php" class="btn btn-danger mt-3">Torna Indietro</a>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php
                if(isset($_SESSION["errMessage"])) {
                    echo "alert('".$_SESSION["errMessage"]."');";           //funzione per alert con messaggio
                    unset($_SESSION["errMessage"]);
                }
            ?>
        });
    </script>
</body>
</html>