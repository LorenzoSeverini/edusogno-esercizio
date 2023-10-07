<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font icon -->
    <link rel="icon" href="../assets/images/logo.svg" type="image/svg" />
    <!-- title -->
    <title>Link reset password</title>
    <!-- css -->
    <link rel="stylesheet" href="../assets/styles/style.css">
    <!-- font family Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header  -->
    <header>
        <img src="../assets/images/logo.svg" alt="logo">
    </header>

    <!-- main  -->
    <main>
        <!-- svg waves at the bottom -->
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

        <!-- svg Rocket at the bottom over the waves -->
        <div class="bottom-svg">
            <svg class="bottom-svg">
                <image xlink:href="../assets/images/main/rocket.svg" width="100%" length="auto" />
            </svg>
        </div>

        <!-- svg elippse at the top right corner -->
        <div class="top-right-svg">
            <svg class="bottom-svg">
                <image xlink:href="../assets/images/main/elipsse.svg" width="100%" length="auto" />
            </svg>
        </div>

        <!-- main content -->
        <div class="content">
            <h2>Link per reset password</h2>

            <!-- error  -->
            <?php if (isset($_GET['error'])) { ?>
                <h3 class="error"><?php echo $_GET['error'] ?></h3>
            <?php }  ?>

            <!-- success  -->
            <?php if (isset($_GET['success'])) { ?>
                <h3 class="success"><?php echo $_GET['success'] ?></h3>
            <?php }  ?>

            <!-- form -->
            <form action="../controllers/PasswordResetTokenController.php" method="post" class="form-container">
                <!-- email -->
                <div class="form">
                    <div class="form-data">
                        <label for="email"><b>Inserisci l'email</b></label>
                        <input type="text" placeholder="Inserisci Email" name="email" required>
                        <hr>
                    </div>

                    <!-- button -->
                    <button type="submit" class="btn">Invia Link</button>

                    <!-- link -->
                    <nav class="form-link">
                        <span>Non hai ancora un profilo? <a href="../views/registration.php">Registrati</a></span>
                        <span>Hai già un profilo? <a href="../public/index.php">Accedi</a></span>
                    </nav>
                </div>
            </form>
        </div>
    </main>
</body>

</html>