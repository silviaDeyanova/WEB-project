const registrationBtn = document.getElementById("register");

const toRegister = (event) => {
  event.preventDefault();
  window.location.href = "../register/register.html";
};

registrationBtn.addEventListener("click", toRegister);
