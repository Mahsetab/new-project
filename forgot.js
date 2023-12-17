function validateforgotpassForm(pform) {
    console.log("Form submitted!");


   const username = pform.username.value;

   const usernameErr = document.getElementById('usernameErr');
  
   usernameErr.innerHTML = "";
  
   let flag = true;

   if ( username=== "") {
       usernameErr.innerHTML = 'Please enter a Name';
       usernameErr.style.color = "red";
       flag = false;
   }
   

return flag;

}