async function getProfileInfo() {
  fetch("../../back-end/api/profile/profile.php", {
    method: "POST", //GET?
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error loading profile info.");
      }
      return response;
    })
    .then((data) => {
      const userInfo = data.value;
      addProfileInfo(userInfo);
    })
    .catch((error) => {
      console.error("Error when loading profile info: " + error);
    });
}

function addProfileInfo(userInfo) {
  document.getElementById("username").value = userInfo.username;
  document.getElementById("password").value = userInfo.password;
  document.getElementById("full_name").innerHTML = userInfo.full_name;
  document.getElementById("email").value = userInfo.email;
  document.getElementById("fn").value = userInfo.fn;
  document.getElementById("graduation").value = userInfo.graduation;
  document.getElementById("major").value = userInfo.major;
  document.getElementById("groupN").value = userInfo.groupN;
}

getProfileInfo();

/*//onkeyup event will occur when the user release the key and calls the function assigned to this event
function GetDetail(str) {
  if (str.length == 0) {
    document.getElementById("first_name").value = "";
    document.getElementById("last_name").value = "";
    return;
  } else {
    //Creates a new XMLHttpRequest object
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
    //Defines a function to be called when the readyState property changes
    if (this.readyState == 4 && this.status == 200) {
	  //Typical action to be performed when the document is ready
      var myObj = JSON.parse(this.responseText);
  
      //Returns the response data as a string and store this array in a variable assign the value received to first name input field
      document.getElementById("first_name").value = myObj[0];
                          
      //Assign the value received to last name input field
      document.getElementById("last_name").value = myObj[1];
    }};
				
    // xhttp.open("GET", "filename", true);
    xmlhttp.open("GET", "gfg.php?user_id=" + str, true);
                  
    // Sends the request to the server
    xmlhttp.send();
  }
}*/