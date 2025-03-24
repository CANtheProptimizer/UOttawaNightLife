//ajax

document.addEventListener('DOMContentLoaded', function() {
    // Select all review forms on the page
    const reviewForms = document.querySelectorAll('.reviewForm');
    
    reviewForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Stop the form from submitting normally
            const formData = new FormData(form);
            const eventId = formData.get('event_id');

            // Send the review data using fetch to the PHP endpoint
            fetch('ajax_submit_review.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Find the reviews container for this event
                const reviewsContainer = document.getElementById('reviews_' + eventId);
                if (reviewsContainer) {
                    
                    if (reviewsContainer.textContent.includes("No reviews yet")) {
                        reviewsContainer.innerHTML = "<h4>Reviews:</h4>";
                    }
                    
                    reviewsContainer.innerHTML += data;
                }
                // Optionally reset the form after submission
                form.reset();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error submitting review.');
            });
        });
    });
});


//create event
document.addEventListener('DOMContentLoaded', function () {
    // Get the Create Event form
    const createEventForm = document.getElementById('createEventForm');
    if (createEventForm) {
        // When the form is submitted, perform validation
        createEventForm.addEventListener('submit', function (e) {
            const eventName = document.getElementById('event_name').value.trim();
            const eventDate = document.getElementById('event_date').value;
            const description = document.getElementById('description').value.trim();
            const location = document.getElementById('location').value.trim();

            // Check that the event name is at least 3 characters long
            if (eventName.length < 3) {
                alert("Event name must be at least 3 characters long.");
                e.preventDefault();
                return;
            }
            // Check that the event date is not in the past
            const today = new Date().toISOString().split('T')[0];
            if (eventDate < today) {
                alert("Event date cannot be in the past.");
                e.preventDefault();
                return;
            }
            // Check that the description is at least 10 characters long
            if (description.length < 10) {
                alert("Description must be at least 10 characters long.");
                e.preventDefault();
                return;
            }
            // Check that the location is not empty
            if (location.length === 0) {
                alert("Please enter a location.");
                e.preventDefault();
                return;
            }
        });

        // Add a real-time character counter for the event description
        const descriptionField = document.getElementById('description');
        const charCounter = document.getElementById('charCounter');
        if (descriptionField && charCounter) {
            descriptionField.addEventListener('input', function () {
                charCounter.textContent = descriptionField.value.length + " characters";
            });
        }
    }
});
