<?php
    session_start();
    include("connessione.php");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash("sha256",$password);
    $sql = "SELECT * FROM utente WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $passwordDB = $row["password"];
        if ($passwordDB != $password) {
            $_SESSION["errMessage"] = "Password Errata";
            header('Location: errore_loginreg.php');
        } else {
            $_SESSION["loggedUser"] = $username;
            $_SESSION["logged"] = true;
            header('Location: benvenuto.php');
        }
    } else {
        header('Location: errore_loginreg.php');
        $_SESSION["errMessage"] = "Utente Inesistente";
    }
?>