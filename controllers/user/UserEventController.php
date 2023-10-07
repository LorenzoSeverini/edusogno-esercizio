<?php

use User\Models\Event;

// eventController
class UserEventController
{
    private $conn; // define the $conn property

    // constructor 
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // show all events of the user logged in
    public function getAllUserEvents()
    {
        // get user email from session
        $userEmail = $_SESSION['email'];

        // SQL query to retrieve user's events 
        $sql = "SELECT event_name, description, event_date FROM events WHERE attendees LIKE '%" . $userEmail . "%'";

        // result
        $result = $this->conn->query($sql);

        // check if there are events
        if ($result->num_rows > 0) {
            // create an array to store events
            $events = array();

            // store events in the array
            while ($row = $result->fetch_assoc()) {
                $events[] = new Event(null, $row['event_name'], null, $row['description'], $row['event_date']);
            }

            // return the array
            return $events;
        } else {
            // no events found
            return null;
        }
    }
}
