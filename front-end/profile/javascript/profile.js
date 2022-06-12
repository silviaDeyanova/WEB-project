(function() {
  return fetch("../../back-end/api/profile/profile.php")
  .then((data) => {
    return data.json();
  })
  .then((data) => {
    if (data["status"] === "error") {
      throw new Error(data["message"]);
    } else {
      addProfileInfo(data["data"]);
    }
  })
  .catch((error) => {
    console.log(error);
  })
})()

function addProfileInfo(userInfo) {
  document.getElementById("username").value = userInfo.username;
  document.getElementById("password").value = userInfo.password;
  document.getElementById("full_name").innerHTML = userInfo.full_name;
  document.getElementById("fn").value = userInfo.fn;
  document.getElementById("email").value = userInfo.email;
  document.getElementById("graduation").value = userInfo.graduation;
  document.getElementById("major").value = userInfo.major;
  document.getElementById("groupN").value = userInfo.groupN;
}
