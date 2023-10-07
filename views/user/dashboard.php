<?php
session_start();

// Enable error reporting and display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// database connection
include '../../config/database.php';
include '../../models/user/UserEvent.php';
include '../../controllers/user/UserEventController.php';

// check if user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

    // Pass the database connection to EventController
    $eventController = new UserEventController($conn);

    // Get all events of the user logged in
    $events = $eventController->getAllUserEvents();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- font icon -->
        <link rel="icon" href="../assets/images/logo.svg" type="image/svg" />
        <!-- title -->
        <title>Dashboard</title>
        <!-- css -->
        <link rel="stylesheet" href="../../assets/styles/style.css">
        <!-- font family Roboto -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>

    <body>
        <!-- header -->
        <header>
            <img src="../../assets/images/logo.svg" alt="logo">
        </header>

        <!-- main -->
        <main>
            <!-- svg -->
            <div class="wave-container">
                <svg id="wave1" class="wave">
                    <image xlink:href="../../assets/images/main/wave-1.svg" width="100%" length="auto" />
                </svg>
                <svg id="wave2" class="wave">
                    <image xlink:href="../../assets/images/main/wave-2.svg" width="100%" length="auto" />
                </svg>
                <svg id="wave3" class="wave">
                    <image xlink:href="../../assets/images/main/wave-3.svg" width="100%" length="auto" />
                </svg>
            </div>

            <!-- main content -->
            <div class="content">
                <h2>Ciao <?php echo  $_SESSION['name'] . " " . $_SESSION['surname'] ?> ecco i tuoi eventi</h2>

                <!-- show all events of the user logged in -->
                <?php if (!empty($events)) : ?>
                    <div class="events-container">
                        <?php foreach ($events as $event) : ?>
                            <div class="event">
                                <h3><?php echo $event->event_name; ?></h3>
                                <p><?php echo $event->description; ?></p>
                                <p><?php echo $event->event_date; ?></p>
                                <button class="btn">Join</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p>Non hai ancora creato eventi</p>
                <?php endif; ?>

                <!-- logout -->
                <button class="btn"><a href="../../controllers/LogoutController.php">Logout</a></button>
            </div>
        </main>
    </body>

    </html>

<?php
} else {
    header("Location: ../../public/index.php");
    exit();
}
?>