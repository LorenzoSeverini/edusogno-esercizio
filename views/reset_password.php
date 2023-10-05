<?php
// connection database
include '../config/database.php';

// parameters generation 
$token = $_GET['token'];

$token_hash = hash('sha256', $token);

// query update
$sql = "SELECT * FROM users WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param('s', $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("Token non valido");
}

if (strtotime($user['reset_token_expires_at']) <= time()) {
    die("Token scaduto");
} else {
    echo "Token valido";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
</head>

<body>
    <!-- iclude header here -->
    <header>
        <img src="../assets/images/logo.svg" alt="logo">
    </header>

    <!-- main content -->
    <main>
        <!-- svg -->
        <div class="wave-container">
            <svg id="wave1" class="wave">
                <image xlink:href="../assets/images/main/wave-1.svg" width="100%" length="auto" />
            </svg>
            <svg id="wave2" class="wave">
                <image xlink:href="../assets/images/main/wave-2.svg" width="100%" length="auto" />
            </svg>
            <svg id="wave3" class="wave">
                <image xlink:href="../assets/images/main/wave-3.svg" width="100%" length="auto" />
            </svg>
        </div>

        <!-- main content -->
        <div class="content">
            <h2>Reset password</h2>

            <!-- form -->
            <form action="../controllers/reset_passwordController.php" method="post" class="form-container">

                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <label for="password">New Password</label>
                <input type="password" id="password" name="password">

                <label for="password_confirm">Confirm Password</label>
                <input type="password" id="password_confirm" name="password_confirm">

                <button type="submit" class="btn">Reset password</button>
            </form>
        </div>
</body>

</html>