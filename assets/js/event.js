document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("eventForm").addEventListener("submit", function(event) {
       
        event.preventDefault(); // stops page from reloading

        let formData = new FormData(this); // gets data from HTML form

        fetch("../public/process_event.php", { // sends data to the PHP event processor (AJAX component)
            method: "POST",
            body: formData
        })

        .then(response => response.json()) // gets the PHP response in JSON format to parse for errors

        .then(data => {
            let messageDiv = document.getElementById("statusmessage");
            if (data.status === "success") {
                messageDiv.innerHTML = "<p class='success-message'>" + data.message + "</p>";
                document.getElementById("eventForm").reset(); // clears the form after success
            } else {
                messageDiv.innerHTML = "<p class='error-message'>" + data.message + "</p>";
            }
        })

        .catch(error => console.error("Error:", error));

    });
});
