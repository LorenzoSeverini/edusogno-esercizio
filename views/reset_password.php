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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/styles/style.css">
    <!-- font family Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

                <div class="form">
                    <!-- errors -->
                    <?php if (isset($_GET['error'])) { ?>
                        <h3 class="error"><?php echo $_GET['error'] ?></h3>
                    <?php }  ?>

                    <!-- success -->
                    <?php if (isset($_GET['success'])) { ?>
                        <h3 class="success"><?php echo $_GET['success'] ?></h3>
                    <?php }  ?>

                    <!-- hidden token -->
                    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                    <!-- password -->
                    <div class="form-data">
                        <label for="passwordInput"><b>Nuova password</b></label>
                        <div class="flex-password">
                            <input type="password" placeholder="Nuova password" class="passwordInput" name="password">
                            <!-- show password -->
                            <div class="show-password">
                                <i class="fas fa-eye custom-icon showPasswordIcon" onclick="togglePasswordVisibility()"></i>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <!-- password confirm -->
                    <div class="form-data">
                        <label for="passwordInput"><b>Conferma la password</b></label>
                        <div class="flex-password">
                            <input type="password" placeholder="Conferma la password" class="passwordInput" name="password_confirm">
                            <!-- show password -->
                            <div class="show-password">
                                <i class="fas fa-eye custom-icon showPasswordIcon" onclick="togglePasswordVisibility()"></i>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <!-- button -->
                    <button type="submit" class="btn">Reset password</button>

                    <!-- link -->
                    <nav class="form-link">
                        <a href="../public/index.php">Accedi</a>
                        <a href="../views/register.php">Registrati</a>
                    </nav>
                </div>
            </form>
        </div>
    </main>

    <!-- script  -->
    <script src="../assets/js/script.js"></script>
</body>

</html>