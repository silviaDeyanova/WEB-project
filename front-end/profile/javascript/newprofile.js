(function() {
    getUserData()
    .then((userData) => {
        if (userData["status"] === "SUCCESS") {
            renderUserData(userData["data"]);
        }
        else if (userData["status"] == "UNAUTHENTICATED") { // if there is no session or cookies, return the user to the login page
            window.location.replace("../login/login.html");
        }
        else {
            throw new Error(userData["message"]);
        }
    })
    .catch((error) => {
        console.log(error); // log the error for now
    })
})()

// send a GET request to the backend in order to recieve the user's data
function getUserData() {
    return fetch("../../back-end/api/profile/profile.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        return data;
    })
}

function renderUserData(data) {
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const fn = document.getElementById("fn");
    const email = document.getElementById("email");
    const graduation = document.getElementById("graduation");
    const major = document.getElementById("major");
    const groupN = document.getElementById("groupN");


    username.innerHTML = username.innerHTML.concat(data["username"]);
    password.innerHTML = password.innerHTML.concat(data["password"]);
    fn.innerHTML = fn.innerHTML.concat(data["fn"]);
    email.innerHTML = email.innerHTML.concat(data["email"]);
    graduation.innerHTML = graduation.innerHTML.concat(data["graduation"]);
    major.innerHTML = major.innerHTML.concat(data["major"]);
    groupN.innerHTML = groupN.innerHTML.concat(data["groupN"]);
}