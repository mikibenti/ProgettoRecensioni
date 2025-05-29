<?php
    session_start();
    if($_SESSION["admin"] == true) {
        header('Location: pannelloadmin.php');
    }
    include("connessione.php");
    $username = $_SESSION["loggedUser"];
    if($_SESSION["logged"] != false) {
        $welcomeMessage = "Benvenuto $username";
    } else {
        $_SESSION["errMessage"] = "Sessione Scaduta";
        header('Location: index.php');
    }
    $sql = "SELECT * FROM utente WHERE username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION["username"] = $row["username"];
    $_SESSION["nome"] = $row["nome"];
    $_SESSION["cognome"] = $row["cognome"];
    $_SESSION["email"] = $row["email"];
    $_SESSION["id"] = $row["id"];
    $_SESSION["dataRegistrazione"] = $row["dataRegistrazione"];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="icon" type="image/x-icon" href="siteLogo.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styleHome.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
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
    <div class="container text-center welcome-container">
        <div class="card shadow-lg">
            <div class="card-body">
                <h3 class="card-title text-primary">
                    <?php echo $welcomeMessage; ?>
                </h3>
                <p class="card-text text-muted">Hai effettuato l'accesso con successo.</p>
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-search me-2"></i>Cerca Ristorante</h5>
                    </div>
                    <div class="card-body">
                        <form action="info_ristorante.php" method="post" class="row g-3">
                            <div class="col-md-8 mx-auto">
                                <label for="ristorante" class="form-label">Seleziona un ristorante:</label>
                                <select class="form-select" id="ristorante" name="ristorante" required>
                                    <option value="" selected disabled>Scegli un ristorante </option>
                                    <?php
                                    $sql = "SELECT codice, nome FROM ristorante ORDER BY nome";
                                    $result = $conn->query($sql);
                                    
                                    if($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<option value="'.$row["codice"].'">'.$row["nome"].'</option>';
                                        }
                                    } else {
                                        echo '<option disabled>Nessun ristorante disponibile</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-info text-white">
                                    <i class="fas fa-info-circle me-2"></i>Mostra Dettagli
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#insertModal">
                    <i class="fas fa-plus me-2"></i>Nuova Recensione
                </button>
                <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="insertModalLabel">Inserisci i Dati</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="inseriscirecensione.php" method="POST">
                                    <label for="voto" class="form-label">Voto</label>
                                    <div class="mb-3" id="voto">
                                        <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo "
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='radio' name='voto' id='voto$i' value='$i' required>
                                                    <label class='form-check-label' for='voto$i'>$i</label>
                                                </div>
                                                ";
                                            }
                                        ?>
                                    </div>
                                    <label for="form-select" class="form-label">Ristorante</label>
                                    <select class="form-select mb-3" name="nome_ristorante" id="nome_ristorante">
                                        <?php
                                            $sql = "SELECT nome FROM `ristorante`";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<option value='".$row["nome"]."'>".$row["nome"]."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annulla</button>
                                        <button type="submit" class="btn btn-primary">Conferma</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h4 class="border-bottom pb-2"><i class="fas fa-list me-2"></i>Le Tue Recensioni</h4>
                    <form action="eliminarecensione.php" method="POST" id="recensioniForm">
    <div class="table-responsive">
        <table class="table table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Seleziona</th>
                    <th scope="col">Ristorante</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT rec.idrecensione, ris.nome, ris.indirizzo, rec.voto, rec.data FROM `recensione` rec JOIN ristorante ris ON rec.codiceristorante = ris.codice JOIN utente u ON rec.idutente = u.id WHERE u.id = ".$_SESSION["id"]." ORDER BY rec.data DESC;";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><div class='form-check'><input class='form-check-input recensione-check' type='checkbox' name='recensioni[]' value='".$row["idrecensione"]."' id='recensione_".$row["idrecensione"]."'></div></td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["indirizzo"] . "</td>";
                    echo "<td>";
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $row["voto"]) {
                            echo '<i class="fas fa-star text-warning"></i>';
                        } else {
                            echo '<i class="far fa-star text-warning"></i>';
                        }
                    }
                    echo "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($row["data"])) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</form>
<div class="button-group">
    <button type="submit" form="recensioniForm" class="btn btn-outline-warning" id="eliminaBtn" disabled>
        <i class="fas fa-trash-alt me-2"></i>Elimina
    </button>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fas fa-sign-out-alt me-2"></i>Logout
    </button>
</div>
                <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h1 class="modal-title fs-5" id="logoutModalLabel">Conferma Logout</h1>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Sarai disconnesso e reindirizzato alla pagina di login.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <a href="scriptlogout.php" class="btn btn-danger">Conferma Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php
                if(isset($_SESSION["errMessage"])) {
                    echo "alert('".$_SESSION["errMessage"]."');";
                    unset($_SESSION["errMessage"]);
                }
            ?>
        });
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.recensione-check');
            const eliminaBtn = document.getElementById('eliminaBtn');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedBoxes = document.querySelectorAll('.recensione-check:checked');
                    eliminaBtn.disabled = checkedBoxes.length === 0;
                });
            });
        });
</script>
</body>
</html>