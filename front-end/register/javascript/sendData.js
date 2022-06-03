const btn = document.getElementById("btn");
const responseMsg = document.getElementById("response");
const fields = document.querySelectorAll("input");

const register = (event) => {
  event.preventDefault();

  responseMsg.innerHTML = "";
  responseMsg.classList.remove("error");
  responseMsg.classList.remove("success");

  //   debugger;

  let data = {};
  fields.forEach((field) => {
    data[field.name] = field.value;
  });

  fetch("../../back-end/api/register/register.php", {
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
        responseMsg.innerHTML = "Успешна регистрация!";
        responseMsg.classList.remove("hidden");
        responseMsg.classList.add("success");
      }
    })
    .catch((err) => {
      responseMsg.innerHTML = err;
      responseMsg.classList.remove("hidden");
      responseMsg.classList.add("error");
    });
};

btn.addEventListener("click", register);
