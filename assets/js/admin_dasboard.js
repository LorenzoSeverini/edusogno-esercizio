// ------------------------------------------------------------
// function to show form to add new event on click of add event button
// ------------------------------------------------------------
const addButton = document.getElementById("add-event-btn");
const eventForm = document.getElementById("add-event-form");

// Add an event listener to the button
addButton.addEventListener("click", function() {
    // Toggle the visibility of the form when the button is clicked
    if (eventForm.style.display === "none") {
        eventForm.style.display = "block";
    } else {
        eventForm.style.display = "none";
    }
});

// ------------------------------------------------------------
// function to show edit form for event on click of edit button
// ------------------------------------------------------------
function showEditForm(eventId) {
    const form = document.getElementById('edit-event-form-' + eventId);
    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}