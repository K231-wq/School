document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('registerForm');
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('passwordConfirm');
  const imageInput = document.getElementById('imageFile');
  const togglePasswordBtn = document.getElementById('togglePassword');
  const passwordStrength = document.getElementById('passwordStrength');
  const matchError = document.getElementById('matchError');

  togglePasswordBtn.addEventListener('click', () => {
    const type = passwordInput.type === 'password' ? 'text' : 'password';
    passwordInput.type = type;
    togglePasswordBtn.textContent = type === 'password' ? 'Show' : 'Hide';
  });

  //live passwordinput check
  passwordInput.addEventListener('input', () => {
    const val = passwordInput.value;
    const hasUpper = /[A-Z]/.test(val);
    const hasLower = /[a-z]/.test(val);
    const hasNumber = /[0-9]/.test(val);
    const hasSpecial = /[!@#$%^&*(),.":{}|<>]/.test(val);
    const isLong = val.length >= 8;

    let strengthText = '';
    let colorClass = '';

    if (!val) {
      strengthText = '';
      colorClass = '';
    } else if (isLong && hasUpper && hasLower && hasNumber && hasSpecial) {
      strengthText = 'Strong';
      colorClass = 'text-light-success';
    } else if (val.length >= 6 && hasLower && hasNumber) {
      strengthText = 'Medium';
      colorClass = 'text-warning';
    } else {
      strengthText = 'Weak';
      colorClass = 'text-danger';
    }

    passwordStrength.textContent = strengthText ? `Strength: ${strengthText}` : '';
    passwordStrength.className = colorClass;
  });

  //Live confirmPassword and password is match check
  confirmPasswordInput.addEventListener('input', () => {
    if (confirmPasswordInput.value !== passwordInput.value) {
      confirmPasswordInput.classList.remove('is-valid');
      confirmPasswordInput.classList.add('is-invalid');
      matchError.style.display = 'block';
    } else {
      confirmPasswordInput.classList.add('is-valid');
      confirmPasswordInput.classList.remove('is-invalid');
      matchError.style.display = 'none';
    }
  });

  //Live Name, email and password
  function liveValidate(input, validateFn){
    input.addEventListener('input', () => {
      const isValid = validateFn(input.value);
      input.classList.toggle('is-valid', isValid);
      input.classList.toggle('is-invalid', !isValid);
    })
  }

  liveValidate(nameInput, (val) => val.trim().length > 0);
  liveValidate(emailInput, (val) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val));
  liveValidate(passwordInput, (val) => 
    val.length >= 8 &&
    /[A-Z]/.test(val) &&
    /[a-z]/.test(val) &&
    /[0-9]/.test(val) &&
    /[!@#$%^&*(),."|{}<>]/.test(val) 
  );

  //live imageFile check
  function validateImageInput(){
    const file = imageInput.files[0];
    const isValid = file && file.size > 0;

    imageInput.classList.toggle('is-valid', isValid);
    imageInput.classList.toggle('is-invalid', !isValid);

    return isValid;
  }

  imageInput.addEventListener('change', validateImageInput);
  //submit form handler new

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const validations = {
      name: nameInput.value.trim().length > 0,
      email: emailInput.validity.valid,
      password: passwordInput.value.length >= 8 &&
                /[A-Z]/.test(passwordInput.value) &&
                /[a-z]/.test(passwordInput.value) &&
                /[0-9]/.test(passwordInput.value) &&
                /[!@#$%^&*(),.":{}|<>]/.test(passwordInput.value),
      passwordConfirmation: confirmPasswordInput.value.length > 0 &&
                            confirmPasswordInput.value === passwordInput.value &&
                            passwordInput.value.length >= 8,
      image: validateImageInput(),
    }

    nameInput.classList.toggle('is-valid', validations.name);
    nameInput.classList.toggle('is-invalid', !validations.name);

    emailInput.classList.toggle('is-valid', validations.email);
    emailInput.classList.toggle('is-invalid', !validations.email);

    passwordInput.classList.toggle('is-valid', validations.password);
    passwordInput.classList.toggle('is-invalid', !validations.password);

    confirmPasswordInput.classList.toggle('is-valid', validations.passwordConfirmation);
    confirmPasswordInput.classList.toggle('is-invalid', !validations.passwordConfirmation);
    matchError.style.display = validations.passwordConfirmation ? 'none' : 'block';

    const allValid = Object.values(validations).every(v => v === true);

    if(allValid){
      form.submit();
    }
  });
  //submit form handler [error at image file handler is always happened [ is-valid ]]
  // form.addEventListener('submit', (e) => {
  //   e.preventDefault();

  //   let valid = true;

  //   //Name check valid|not
  //   if(!nameInput.value.trim()){
  //     nameInput.classList.add("is-invalid");
  //     valid = false;
  //   }else{
  //     nameInput.classList.remove('is-invalid');
  //   }

  //   //Email check valid|not
  //   if(!emailInput.validity.valid){
  //     emailInput.classList.add("is-invalid");
  //     valid = false;
  //   } else{
  //     emailInput.classList.remove('is-invalid');
  //   }

  //   //passsword validate
  //   const val = passwordInput.value;
  //   const passwordValid = val.length >= 8 &&
  //                       /[A-Z]/.test(val) &&
  //                       /[a-z]/.test(val) &&
  //                       /[0-9]/.test(val) &&
  //                       /[!@#$%^&*(),.":{}|<>]/.test(val);
  //   if(!passwordValid){
  //     passwordInput.classList.add("is-invalid");
  //     valid = false;
  //   }else{
  //     passwordInput.classList.remove("is-invalid");
  //   }
    
  //   //password confirmation validate
  //   if(confirmPasswordInput.value != passwordInput.value){
  //     confirmPasswordInput.classList.add("is-invalid");
  //     matchError.style.display = "block";
  //     valid = false;
  //   }else{
  //     confirmPasswordInput.classList.remove("is-invalid");
  //     matchError.style.display = "none";
  //   }

  //   //image file exists validate
  //   if(!imageInput.files.length){
  //     imageInput.classList.add("is-invalid");
  //     valid = false;
  //   }

  //   //all fields requirement is fulfill or correct, it will return [false];  meaning not error at fields validations that we have set!!
  //   if (!form.checkValidity()) {
  //     form.classList.add('was-validated');
  //     return;
  //   }
    
  //   if(valid){
  //     form.submit();
  //   }
  // });
});
