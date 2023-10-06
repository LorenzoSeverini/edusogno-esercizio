<?php if ($result->num_rows > 0) : ?>
    <div class="events-container">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="event">
                <h3><?php echo $row["event_name"]; ?></h3>
                <p><?php echo $row["event_date"]; ?></p>
                <button class="btn">Join</button>
            </div>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <!-- no events, message -->
    <div class="no-events">No events found</div>
<?php endif; ?>

<!-- SELECT event_name, event_date FROM events WHERE attendees LIKE '%ulysses200915@varen8.com%'; -->


// add event
public function addEvent($event_name, $attendees, $event_date)
{
// SQL query to insert a new event into the database
$sql = "INSERT INTO events (event_name, attendees, event_date) VALUES (?, ?, ?)";
$stmt = $this->conn->prepare($sql);
$stmt->bind_param("sss", $event_name, $attendees, $event_date);

if ($stmt->execute()) {
return true; // Event added successfully
} else {
return false; // Error occurred
}
}