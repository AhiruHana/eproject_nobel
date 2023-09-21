function togglePasswordVisibility(idInput,idSpan) {
  var passwordInput = document.getElementById(idInput);
  var passwordToggle = document.getElementById(idSpan);

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordToggle.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
  } else {
    passwordInput.type = "password";
    passwordToggle.innerHTML = '<i class="fa-solid fa-eye"></i>';
  }
  passwordInput.focus();
}

