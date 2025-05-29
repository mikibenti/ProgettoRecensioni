<?php
session_start();
include("connessione.php");

if (isset($_POST["recensioni"]) && is_array($_POST["recensioni"])) {
    $recensioniDaEliminare = $_POST["recensioni"];
    $idUtente = $_SESSION["id"];
    $count = 0;
    for($i = 0; $i<sizeof($recensioniDaEliminare); $i++) {
        $sql = "DELETE FROM recensione WHERE idrecensione = ".$recensioniDaEliminare[$i]." AND idutente = $idUtente";
        $result = $conn->query($sql);
        if($result){
                $_SESSION["errMessage"] = "Eliminazione effettuata";
        } else {
                $_SESSION["errMessage"] = "ERRORE";
        }
    }    
}

    header("Location: benvenuto.php");
?>