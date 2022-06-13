function GetInfo(usrname) {
  if (usrname.length != 0) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
	  if (this.readyState == 4 && this.status == 200 && usrname == sessionStorage.getItem("username")) {
        var myObj = JSON.parse(this.responseText);         
        document.getElementById("password").value = myObj[0];
        document.getElementById("full_name").innerHTML = myObj[1];
        document.getElementById("fn").value = myObj[2];
        document.getElementById("email").value = myObj[3];
        document.getElementById("graduation").value = myObj[4];
        document.getElementById("major").value = myObj[5];
        document.getElementById("groupN").value = myObj[6];
      }
    };
  
    xmlhttp.open("GET", "../../back-end/api/profile/profile.php?username=" + usrname, true);
    xmlhttp.send();
  }
}

const submitBtn = document.getElementById('submit-button');

submitBtn.addEventListener('click', (event) => {
  event.preventDefault();

  const password = document.getElementById("password");
  const firstName = document.getElementById("firstName");
  const lastName = document.getElementById("lastName");
  const email = document.getElementById("email");

  if (!validateEmail(email.value)) {
    showError(email, "Невалиден имейл адрес.");
    return;
  }
  if (!validatePassword(password.value)) {
    showError(password, "Невалидна парола.");
    return;
  }
  if (!firstName.value || !lastName.value || !isBetween(firstName.value.length, 1, 50) || !isBetween(lastName.value.length, 1, 50)) {
    showError(firstName, "Невалидно име или фамилия.");
    return;
  }
  showSuccess(password, "Промените са запазени успешно.");
  const formData = {
    password: password.value,
    firstName: firstName.value,
    lastName: lastName.value,
    email: email.value
  };

  updateProfile(formData);
});

async function updateProfile(formData) {
  const data = new FormData();

  fetch('../../backend/endpoints/modifyProfile.php', {
    method: 'PUT',
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(formData),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error('Error updating profile info.');
      }
      return response.json();
    })
    .then((data) => {
      if (data.success === true) {
        console.log("The profile is updated successfully.");
      } else {
        console.log('The profile is NOT updated successfully.');
      }
    })
    .catch(error => {
      const message = 'Error when updating profile.';
      console.log(error);
      console.error(message);
    });
}
