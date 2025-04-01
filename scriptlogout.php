<?php
    session_start();
    session_unset();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styleLogout.css">
</head>
<body>
    <div class="container text-center logout-container">
        <div class="alert alert-success shadow-lg" role="alert">
            <h4 class="alert-heading">Logout Effettuato</h4>
            <p>Sei stato disconnesso correttamente.</p>
            <hr>
            <a href="paginalogin.php" class="btn btn-primary mt-2">Torna Indietro</a>
        </div>
    </div>
</body>
</html>