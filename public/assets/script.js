//Asynchronous review submission

document.addEventListener('DOMContentLoaded', function() {
    
    const reviewForms = document.querySelectorAll('.reviewForm');
    
    reviewForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            const formData = new FormData(form);
            const eventId = formData.get('event_id');

            
            fetch('ajax_submit_review.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                
                const reviewsContainer = document.getElementById('reviews_' + eventId);
                if (reviewsContainer) {
                    
                    if (reviewsContainer.textContent.includes("No reviews yet")) {
                        reviewsContainer.innerHTML = "<h4>Reviews:</h4>";
                    }
                    
                    reviewsContainer.innerHTML += data;
                }
                
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
            // Check that description is at least 10 characters long
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

        //character counter for the event description
        const descriptionField = document.getElementById('description');
        const charCounter = document.getElementById('charCounter');
        if (descriptionField && charCounter) {
            descriptionField.addEventListener('input', function () {
                charCounter.textContent = descriptionField.value.length + " characters";
            });
        }
    }
});


//homepage (index.php) event sorting

document.addEventListener('DOMContentLoaded', function () {
    
    const sortSelect = document.getElementById('sortOptions');
    const eventListContainer = document.getElementById('eventListContainer');
    
    if (sortSelect && eventListContainer) {
        sortSelect.addEventListener('change', function() {
            const criteria = sortSelect.value;
            const items = Array.from(eventListContainer.querySelectorAll('.eventListItem'));
            
            items.sort(function(a, b) {
                if (criteria === 'title') {
                    
                    return a.getAttribute('data-title').localeCompare(b.getAttribute('data-title'));
                } else if (criteria === 'date') {
                    
                    return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
                } else if (criteria === 'rating') {
                    
                    return parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating'));
                }
            });
            
            
            eventListContainer.innerHTML = '';
            items.forEach(function(item) {
                eventListContainer.appendChild(item);
            });
        });
    }
});
