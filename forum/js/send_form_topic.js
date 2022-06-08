(function() {
    const form = document.getElementById("add_topic"); // the registration form
    const inputs = document.querySelectorAll("input"); // the input fields 
    const responseDiv = document.getElementById("response-message"); // contain the error message if the backend returned an error

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // prevent the form from resetting

        // remove styles from last error message
        responseDiv.classList.remove("error");

        // remove last error message
        responseDiv.innerHTML = null;

        // gather all the input information
        let data = {};
        inputs.forEach(input => {
            data[input.name] = input.value;
        })

        sendFormData(data)
        .then((responseMessage) => {
            if (responseMessage["status"] === "ERROR") {
                throw new Error(responseMessage["message"]);
            }
            else {
                window.location.replace("../forum.html"); // redirect user to his newly created account
            }
        })

    })
})();

/* send the inputted data over to the backend and based on the server's response, display an error message or redirect user to his newly created account */
function sendFormData(data) {
    return fetch("../php/add_topic.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    })
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        return data;
    })
}

