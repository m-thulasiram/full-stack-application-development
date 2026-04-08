// Validate Name
function validateName() {
    let name = document.getElementById("name");
    if (name.value.length < 3) {
        name.classList.add("error");
    } else {
        name.classList.remove("error");
    }
}

// Validate Email
function validateEmail() {
    let email = document.getElementById("email");
    let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    if (!email.value.match(pattern)) {
        email.classList.add("error");
    } else {
        email.classList.remove("error");
    }
}

// Validate Message
function validateMessage() {
    let msg = document.getElementById("message");
    if (msg.value.length < 5) {
        msg.classList.add("error");
    } else {
        msg.classList.remove("error");
    }
}

// Submit (Double Click)
function submitForm() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let msg = document.getElementById("message").value;

    if (name === "" || email === "" || msg === "") {
        alert("Please fill all fields!");
        return;
    }

    alert("Thank you for your feedback!");
}