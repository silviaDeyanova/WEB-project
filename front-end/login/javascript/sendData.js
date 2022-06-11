const registrationBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");
const fields = document.querySelectorAll("input");
const responseMsg = document.getElementById("response");

const toRegister = (event) => {
  event.preventDefault();
  window.location.href = "../register/register.html";
};

const login = (event) => {
  event.preventDefault();

  responseMsg.innerHTML = "";
  responseMsg.classList.remove("error");
  responseMsg.classList.remove("success");

  let data = {};
  let isEmpty = false;
  fields.forEach((field) => {
    data[field.name] = field.value;
    if (field.value === "") {
      isEmpty = true;
    }
  });

  if (!isEmpty) {
    fetch("../../back-end/api/login/login.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((data) => {
        return data;
      })
      .then((data) => {
        if (data["status"] === "error") {
          throw new Error(data["message"]);
        } else {
          responseMsg.innerHTML = "Успешно влязохте!";
          responseMsg.classList.remove("hidden");
          responseMsg.classList.add("success");
          window.location.href = "../profile/profile.html";
        }
      })
      .catch((err) => {
        responseMsg.innerHTML = err;
        responseMsg.classList.remove("hidden");
        responseMsg.classList.add("error");
      });
  } else {
    responseMsg.innerHTML = "Всички полета трябва да бъдат попълнени!";
    responseMsg.classList.remove("hidden");
    responseMsg.classList.add("error");
  }
};

registrationBtn.addEventListener("click", toRegister);
loginBtn.addEventListener("click", login);
