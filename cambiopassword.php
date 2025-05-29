<?php
session_start();
include("connessione.php");

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] === false) {
    $_SESSION["errMessage"] = "Devi effettuare il login";
    header("Location: index.php");
    exit();
}

if (!isset($_POST["nuova_password"]) || empty(trim($_POST["nuova_password"]))) {
    $_SESSION['esito_password'] = false;
    header("Location: profilo.php");
    exit();
}

$id_utente = $_SESSION["id"];
$nuova_password = trim($_POST["nuova_password"]);
$nuova_password_hash = hash('sha256', $nuova_password);

$sql = "SELECT password FROM utente WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_utente);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    $_SESSION['esito_password'] = false;
    header("Location: profilo.php");
    exit();
}

$row = $result->fetch_assoc();
$password_attuale_hash = $row["password"];

if ($nuova_password_hash === $password_attuale_hash) {
    $_SESSION['esito_password'] = false;
    header("Location: profilo.php");
    exit();
}

$sql_update = "UPDATE utente SET password = ? WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("si", $nuova_password_hash, $id_utente);
$esito = $stmt_update->execute();

$_SESSION['esito_password'] = $esito;

header("Location: profilo.php");
exit();
