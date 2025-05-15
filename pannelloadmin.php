<?php
    session_start();
    include("connessione.php");
    if($_SESSION["admin"] == false) {
        $_SESSION["errMessage"] = "Permessi non validi";
        header('Location: paginalogin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styleHome.css">
</head>
<body>
    <?php
        $sql = "SELECT r.*, (SELECT COUNT(*) FROM recensione rec WHERE rec.codiceristorante = r.codice) AS numero_recensioni FROM ristorante r";
        $result = $conn->query($sql);
        if($result === false) {
            echo "<p style='color:red'>Errore nel database: " . $conn->error . "</p>";
        } elseif($result->num_rows == 0) {
            echo "<p style='color:red'>Nessun Ristorante Presente</p>";
        } else {
            echo "<table class='table table-bordered border-primary'>
                <thead>
                    <tr>
                        <th scope='col'>Codice</th>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Indirizzo</th>
                        <th scope='col'>Città</th>
                        <th scope='col'>Numero di Recensioni</th>
                    </tr>
                </thead>
                <tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["codice"] . "</td>"; 
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["indirizzo"] . "</td>";
                    echo "<td>" . $row["citta"] . "</td>";
                    echo "<td>" . $row["numero_recensioni"] . "</td>";
                    echo "</tr>";
                }
            echo "</tbody></table>";
        }
    ?>
        <form action="inserisciristorante.php" method="post">
            <label for="nome">Nome</label>
                            <div class="mb-3" id="nome">
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required/>
                            </div>
                            <label for="indirizzo">Indirizzo</label>
                            <div class="mb-3" id="indirizzo">
                                <input type="text" class="form-control" name="indirizzo" id="indirizzo" placeholder="Indirizzo" required/>
                            </div>
                            <label for="citta">Città</label>
                            <div class="mb-3" id="citta">
                                <input type="text" class="form-control" name="citta" id="citta" placeholder="Città" required/>
                            </div>
                            <button type="submit">Invia</button>
        </form>
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