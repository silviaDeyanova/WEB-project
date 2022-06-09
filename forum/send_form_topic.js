/*const btn = document.getElementById("btn");
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
*/





const submitPostBtn = document.getElementById('submit');

submitPostBtn.addEventListener('click', (event) => {
    event.preventDefault();

    const topic = document.getElementById('topic').value;
    const topic_info = document.getElementById('topic_info').value;
 

    if (!isBetween(topic, 1, 50) || !isBetween(topic_info, 1, 50) ) {
        showError(section, "Необходимо е да попълните всички полета.");
        return;
    }
    showSuccess(section, "Постът е създаден успешно.");
    const formData = {
        topic: topic,
        topic_info: topic_info
    };

    createPost(formData);
    window.location.reload();
});

async function getPosts() {
    fetch("../../backend/endpoints/getAllPostsEndpoint.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json; charset=utf-8",
            },
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Error loading posts.");
            }
            return response.json();
        })
        .then((data) => {
            posts = data.value;
            appendPosts(posts);
        })
        .catch((error) => {
            console.error("Error when loading posts: " + error);
        });
}

async function getMyPosts() {
    fetch("../../backend/endpoints/myPosts.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json; charset=utf-8",
            },
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Error loading posts.");
            }
            return response.json();
        })
        .then((data) => {
            posts = data.value;
            appendMyPosts(posts);
        })
        .catch((error) => {
            console.error("Error when loading posts: " + error);
        });
}

async function createPost(formData) {
    fetch('createPostEndPoint.php', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json; charset=utf-8",
            },
            body: JSON.stringify(formData),
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error creating post.');
            }
            return response.json();
        })
        .then((data) => {
            if (data.success === true) {
                console.log("The post is added successfully.");
            } else {
                console.log('The post is NOT added successfully.');
            }
        })
        .catch(error => {
            const message = 'Error when creating a post.';
            console.log(error);
            console.error(message);
        });
}

function accept(postId) {
    const formData = {
        postId: postId,
        isAccepted: 1
    };

    answerPost(formData);
}

function decline(postId) {
    const formData = {
        postId: postId,
        isAccepted: 0
    };

    answerPost(formData);
}

async function deletePost(postId) {
    const formData = {
        postId: postId
    };

    fetch("../../backend/endpoints/deletePost.php", {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json; charset=utf-8",
            },
            body: JSON.stringify(formData)
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Error deleting post.");
            }
            return response.json();
        })
        .then((data) => {
            if (data.success === true) {
                console.log("The post is deleted successfully.");
                window.location.reload();
            } else {
                console.log("The post is NOT deleted successfully.");
            }
        })
        .catch((error) => {
            const message = "Error when deleting a post.";
            console.log(error);
            console.error(message);
        });

}

async function answerPost(formData) {
    fetch('../../backend/endpoints/answerPost.php', {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json; charset=utf-8",
            },
            body: JSON.stringify(formData),
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error answering post.');
            }
            return response.json();
        })
        .then((data) => {
            if (data.success === true) {
                console.log("The post is answered successfully.");
                window.location.reload();
            } else {
                console.log('The post is NOT answered successfully.');
            }
        })
        .catch(error => {
            const message = 'Error when answering a post.';
            console.log(error);
            console.error(message);
        });
}


async function getIfUserAccepted(formData) {
    let answer;

    return fetch(`../../backend/endpoints/getIfUserAccepted.php?postId=${formData.postId}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json; charset=utf-8",
                "Accept": "application/json"
            }
            // body: JSON.stringify(formData),
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Error getting if user accepted.");
            }
            // console.log(response.clone().json())
            return response.json();
        })
        .then((data) => {
            if (data.success === true) {
                console.log("Successfully got if user accepted.");
                answer = data.value;
                return answer;
            } else {
                console.log("Error getting if user accepted.");
            }
        })
        .catch((error) => {
            const message = "Error getting if user accepted.";
            console.log(error);
            console.error(message);
        });
}

function showAcceptButton(postId) {
    var buttonAccept = document.createElement("button");
    buttonAccept.innerHTML = "Приемам";
    buttonAccept.setAttribute("id", `accept-button-${postId}`);
    buttonAccept.setAttribute("type", "submit");
    buttonAccept.setAttribute("class", "accept-button");

    var article = document.getElementById(postId);

    buttonAccept.setAttribute("onclick", `accept(${postId})`);
    article.appendChild(buttonAccept);
}

function showDeclineButton(postId, article) {
    var buttonDecline = document.createElement("button");
    buttonDecline.innerHTML = "Отказвам";
    buttonDecline.setAttribute("id", `decline-button-${postId}`);
    buttonDecline.setAttribute("type", "submit");
    buttonDecline.setAttribute("class", "decline-button");

    var article = document.getElementById(postId);

    buttonDecline.setAttribute("onclick", `decline(${postId})`);
    article.appendChild(buttonDecline);
}

function appendPosts(posts) {
    var postSection = document.getElementById('list-of-invitations');

    Object.values(posts).forEach(function(data) {
        const { privacy, speciality, groupUni, faculty, graduationYear, userId, postId, ...res } = data;
        var article = document.createElement("article");
        article.setAttribute("id", data.postId);

        var counter = 1;
        Object.values(res).forEach(function(property) {
            var paragraph = document.createElement("p");
            paragraph.innerHTML = property;
            article.appendChild(paragraph);

            paragraph.setAttribute("class", `prop-${counter++}`);
        });

        postSection.appendChild(article);

        const formData = {
            postId: data.postId,
        };

        const answer = getIfUserAccepted(formData);

        Promise.resolve(answer).then(function(value) {

            if (value.isAccepted == 0) {
                showAcceptButton(data.postId);
            } else if (value.isAccepted == 1) {
                showDeclineButton(data.postId);
            } else {
                showAcceptButton(data.postId);
                showDeclineButton(data.postId);
            }
        });
    });
}

function appendMyPosts(posts) {
    var postSection = document.getElementById('list-of-my-invitations');

    Object.values(posts).forEach(function(data) {
        const { id, speciality, groupUni, faculty, graduationYear, firstName, lastName, userId, postId, ...res } = data;
        var article = document.createElement('article');
        article.setAttribute("id", data.postId);

        var counter = 1;
        Object.values(res).forEach(function(property) {
            var paragraph = document.createElement('p');
            paragraph.innerHTML = property;
            console.log(property);
            article.appendChild(paragraph);

            paragraph.setAttribute('class', `prop-${counter++}`);
        });

        var buttonDelete = document.createElement('button');
        buttonDelete.innerHTML = "Изтрий";

        buttonDelete.setAttribute("id", "delete-button");
        buttonDelete.setAttribute("type", "submit");
        buttonDelete.setAttribute("onclick", `deletePost(${data.postId})`);

        article.appendChild(buttonDelete);
        postSection.appendChild(article);
    });
}

const isEmpty = value => value === '' ? false : true;

const showError = (formField, message) => {
    // get the form-field element
    //const formField = input.parentElement;
    // add the error class
    formField.classList.remove('success');
    formField.classList.add('error');

    // show the error message
    const error = formField.querySelector('small');
    error.textContent = message;
}

const showSuccess = (formField, message) => {
    // get the form-field element
    //const formField = input.parentElement;

    // remove the error class
    formField.classList.remove('error');
    formField.classList.add('success');

    // hide the error message
    const success = formField.querySelector('small');
    success.textContent = message;
}

getPosts();
getMyPosts();
