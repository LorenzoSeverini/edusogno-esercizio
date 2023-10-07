<?php

// AdminEventController.
use Admin\Models\AdminEvent;

// admin event controller
class AdminEventController
{
    private $conn;  // define the $conn property

    // constructor 
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // --------------------------------------
    // GET ALL EVENTS WITH ADMIN ACCESS = 1
    // --------------------------------------
    public function getAllEvents()
    {
        // Prepare the SQL query with a placeholder for admin_access
        $sql = "SELECT * FROM events WHERE admin_access = ?";

        // Prepare the statement
        $stmt = $this->conn->prepare($sql);

        // Bind the admin_access parameter to the prepared statement
        $adminAccess = 1;
        $stmt->bind_param("i", $adminAccess);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are events
        if ($result->num_rows > 0) {
            // Create an array to store events
            $events = array();

            // Store events in the array
            while ($row = $result->fetch_assoc()) {
                $events[] = new AdminEvent($row['id'], $row['event_name'], $row['attendees'], $row['description'], $row['event_date'],);
            }

            // Return the array
            return $events;
        } else {
            // No events found
            return null;
        }
    }

    // --------------------------------------
    // ADD NEW EVENT
    // --------------------------------------
    public function addEvent($event_name, $attendees, $event_date, $description)
    {
        // Check if all required fields are not empty
        if (empty($event_name) || empty($attendees) || empty($description) || empty($event_date)) {
            // Redirect with an error message if any field is empty
            header("Location: ../../views/admin/admin_dashboard.php?error=Campo Vuoto");
            return false;
        }

        // Insert the new event into the database
        $sql = "INSERT INTO events (event_name, attendees, event_date, description, admin_access) VALUES (?, ?, ?, ?, 1)";

        // Prepare the SQL statement
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            header("Location: ../../views/admin/admin_dashboard.php?error=ErroreDB");
            return false;
        }

        // Bind the parameters and execute the query
        $stmt->bind_param("sss", $event_name, $attendees, $description, $event_date);

        if ($stmt->execute()) {
            // Event added successfully
            // send email to attendees with the event details
            $this->sendEmailToAttendees($event_name, $attendees, $description, $event_date);

            return true;
        } else {
            // Error occurred
            return false;
        }
    }

    // --------------------------------------
    // SEND EMAIL TO ATTENDEES
    // --------------------------------------
    private function sendEmailToAttendees($event_name, $attendees, $description, $event_date)
    {

        // absolut path
        $emailConfigPath = __DIR__ . '/../../config/email.php';

        // Include the email configuration
        $mail = include($emailConfigPath);

        // Split the comma-separated list into an array
        $attendeesArray = explode(',', $attendees);

        // create an email body with a if to check if is add or edit event
        if (isset($_POST['addEvent'])) {
            $subject = "Nuovo evento $event_name";
            $body = <<<END
            <h1>Nuovo Evento</h1>
            <p>Nome dell'evento: $event_name</p>
            <p>Descrizione dell'evento: $description</p>
            <p>Data dell'evento: $event_date</p>
            END;
        } else if (isset($_POST['updateEvent'])) {
            $subject = "Evento Modificato $event_name";
            $body = <<<END
            <h1>Evento Modificato</h1>
            <p>Nome dell'evento: $event_name</p>
            <p>Descrizione dell'evento: $description</p>
            <p>Data dell'evento: $event_date</p>
            END;
        }

        // Loop through the array and send an email to each attendee
        foreach ($attendeesArray as $attendee) {
            // Trim to remove whitespace
            $attendee = trim($attendee);

            if (filter_var($attendee, FILTER_VALIDATE_EMAIL)) {
                // Valid email address
                $mail->addAddress($attendee);
            } else {
                // Invalid email address
                header('Location: ../../views/admin/admin_dashboard.php?error=Email Non Valida');
                exit();
            }

            // Include the email configuration
            $mail->setFrom($mail->Username);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // send email success or error
            try {
                $mail->send();
                if (isset($_POST['addEvent'])) {
                    header('Location: ../../views/admin/admin_dashboard.php?success=Evento Aggiunto');
                    exit();
                } else if (isset($_POST['updateEvent'])) {
                    header('Location: ../../views/admin/admin_dashboard.php?success=Evento Modificato');
                    exit();
                }
            } catch (Exception $e) {
                if (isset($_POST['addEvent'])) {
                    header('Location: ../../views/admin/admin_dashboard.php?error=Errore Email non inviata');
                    exit();
                } else if (isset($_POST['updateEvent'])) {
                    header('Location: ../../views/admin/admin_dashboard.php?error=Errore Email non inviata');
                    exit();
                }
            }
        }
    }

    // --------------------------------------
    // DELETE EVENT
    // --------------------------------------
    public function deleteEvent($id)
    {
        // Prepare the SQL query with a placeholder for the ID
        $sql = "DELETE FROM events WHERE id = ?";

        // Prepare the statement
        $stmt = $this->conn->prepare($sql);

        // Bind the ID parameter to the prepared statement
        $stmt->bind_param("i", $id);

        // Execute the query
        if ($stmt->execute()) {
            // Event deleted
            return true;
        } else {
            // Error
            return false;
        }
    }

    // --------------------------------------
    // EDIT EVENT
    // --------------------------------------
    public function editEvent($id)
    {
        // Prepare the SQL query with a placeholder for the ID
        $sql = "SELECT * FROM events WHERE id = ?";

        // Prepare the statement
        $stmt = $this->conn->prepare($sql);

        // Bind the ID parameter to the prepared statement
        $stmt->bind_param("i", $id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // check if there is an event
        if ($result->num_rows > 0) {
            // create an array to store the event
            $event = array();

            // store the event in the array
            while ($row = $result->fetch_assoc()) {
                $event[] = new AdminEvent($row['id'], $row['event_name'], $row['attendees'], $row['description'], $row['event_date']);
            }

            // return the array
            return $event;
        } else {
            // no event found
            return null;
        }
    }

    // --------------------------------------
    // UPDATE EVENT
    // --------------------------------------
    public function updateEvent($id, $event_name, $attendees, $description, $event_date)
    {
        // Check if all required fields are not empty
        if (empty($event_name) || empty($attendees) || empty($description) || empty($event_date)) {
            // Redirect with an error message if any field is empty
            header("Location: ../../views/admin/admin_dashboard.php?error=Campo Vuoto");
            return false;
        }

        // Update the event in the database
        $sql = "UPDATE events SET event_name = ?, attendees = ?, description = ?, event_date = ? WHERE id = ?";

        // Prepare the SQL statement
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            header("Location: ../../views/admin/admin_dashboard.php?error=ErroreDB");
            return false;
        }

        // Bind the parameters and execute the query
        $stmt->bind_param("sssi", $event_name, $attendees, $event_date, $id);

        if ($stmt->execute()) {
            // Event updated successfully
            // send email to attendees with the event details
            $this->sendEmailToAttendees($event_name, $attendees, $description, $event_date);

            return true;
        } else {
            // Error occurred
            return false;
        }
    }
}
