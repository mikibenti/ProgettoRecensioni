<?php
    session_start();
    include("connessione.php");
    $sql = "SELECT COUNT(*) as conto FROM `ristorante` WHERE 1";
    $result = $conn->query($sql);
        if ($result === false) {
            $_SESSION["errMessage"] = 'Errore' . $conn->error;
            header("Location: pannelloadmin.php");
        }
        $row = $result->fetch_assoc();
        $conto = $row["conto"] + 1;
        $nome = $_POST["nome"];
        $indirizzo = $_POST["indirizzo"];
        $citta = $_POST["citta"];
        $query = "INSERT INTO ristorante (codice, nome, indirizzo, citta) 
            VALUES ('ris$conto', '$nome', '$indirizzo', '$citta')";
        if ($conn->query($query) === TRUE) {
            $_SESSION["errMessage"] = 'Ristorante inserito con successo';
        } else {
            $_SESSION["errMessage"] = 'Errore inserimento ristorante: ' . $conn->error;
        }
        header("Location: pannelloadmin.php");
?>