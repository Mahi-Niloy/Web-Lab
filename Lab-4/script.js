function validate(event) {
    var mail = document.getElementById("email");
    var pass = document.getElementById("password");
  
    var Pattern1 = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var Pattern2 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+\-]).{8,12}$/;
  
  
    if (!Pattern1.test(mail.value)) {
      alert('Incorrect email format');
      event.preventDefault();
      return false;
    }
  

    if (!Pattern2.test(pass.value)) {
      alert('Password must be 8–12 characters long and include uppercase, lowercase, number, and special character.');
      event.preventDefault();
      return false;
    }
  

    return true;
  }
  