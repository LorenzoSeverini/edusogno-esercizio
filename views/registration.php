<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
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
            <h2>Crea il tuo account</h2>
            <!-- form -->
            <form action="../controllers/registrationController.php" method="post" class="form-container">

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
                        <label for="name"><b>Inserisci il tuo nome</b></label>
                        <?php if (isset($_GET['name'])) { ?>
                            <input type="text" placeholder="Inserisci il tuo nome" name="name" value="<?php echo $_GET['name'] ?>">
                        <?php } else { ?>
                            <input type="text" placeholder="Inserisci il tuo nome" name="name">
                        <?php } ?>
                        <hr>
                    </div>

                    <div class="form-data">
                        <label for="surname"><b>Inserisci il tuo cognome</b></label>
                        <?php if (isset($_GET['surname'])) { ?>
                            <input type="text" placeholder="Inserisci il tuo cognome" name="surname" value="<?php echo $_GET['surname'] ?>">
                        <?php } else { ?>
                            <input type="text" placeholder="Inserisci il tuo cognome" name="surname">
                        <?php } ?>
                        <hr>
                    </div>

                    <div class="form-data">
                        <label for="email"><b>Inserisci l'email</b></label>
                        <?php if (isset($_GET['email'])) { ?>
                            <input type="text" placeholder="Inserisci Email" name="email" value="<?php echo $_GET['email'] ?>">
                        <?php } else { ?>
                            <input type="text" placeholder="Inserisci Email" name="email">
                        <?php } ?>
                        <hr>
                    </div>

                    <div class="form-data">
                        <label for="passwordInput"><b>Inserisci la password</b></label>
                        <div class="flex-password">
                            <input type="password" placeholder="scrivila qui" class="passwordInput" name="password">

                            <!-- show password -->
                            <div class="show-password">
                                <i class="fas fa-eye custom-icon showPasswordIcon" onclick="togglePasswordVisibility()"></i>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <button type="submit" class="btn">Registrati</button>

                    <div class="form-link">
                        <p>Hai gia un account? <a href="../public/index.php">Accedi</a>.</p>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- js script  -->
    <script src="../assets/js/script.js"></script>
</body>

</html>