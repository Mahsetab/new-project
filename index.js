function validateLoginForm(myForm) {
    const username = myForm.username.value;
    const password = myForm.password.value;
    let flag = true;
    const user_err = document.getElementById('usernameErr');
    const pass_err = document.getElementById('passwordErr');
    user_err.innerHTML = "";
    pass_err.innerHTML = "";
 
    if (username === "") {
      user_err.innerHTML = 'Please enter a username.';
      user_err.style.color = "red";
        flag = false;
    } else if (!/^[a-zA-Z0-9]+$/.test(username)) {
      user_err.innerHTML = 'Username should only contain letters and numbers.';
      user_err.style.color = "red";
        flag = false;
    }
 
    if (password === "") {
      pass_err.innerHTML = 'Please enter a password.';
      pass_err.style.color = "red";
        flag = false;
    }
    return flag;
}
 