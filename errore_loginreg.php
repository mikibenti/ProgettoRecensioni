<?php
    session_start();
    $errorMessage = "Errore, " . $_SESSION["errMessage"];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styleError.css">
</head>
<body>
    <div class="container text-center error-container">
        <div class="alert alert-danger shadow-lg" role="alert">
            <h4 class="alert-heading">Errore!</h4>
            <p>
                <?php 
                    echo $errorMessage; 
                ?>
            </p>
            <hr>
            <a href="paginalogin.html" class="btn btn-primary mt-2">Torna Indietro</a>
        </div>
    </div>
</body>
</html>