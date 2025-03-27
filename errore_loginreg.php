<?php
    session_start();
    $errorMessage = "Errore, " . $_SESSION["errMessage"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container text-center error-container">
        <div class="alert alert-danger shadow-lg" role="alert">
            <h4 class="alert-heading">Errore!</h4>
            <p>
                <?php 
                    echo htmlspecialchars($errorMessage); 
                ?>
            </p><hr>
            <a href="paginalogin.html" class="btn btn-primary mt-2">Torna Indietro</a>
        </div>
    </div>
</body>
</html>
