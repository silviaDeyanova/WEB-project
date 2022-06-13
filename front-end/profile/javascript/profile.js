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
