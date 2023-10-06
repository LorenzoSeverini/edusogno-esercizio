<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
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
    <!-- header -->
    <header>
        <img src="../assets/images/logo.svg" alt="logo">
    </header>
    <!-- main -->
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
        <div class="content" id="content">
            <h2>Hai gia un account?</h2>

            <!-- log in -->
            <form action="../controllers/loginController.php" method="post" class="form-container">

                <!-- errors -->
                <?php if (isset($_GET['error'])) { ?>
                    <h3 class="error"><?php echo $_GET['error'] ?></h3>
                <?php }  ?>

                <!-- success -->
                <?php if (isset($_GET['success'])) { ?>
                    <h3 class="success"><?php echo $_GET['success'] ?></h3>
                <?php }  ?>

                <!-- form -->
                <div class="form">
                    <div class="form-data">
                        <label for="email"><b>Inserisci l'email</b></label>
                        <input type="text" placeholder="Inserisci Email" name="email" autocomplete="email">
                        <hr>
                    </div>

                    <div class="form-data">
                        <label for="password"><b>Inserisci la password</b></label>
                        <div class="flex-password">
                            <input type="password" placeholder="scrivila qui" class="passwordInput" name="password">

                            <!-- show password -->
                            <div class="show-password">
                                <i class="fas fa-eye custom-icon showPasswordIcon" onclick="togglePasswordVisibility()"></i>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <button type="submit" class="btn">Accedi</button>

                    <div class="form-link">
                        <div>Non hai ancora un profilo? <a href="../views/registration.php">Registrati</a></div>
                        <div>Hai dimenticato la password? <a href="../views/forget_password.php">Reset</a></div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script src="../assets/js/script.js"></script>
</body>

</html>