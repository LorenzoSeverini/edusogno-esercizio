<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h2>Link per reset password</h2>

            <!-- form -->
            <form action="../controllers/password_reset_tokenController.php" method="post" class="form-container">
                <div class="form">
                    <div class="form-data">
                        <label for="email"><b>Inserisci l'email</b></label>
                        <input type="text" placeholder="Inserisci Email" name="email" required>
                        <hr>
                    </div>

                    <button type="submit" class="btn">Invia Link</button>

                    <div class="form-link">
                        <span>Non hai ancora un profilo? <a href="../views/registration.php">Registrati</a></span>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>