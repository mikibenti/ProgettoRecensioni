<?php
session_start();
include("connessione.php");

if(!isset($_SESSION["logged"]) || $_SESSION["logged"] == false) {
    $_SESSION["errMessage"] = "Sessione scaduta o non valida";
    header('Location: index.php');
    exit;
}

$codice_ristorante = $_POST['ristorante'];
$sql_ristorante = "SELECT * FROM ristorante WHERE codice = '$codice_ristorante'";
$result_ristorante = $conn->query($sql_ristorante);
$ristorante = $result_ristorante->fetch_assoc();

$sql_recensioni = "SELECT voto, data, idutente FROM recensione WHERE codiceristorante = '$codice_ristorante' ORDER BY data DESC";
$result_recensioni = $conn->query($sql_recensioni);
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Ristorante</title>
    <link rel="icon" type="image/x-icon" href="siteLogo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styleHome.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-utensils me-2"></i><?php echo $ristorante['nome']; ?></h4>
                    <a href="benvenuto.php" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Torna indietro
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-2"><strong><i class="fas fa-map-marker-alt me-2"></i>Indirizzo:</strong> <?php echo $ristorante['indirizzo']; ?></p>
                        <p><strong><i class="fas fa-city me-2"></i>Città:</strong> <?php echo $ristorante['citta']; ?></p>
                        <p><strong><i class="fas fa-map-pin me-2"></i>Posizione:</strong> 
                        Lat: <?php echo $ristorante['latitudine']; ?>, 
                        Lng: <?php echo $ristorante['longitudine']; ?>
                        </p>
                    </div>
                    <div id="map" style="height: 450px; width: 100%; border: 1px solid #ccc; border-radius: 8px;"></div>
                </div>
                <h5 class="border-bottom pb-2 mb-3"><i class="fas fa-star me-2"></i>Recensioni</h5>
                <?php 
                if($result_recensioni->num_rows == 0) {
                    echo '<div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Nessuna recensione presente per questo ristorante
                    </div>';
                } else {
                    echo '<div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Voto</th>
                                    <th>Data</th>
                                    <th>ID Utente</th>
                                </tr>
                            </thead>
                            <tbody>';
                    while($recensione = $result_recensioni->fetch_assoc()) {
                        echo '<tr>
                            <td>';
                        for($i = 1; $i <= 5; $i++) {
                            echo ($i <= $recensione['voto']) ? 
                                '<i class="fas fa-star text-warning"></i>' : 
                                '<i class="far fa-star text-warning"></i>';
                        }
                        echo '</td>
                            <td>' . date('d/m/Y', strtotime($recensione['data'])) . '</td>
                            <td>' . $recensione['idutente'] . '</td>
                        </tr>';
                    }

                }?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const lat = <?php echo $ristorante['latitudine']; ?>;
        const lng = <?php echo $ristorante['longitudine']; ?>;

        const map = L.map('map').setView([lat, lng], 20);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup('<?php echo addslashes($ristorante['nome']); ?>')
            .openPopup();
    });
</script>
</body>
</html>