var pform = document.querySelector("#registration");
pform.addEventListener("submit", (e) => {
  e.preventDefault();
  console.log("Form submitted!");

  const fields = {
    firstname: "First Name",
    lastname: "Last Name",
    email: "Email",
    gender: "Gender",
    blood: "Blood Group",
    number: "Phone Number",
    username: "Username",
    pass1: "Password", // Update this field to match the actual name attribute
    pass2: "Confirm Password", // Update this field to match the actual name attribute
  };

  const errorMessages = {
    firstname: "Please enter a first name.",
    lastname: "Please enter a last name.",
    email: "Please enter an email.",
    gender: "Please enter a gender.",
    blood: "Please select a blood group.",
    number: "Please enter a phone number.",
    username: "Please enter a username.",
    pass1: "Please enter a password.", // Update this field to match the actual name attribute
    pass2: "Please enter a password.", // Update this field to match the actual name attribute
  };

  const clearErrors = () => {
    for (const field in fields) {
      const errElement = document.getElementById(`${field}Err`);
      errElement.innerHTML = "";
    }
  };

  const displayError = (field, message) => {
    const errElement = document.getElementById(`${field}Err`);
    errElement.innerHTML = message;
    errElement.style.color = "red";
  };

  const validateField = (field, value) => {
    if (value.trim() === "") {
      displayError(field, errorMessages[field]);
      return false;
    }
    return true;
  };

  clearErrors();
  let flag = true;

  for (const field in fields) {
    console.log(field);
    const value = document.querySelector(`[name="${field}"]`).value;
    flag = validateField(field, value) && flag;
  }

  if(flag){
    pform.submit();
  }
});
