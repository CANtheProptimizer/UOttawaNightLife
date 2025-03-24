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
                    // If the container shows a "No reviews yet" message, replace it with a header
                    if (reviewsContainer.textContent.includes("No reviews yet")) {
                        reviewsContainer.innerHTML = "<h4>Reviews:</h4>";
                    }
                    // Append the new review HTML to the container
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
