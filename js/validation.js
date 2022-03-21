// Select all input elements for varification
const username = document.getElementById("username");
const name = document.getElementById("name");
const surname = document.getElementById("surname");
const email = document.getElementById("email");
const phone = document.getElementById("phone");
const password = document.getElementById("password");
const re_password = document.getElementById("re_password");


// function for form varification
function formValidation() {
    var number = /[0-9]{10}/;
    var error = "";
    var illegalChars = /\W/; 
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  // checking username 
  if(username.value == "") {
    username.style.borderColor = "red"
    error = "กรุณป้อน Username\n";
    alert(error);
    username.focus();
    return false;
    }else if (illegalChars.test(username.value)) {
        username.style.borderColor = "red"
        error = "Username มีตัวอักษรที่ไม่ได้รับอนุญาติ\n";
        alert(error);
        username.focus();
        return false;
    }else{
        username.style.borderColor = "gray"
    }
  // checking name and surname
  if(name.value == "") {
    name.style.borderColor = "red"
    error = "กรุณป้อน name\n";
    alert(error);
    name.focus();
    return false;
  }else{
    name.style.borderColor = "gray"
  }

  if(surname.value == "") {
    surname.style.borderColor = "red"
    error = "กรุณป้อน Surname\n";
    alert(error);
    surname.focus();
    return false;
  }else{
    surname.style.borderColor = "gray"
  }
  //check email
  if(email.value == ""){
    email.style.borderColor = "red"
    error = "กรุณาป้อน Email\n";
    alert(error);
    email.focus();
    return false;
  }else if(!filter.test(email.value)){
    alert('กรุณาป้อน Email ไม่ถูกต้อง');
    email.focus();
    return false;
  }else{
    email.style.borderColor = "gray"
  }


  //check phone
   if(phone.value == "") {
    phone.style.borderColor = "red"
    error = "กรุณาป้อน หมายเลขโทรศัพท์\n";
    alert(error);
    phone.focus();
    return false;
  }else if(!phone.value.match(number)){
    phone.style.borderColor = "red"
    error = "รูปแบบผิด กรุณากรอกใหม่\n";
    alert(error);
    phone.focus();
    return false;
  }else {
    phone.style.borderColor = "gray"
  }


  //check password and re-password
  if(password.value == "") {
    password.style.borderColor = "red"
    error = "กรุณาป้อน Password\n";
    alert(error);
    password.focus();
    return false;
  }else if (password.value != re_password.value) {
    error = "Password ไม่ตรงกัน\n";
    password.style.style.borderColor = "red"
    re_password.style.style.borderColor = "red"
    alert(error);
    password.focus();
    return false;
   } else {
    password.style.style.borderColor = "gray"
    re_password.style.style.borderColor = "gray"
    }

  
  return true;
}