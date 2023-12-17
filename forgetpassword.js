function validateForgetpassForm(pform) {
    console.log("Form submitted!");


   const confirmpass = pform.newpassword.value;
 

   const confirmpassErr = document.getElementById('confirmpassErr');
   
   confirmpassErr.innerHTML = "";

   let flag = true;

   if (confirmpass === "") {
       confirmpassErr.innerHTML = 'Enter a Password';
       confirmpassErr.style.color = "red";
       flag = false;
   }
  

return flag;

}