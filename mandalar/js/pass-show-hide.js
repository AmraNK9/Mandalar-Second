
document.addEventListener("DOMContentLoaded", function() {
  // Your code here
  const pswrdField = document.querySelector(".form input[type='password']"),
  toggleIcon = document.querySelector(".eye");
  
  toggleIcon.onclick = () =>{
    console.log("click eye")
    if(pswrdField.type === "password"){
      pswrdField.type = "text";
      toggleIcon.classList.add("active");
    }else{
      pswrdField.type = "password";
      toggleIcon.classList.remove("active");
    }
  }
});