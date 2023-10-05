<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <!-- css -->
        <link rel="stylesheet" href="../assets/styles/style.css">
        <!-- font family Roboto -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
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
            <div class="content">
                <h1>dashbaord</h1>
                <h2>Benvenuto <?php echo  $_SESSION['name'] ?></h2>
                <a href="../controllers/logoutController.php" class="btn">Logout</a>
            </div>
        </main>
    </body>

    </html>

<?php
} else {
    header("Location: ../public/index.php");
    exit();
}
?>


<!-- SELECT event_name, event_date FROM events WHERE attendees LIKE '%ulysses200915@varen8.com%'; -->