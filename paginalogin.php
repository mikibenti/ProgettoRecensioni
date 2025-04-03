<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recensioni</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styleLog.css">
</head>
<body>
    <div class="container">
        <h1>Recensioni</h1>
        <div class="row justify-content-center">    
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="registrationForm" action="scriptlogin.php" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required/>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
                            </div>
                            <button class="btn btn-primary mt-3">Accedi</button>
                        </form>
                        <p class="mt-3">Non sei registrato? <a href="paginaregistrazione.php">Crea un account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php
                if(isset($_SESSION["errMessage"])) {                    //funzione per alert con messaggio
                    echo "alert('".$_SESSION["errMessage"]."');";
                    unset($_SESSION["errMessage"]);
                }
            ?>
        });
    </script>
</body>
</html>