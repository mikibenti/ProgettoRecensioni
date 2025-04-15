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
    $row = $result->fetch_assoc();
    $nome = $row["nome"];
    $cognome = $row["cognome"];
    $email = $row["email"];
    $id = $row["id"];
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
                        <li><strong>Nome:</strong> <?php echo $nome ?></li>           
                        <li><strong>Cognome:</strong> <?php echo $cognome ?></li>       
                        <li><strong>Email:</strong> <?php echo $email ?></li>
                        <li><strong>Numero recensioni effetuate:</strong>
                            <?php
                                $sql = "SELECT COUNT(*) as conto FROM `recensione` WHERE idutente = $id;";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $conto = $row["conto"];
                                echo $conto;
                            ?>
                        </li>
                </ul>
                <!-- trigger button modal "logout" -->
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#insertModal">Nuova Recensione</button>
                <!-- modal -->
                <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <!-- insert title here-->
                        <h1 class="modal-title fs-5" id="insertModalLabel">Inserisci i Dati</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- insert message here -->
                    <div class="modal-body">
                        <label for="form-select">Voto</label>
                        <select class="form-select">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        <label for="form-select">Ristorante</label>
                        <select class="form-select">
                            <?php
                                $sql = "SELECT nome FROM `ristorante`";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value=".$row["nome"].">".$row["nome"]."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annulla</button>
                        <a href="inseriscirecensione.php" class="btn btn-primary">Conferma</a>                    </div>
                    </div>
                </div>
            </div>
                <?php
                    if($conto == 0) {
                        echo "<p style=color:red>Nessuna recensione effetuata</p>";
                    } else {
                        $sql = "SELECT ris.nome, ris.indirizzo, rec.voto, rec.data FROM `recensione` rec JOIN ristorante ris ON rec.codiceristorante = ris.codice JOIN utente u ON rec.idutente = u.id WHERE u.id = $id;";
                        $result = $conn->query($sql);
                        echo "<table class='table table-bordered border-primary'>
                            <thead>
                                <tr>
                                    <th scope='col'>Nome Ristorante</th>
                                    <th scope='col'>Indirizzo</th>
                                    <th scope='col'>Voto</th>
                                    <th scope='col'>Data</th>
                                </tr>
                            </thead>
                            <tbody>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["nome"] . "</td>";
                                echo "<td>" . $row["indirizzo"] . "</td>";
                                echo "<td>" . $row["voto"] . "</td>";
                                echo "<td>" . $row["data"] . "</td>";
                                echo "</tr>";
                            }
                        echo "</tbody></table>";
                    }
                ?>
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