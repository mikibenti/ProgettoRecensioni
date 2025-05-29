<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrati</title>
    <link rel="icon" type="image/x-icon" href="siteLogo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styleReg.css" />

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
    <div class="main-content">
        <div class="form-container col-md-6 col-lg-4">
            <h1>Registrati</h1>
            <form action="scriptregistrazione.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Inserisci il tuo nome" required />
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Cognome</label>
                    <input type="text" class="form-control" name="surname" id="surname" placeholder="Inserisci il tuo cognome" required />
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Crea un username" required />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Inserisci la tua email" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Crea una password" required />
                </div>
                <button type="submit" class="btn btn-primary">Registrati</button>
                <a href="index.php" class="btn btn-danger mt-3">Torna Indietro</a>
            </form>

            <!-- Esempio di annuncio AdSense in pagina (posiziona dove vuoi) -->
            <div class="my-4 text-center">
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-XXXXXXXXXXXXXX"  
                    data-ad-slot="1234567890"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php
                if(isset($_SESSION["errMessage"])) {
                    echo "alert('".$_SESSION["errMessage"]."');";
                    unset($_SESSION["errMessage"]);
                }
            ?>
        });
    </script>
</body>
</html>
