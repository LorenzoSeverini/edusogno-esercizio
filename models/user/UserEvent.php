<?php
// event
namespace User\Models;

class Event
{
    public $id;
    public $event_name;
    public $attendees;
    public $description;
    public $event_date;

    public function __construct($id, $event_name, $attendees, $description, $event_date)
    {
        $this->id = $id;
        $this->event_name = $event_name;
        $this->attendees = $attendees;
        $this->description = $description;
        $this->event_date = $event_date;
    }
}
