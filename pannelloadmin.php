<?php
    session_start();
    include("connessione.php");
    if($_SESSION["admin"] == false) {
        $_SESSION["errMessage"] = "Permessi non validi";
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="siteLogo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styleAdmin.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#">
                                <i class="fas fa-home me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#restaurants-table">
                                <i class="fas fa-utensils me-2"></i>Ristoranti
                            </a>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-danger mt-3 w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Admin Dashboard</h1>
                </div>
                <div class="card shadow mb-4" id="restaurants-table">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-list me-2"></i>Lista Ristoranti</h5>
                    </div>
                    <div class="card-body">
                        <?php
                            $sql = "SELECT r.*, 
                                (SELECT COUNT(*) FROM recensione rec WHERE rec.codiceristorante = r.codice) AS numero_recensioni 
                                FROM ristorante r 
                                ORDER BY CAST(SUBSTRING(r.codice, 4) AS UNSIGNED) ASC";
                            $result = $conn->query($sql);
                            if($result === false) {
                                echo '<div class="alert alert-danger">Errore nel database: ' . $conn->error . '</div>';
                            } elseif($result->num_rows == 0) {
                                echo '<div class="alert alert-info">Nessun Ristorante Presente</div>';
                            } else {
                                echo '<div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">Codice</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Indirizzo</th>
                                                <th scope="col">Città</th>
                                                <th scope="col">Recensioni</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        while($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $row["codice"] . '</td>'; 
                                            echo '<td>' . $row["nome"] . '</td>';
                                            echo '<td>' . $row["indirizzo"] . '</td>';
                                            echo '<td>' . $row["citta"] . '</td>';
                                            echo '<td><span class="badge bg-primary">' . $row["numero_recensioni"] . '</span></td>';
                                            echo '</tr>';
                                        }
                                echo '</tbody></table></div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i>Aggiungi Ristorante</h5>
                    </div>
                    <div class="card-body">
                        <form action="inserisciristorante.php" method="post" class="row g-3">
                            <div class="col-md-4">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>
                            <div class="col-md-4">
                                <label for="indirizzo" class="form-label">Indirizzo</label>
                                <input type="text" class="form-control" name="indirizzo" id="indirizzo" required>
                            </div>
                            <div class="col-md-4">
                                <label for="citta" class="form-label">Città</label>
                                <input type="text" class="form-control" name="citta" id="citta" required>
                            </div>
                            <div class="col-12">
                                <label for="map" class="form-label">Seleziona la posizione sulla mappa</label>
                                <div id="map" style="height: 350px; border: 1px solid #ccc;"></div>
                                <input type="hidden" name="latitudine" id="latitudine" required>
                                <input type="hidden" name="longitudine" id="longitudine" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-2"></i>Salva
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="logoutModalLabel"><i class="fas fa-exclamation-triangle me-2"></i>Conferma Logout</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Sei sicuro di voler effettuare il logout? Sarai reindirizzato alla pagina di login.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Annulla</button>
                    <a href="scriptlogout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php
                if(isset($_SESSION["errMessage"])) {
                    echo "alert('".$_SESSION["errMessage"]."');";
                    unset($_SESSION["errMessage"]);
                }
            ?>
            const defaultLat = 41.8719;
            const defaultLng = 12.5674;
            const map = L.map('map').setView([defaultLat, defaultLng], 6);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            let marker = null;
            map.on('click', function (e) {
                const lat = e.latlng.lat.toFixed(6);
                const lng = e.latlng.lng.toFixed(6);
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker([lat, lng]).addTo(map)
                    .bindPopup("Posizione selezionata: " + lat + ", " + lng)
                    .openPopup();
                document.getElementById('latitudine').value = lat;
                document.getElementById('longitudine').value = lng;
            });
        });
    </script>
</body>
</html>
