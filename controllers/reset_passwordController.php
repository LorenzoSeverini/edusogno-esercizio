<?php
// connect to database
include '../config/database.php';

// token post from form
$token = $_POST['token'];

// token hash
$token_hash = hash('sha256', $token);

// query
$sql = "SELECT * FROM users WHERE reset_token_hash = ? AND reset_token_expires_at > NOW()";

$stmt = $conn->prepare($sql);

$stmt->bind_param('s', $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

// check if token is valid
if ($user === null) {
    header("Location: ../views/forget_password.php?error=Token non valido");
    exit();
}

// check if token is expired
if (strtotime($user['reset_token_expires_at']) <= time()) {
    header("Location: ../views/forget_password.php?error=Token scaduto");
    exit();
}

// password must be a uppercase letter
if (!preg_match('/[A-Z]/', $_POST['password'])) {
    header("Location: ../views/reset_password.php?error=La password deve contenere almeno una lettera maiuscola&token=$token");
    exit();
}

// password must be a number
if (!preg_match('/[0-9]/', $_POST['password'])) {
    header("Location: ../views/reset_password.php?error=La password deve contenere almeno un numero&token=$token");
    exit();
}

// password must be a special character
if (!preg_match('/[^A-Za-z0-9]/', $_POST['password'])) {
    header("Location: ../views/reset_password.php?error=La password deve contenere almeno un carattere speciale&token=$token");
    exit();
}

// check if password and confirm password are the same
if ($_POST['password'] !== $_POST['password_confirm']) {
    header("Location: ../views/reset_password.php?error=Le password non coincidono&token=$token");
    exit();
}

// check if password is valid
if (strlen($_POST['password']) < 8) {
    header("Location: ../views/reset_password.php?error=La password deve essere di almeno 8 caratteri&token=$token");
    exit();
}

// hash password 
$password_hash = md5($_POST['password']);

// query update
$sql = "UPDATE users SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param('ss', $password_hash, $user['id']);

$stmt->execute();

// redirect to login page
header('Location: ../public/index.php?success=Password aggiornata con successo');
exit();
