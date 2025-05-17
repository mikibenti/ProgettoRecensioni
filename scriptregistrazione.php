<?php
    session_start();
    include("connessione.php");
    $_SESSION["admin"] = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nome = $_POST['name'];
    $cognome = $_POST['surname'];
    $sql = "SELECT * FROM utente WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        $_SESSION["errMessage"] = "Username già registrato";
        header('Location: paginaregistrazione.php');
    } else {
        $sql = "SELECT * FROM utente WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows != 0) {
            $_SESSION["errMessage"] = "Email già registrata";
            header('Location: paginaregistrazione.php');
        } else {
            $password = hash("sha256",$password);
            $sql = "INSERT INTO utente (username, password, nome, cognome, email) VALUES ('$username', '$password', '$nome', '$cognome', '$email')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION["loggedUser"] = $username;
                $_SESSION["logged"] = true;
                header('Location: benvenuto.php');
            } else {
                $_SESSION["errMessage"] = "Errore nella registrazione";
                header('Location: paginaregistrazione.php');
            }
        }
    }
?>