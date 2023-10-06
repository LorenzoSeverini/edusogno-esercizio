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

    // show all events
    public function getAllEvents()
    {
        // take all events from the database that have admin_access = 1
        $sql = "SELECT * FROM events WHERE admin_access = 1";

        // result
        $result = $this->conn->query($sql);

        // check if there are events
        if ($result->num_rows > 0) {
            // create an array to store events
            $events = array();

            // store events in the array
            while ($row = $result->fetch_assoc()) {
                $events[] = new AdminEvent($row['id'], $row['event_name'], $row['attendees'], $row['event_date']);
            }

            // return the array
            return $events;
        } else {
            // no events found
            return null;
        }
    }
}
