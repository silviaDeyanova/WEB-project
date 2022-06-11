const btn = document.getElementById("btn");
const responseMsg = document.getElementById("response");
const fields = document.querySelectorAll("input");

const register = (event) => {
  event.preventDefault();

  responseMsg.innerHTML = "";
  responseMsg.classList.remove("error");
  responseMsg.classList.remove("success");

  let data = {};
  fields.forEach((field) => {
    data[field.name] = field.value;
  });

  fetch("add_topic.php", {
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
        //responseMsg.innerHTML = "Успешна регистрация!";
        responseMsg.classList.remove("hidden");
        responseMsg.classList.add("success");
        window.location.replace("../index.html");
      }
    })
    .catch((err) => {
      responseMsg.innerHTML = err;
      responseMsg.classList.remove("hidden");
      responseMsg.classList.add("error");
    });
};

btn.addEventListener("click", register);






/*
function arePasswordsEqual(password, rePassword) {
    if (password !== rePassword) {
        const errMsgEL = document.getElementById('err-msg');
        errMsgEL.innerText = 'Паролите не съвпадат'; 

        return false;
    }

    return true;
}

function add_topic(userData) {
    fetch('add_topic.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(userData)
    })
    .then(res => {
        if (res.ok) {
            return res.json();
        } else {
            return res.json().then(err => {
                throw new Error(err.message);
            });
        }
    })
    .then(data => {
        const successMsgEL = document.getElementById('response');
        successMsgEL.innerText = `${data.message}. Към `;
        const loginLink = document.createElement('a');
        loginLink.innerText = 'ВХОД';
        loginLink.setAttribute('href', '../index.html');
        successMsgEL.appendChild(loginLink);
    })
    .catch(err => {
        const errMsgEL = document.getElementById('response');
        errMsgEL.innerText = err.message;
    });
}

(() => {

    const registrationForm = document.getElementById('add_topic');

    registrationForm.addEventListener('submit', (event) => {
        const errMsgEL = document.getElementById('response');
        errMsgEL.innerText = null;

        const successMsgEL = document.getElementById('success-msg');
        successMsgEL.innerText = null;

        const topic = document.getElementById('topic').value;
        const topic_info = document.getElementById('topic_info').value;
        //const topic_by = 3;

        if (arePasswordsEqual(password, rePassword)) {
            registration({email, password});
        }
        add_topic({topic, topic_info});
        event.preventDefault();
    });

})();*/