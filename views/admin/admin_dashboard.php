<?php
session_start();

// Enable error reporting and display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// database connection
include '../../config/database.php';
include '../../controllers/admin/AdminEventController.php';
include '../../models/admin/AdminEvent.php';

// check if user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

    // Pass the database connection to adminEventController
    $eventController = new AdminEventController($conn);

    // Get all events of the user logged in
    $events = $eventController->getAllEvents();

    // add new event 
    if (isset($_POST['addEvent'])) {
        // get the data from the form
        $event_name = $_POST['event_name'];
        $attendees = $_POST['attendees'];
        $description = $_POST['description'];
        $event_date = $_POST['event_date'];

        // add the event
        $eventController->addEvent($event_name, $attendees, $description, $event_date);
    }

    // delete event
    if (isset($_POST['deleteEvent'])) {
        // get the id of the event
        $id = $_POST['id'];

        // delete the event
        $eventController->deleteEvent($id);
    }

    // edit event 
    if (isset($_POST['editEvent'])) {
        // get the id of the event
        $id = $_POST['id'];

        // edit the event
        $eventController->editEvent($id);
    }

    // update the event
    if (isset($_POST['updateEvent'])) {
        $id = $_POST['id'];
        $event_name = $_POST['event_name'];
        $attendees = $_POST['attendees'];
        $description = $_POST['description'];
        $event_date = $_POST['event_date'];

        // update the event
        $eventController->updateEvent($id, $event_name, $attendees, $description, $event_date);
    }

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
            <!-- svg waves at the bottom -->
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

            <!-- svg Rocket at the bottom over the waves -->
            <div class="bottom-svg">
                <svg class="bottom-svg">
                    <image xlink:href="../../assets/images/main/rocket.svg" width="100%" length="auto" />
                </svg>
            </div>

            <!-- svg elippse at the top right corner -->
            <div class="top-right-svg">
                <svg class="bottom-svg">
                    <image xlink:href="../../assets/images/main/elipsse.svg" width="100%" length="auto" />
                </svg>
            </div>

            <!-- main content -->
            <div class="content">
                <h1>Admin Dashboard</h1>
                <h2>Ciao <?php echo  $_SESSION['name'] . " " . $_SESSION['surname'] ?> ecco tutti gli eventi</h2>

                <!-- success message -->
                <?php if (isset($_GET['success'])) : ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php endif; ?>

                <!-- error -->
                <?php if (isset($_GET['error'])) : ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php endif; ?>

                <!-- show all events of the user logged in -->
                <?php if (!empty($events)) : ?>
                    <div class="events-container">
                        <!-- all events -->
                        <?php foreach ($events as $event) : ?>
                            <!-- card event -->
                            <div class="event">
                                <h3><?php echo $event->event_name; ?></h3>
                                <p><?php echo $event->description; ?></p>
                                <p><?php echo $event->event_date; ?></p>
                                <button class="btn">Join</button>

                                <!-- button container delete e edit-->
                                <div class="button-container-event">
                                    <!-- delete button -->
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $event->id; ?>">
                                        <button class="btn-delete" type="submit" name="deleteEvent">Elimina</button>
                                    </form>

                                    <!-- edit button -->
                                    <button class="btn" type="button" name="editEvent" onclick="showEditForm(<?php echo $event->id; ?>)">Modifica</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <h3>Non hai ancora creato eventi</h3>
                <?php endif; ?>

                <!-- button container add event and logout-->
                <div class="button-container">
                    <!-- button to show the form -->
                    <button class="btn" id="add-event-btn">Aggiungi evento</button>
                    <!-- logout -->
                    <button class="btn"><a href="../../controllers/LogoutController.php">Logout</a></button>
                </div>

                <!-- add new event form -->
                <form class="form-container" action="" method="POST" id="add-event-form" style="display: none;">
                    <h3>Aggiungi un nuovo evento</h3>

                    <!-- error message -->
                    <?php if (isset($_GET['error'])) : ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php endif; ?>

                    <!-- form data -->
                    <div class="form">
                        <!-- event name -->
                        <div class="form-data">
                            <label for="event_name">Nome evento</label>
                            <input type="text" name="event_name" id="event_name" placeholder="Nome evento">
                            <hr>
                        </div>

                        <!-- attendees -->
                        <div class="form-data">
                            <label for="attendees">Partecipanti</label>
                            <input type="text" name="attendees" id="attendees" placeholder="Partecipanti">
                            <hr>
                        </div>

                        <!-- description -->
                        <div class="form-data">
                            <label for="description">Descrizione</label>
                            <input type="text" name="description" id="description" placeholder="Descrizione">
                            <hr>
                        </div>
                        <!-- event date -->
                        <div class="form-data">
                            <label for="event_date">Data evento</label>
                            <input type="datetime-local" name="event_date" id="event_date" placeholder="Data evento">
                            <hr>
                        </div>

                        <!-- button -->
                        <button class="btn" type="submit" name="addEvent" id="addEventButton">Aggiungi evento</button>
                    </div>
                </form>
                <!------------------>
                <?php foreach ($events as $event) : ?>
                    <!-- edit form -->
                    <form class="form-container edit-event-form" action="" method="POST" id="edit-event-form-<?php echo $event->id; ?>" style="display: none;">

                        <!-- hidden id -->
                        <input type="hidden" name="id" value="<?php echo $event->id; ?>">

                        <h3>Modifica evento</h3>

                        <!-- error message -->
                        <?php if (isset($_GET['error'])) : ?>
                            <p class="error"><?php echo $_GET['error']; ?></p>
                        <?php endif; ?>

                        <!-- form data -->
                        <div class="form">
                            <!-- event name -->
                            <div class="form-data">
                                <label for="event_name">Nome evento</label>
                                <input type="text" name="event_name" id="event_name" placeholder="Nome evento" value="<?php echo $event->event_name; ?>">
                                <hr>
                            </div>

                            <!-- attendees -->
                            <div class="form-data">
                                <label for="attendees">Partecipanti</label>
                                <input type="text" name="attendees" id="attendees" placeholder="Partecipanti" value="<?php echo $event->attendees; ?>">
                                <hr>
                            </div>

                            <!-- description -->
                            <div class="form-data">
                                <label for="description">Descrizione</label>
                                <input type="text" name="description" id="description" placeholder="Descrizione" value="<?php echo $event->description; ?>">
                                <hr>
                            </div>

                            <!-- event date -->
                            <div class="form-data">
                                <label for="event_date">Data evento</label>
                                <input type="datetime-local" name="event_date" id="event_date" placeholder="Data evento" value="<?php echo $event->event_date; ?>">
                                <hr>
                            </div>

                            <!-- button -->
                            <button class="btn" type="submit" name="updateEvent" id="updateEvent">Modifica evento</button>
                        </div>
                    </form>
                <?php endforeach; ?>
                <!------------------>
            </div>
        </main>

        <!-- js scritp -->
        <script src="../../assets/js/admin_dasboard.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: ../../public/index.php");
    exit();
}
?>