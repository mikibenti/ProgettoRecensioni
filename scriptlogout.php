<?php
    session_start();
    session_unset();
    $_SESSION["errMessage"] = "Disconnessione effettuata con successo";
    header('Location: paginalogin.php');
?>