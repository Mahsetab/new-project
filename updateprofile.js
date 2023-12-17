
function updateprofileForm(pform) {
    console.log("Form submitted!");


   const fname = pform.fname.value;
   const number = pform.number.value;
   const email = pform.email.value;
   const address = pform.address.value;


   const fnameErr = document.getElementById('fnameErr');
   const numberErr = document.getElementById('numberErr');
   const emailErr = document.getElementById('emailErr');
   const addressErr = document.getElementById('addressErr');

   fnameErr.innerHTML = "";
   numberErr.innerHTML = "";
   emailErr.innerHTML = "";
   addressErr.innerHTML = "";



   let flag = true;

   if (fname === "") {
       fnameErr.innerHTML = '';
       fnameErr.style.color = "red";
       flag = false;
   }
  
   
   if (number=== "") {
 numberErr.innerHTML = 'Please enter a number';
    numberErr.style.color = "red";
       flag = false;
   }

   if (email=== "") {
    emailErr.innerHTML = 'Please enter a email';
       emailErr.style.color = "red";
          flag = false;
      }

      if (address=== "") {
        addressErr.innerHTML = 'Please enter a address';
           addressErr.style.color = "red";
              flag = false;
          }


return flag;

}