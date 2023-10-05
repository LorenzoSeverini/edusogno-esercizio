<?php
// connection database
include '../config/database.php';
// daate time europe
date_default_timezone_set('Europe/Berlin');

// parameters generation 
$email = $_POST['email'];

$token = bin2hex(random_bytes(16));

$token_hash = hash('sha256', $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

// query creation update
$stmt = $conn->prepare("UPDATE users SET reset_token_hash = ? , reset_token_expires_at = ? WHERE email = ?");

$stmt->bind_param("sss", $token_hash, $expiry, $email);

// query execution
if ($stmt->execute()) {
    echo "Record updated successfully";

    // email
    if ($conn->affected_rows) {
        $mail = require '../config/email.php';

        $mail->setFrom($mail->Username);
        $mail->addAddress($email);
        $mail->Subject = "Reset password";
        $mail->Body = <<<END
            Clicca <a href="http://localhost:8888/edusogno/views/reset_password.php?token=$token">Qui</a> per impostare la nuova password.
        END;

        try {
            $mail->send();
            header('Location: ../views/forget_password.php?success=1');
        } catch (Exception $e) {
            // header('Location: ../views/forget_password.php?error=1');
            echo $e;
        }
    }
} else {
    echo "Error updating record: " . $conn->error;
}

// borf xygn lowi xghr