<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recensioni</title>
    <link rel="icon" type="image/x-icon" href="siteLogo.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styleLog.css">
    <!-- Iubenda Cookie Banner -->
    <script async src="https://cdn.iubenda.com/cs/iubenda_cs.js"></script>
    <script>
        (_iub = self._iub || []).csConfiguration = {
            cookiePolicyId: 96320917,
            siteId: 4045304,
            localConsentDomain: 'mikibenti.altervista.org',
            timeoutLoadConfiguration: 30000,
            lang: 'it',
            enableTcf: true,
            tcfVersion: 2,
            tcfPurposes: {
                "2": "consent_only",
                "3": "consent_only",
                "4": "consent_only",
                "5": "consent_only",
                "6": "consent_only",
                "7": "consent_only",
                "8": "consent_only",
                "9": "consent_only",
                "10": "consent_only"
            },
            invalidateConsentWithoutLog: true,
            googleAdditionalConsentMode: true,
            consentOnContinuedBrowsing: false,
            banner: {
                position: "top",
                acceptButtonDisplay: true,
                customizeButtonDisplay: true,
                closeButtonDisplay: true,
                closeButtonRejects: true,
                fontSizeBody: "14px"
            }
        };
    </script>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <h1>Recensioni</h1>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form id="registrationForm" action="scriptlogin.php" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required />
                                </div>
                                <div class="form-group mt-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
                                </div>
                                <button class="btn btn-primary mt-4" type="submit">Accedi</button>
                            </form>
                            <p class="mt-3">Non sei registrato? <a href="paginaregistrazione.php">Crea un account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container text-center py-3">
            <small>
                &copy; <?php echo date("Y"); ?> Mikibenti. Tutti i diritti riservati.
                &nbsp;|&nbsp;
                <a href="https://www.iubenda.com/privacy-policy/96320917" rel="noreferrer nofollow" target="_blank">Privacy Policy</a>
                &nbsp;-&nbsp;
                <a href="#" role="button" class="iubenda-advertising-preferences-link">Personalizza tracciamento pubblicitario</a>
            </small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Messaggi di errore -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php
                if (isset($_SESSION["errMessage"])) {
                    echo "alert('" . $_SESSION["errMessage"] . "');";
                    unset($_SESSION["errMessage"]);
                }
            ?>
        });
    </script>
</body>
</html>