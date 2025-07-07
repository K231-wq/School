document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passswordInput = document.getElementById('password');
    const checkInput = document.getElementById('checkbox');
    const passwordStrength = document.getElementById('passwordStrength');
    const togglePasswordText = document.getElementById('togglePasswordText');

    checkInput.addEventListener('click', () => {
        const type = passswordInput.type === 'password' ? 'text' : 'password';
        passswordInput.type = type;
        togglePasswordText.textContent = type === 'password' ? `Show Password` : `Hide Password`;
    });

    function liveValidate(input, validateFn) {
        input.addEventListener('input', () => {
            const isValid = validateFn(input.value);
            input.classList.toggle('is-valid', isValid);
            input.classList.toggle('is-invalid', !isValid);
        })
    }

    liveValidate(emailInput, (val) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val));
    liveValidate(passswordInput, (val) =>
        val.length >= 8 &&
        /[A-Z]/.test(val) &&
        /[a-z]/.test(val) &&
        /[0-9]/.test(val) &&
        /[!@#$%^&*(),."|{}<>]/.test(val)
    );

    function validateEmailInput(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim());
    }


    passswordInput.addEventListener('input', () => {
        const val = passswordInput.value;
        const hasUpper = /[A-Z]/.test(val);
        const hasLower = /[a-z]/.test(val);
        const hasNumber = /[0-9]/.test(val);
        const hasSpecial = /[!@#$%^&*(),.":{}|<>]/.test(val);

        let strengthText = '';
        let colorClass = '';

        if (!val) {
            strengthText = '';
            colorClass = '';
        } else if (val.length >= 8 && hasUpper && hasLower && hasNumber && hasSpecial) {
            strengthText = 'Strong';
            colorClass = 'text-light-success';
        } else if (val.length >= 6 && hasLower && hasNumber) {
            strengthText = "Medium";
            colorClass = "text-warning";
        } else {
            strengthText = "Weak";
            colorClass = "text-danger";
        }
        passwordStrength.textContent = `Strength: ${strengthText}`;
        passwordStrength.className = colorClass;

    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const emailVal = emailInput.value.trim();
        const passwordVal = passswordInput.value;

        const validations = {
            email: emailVal !== '' && validateEmailInput(emailVal),
            password: passwordVal.length >= 8 &&
                /[A-Z]/.test(passwordVal) &&
                /[a-z]/.test(passwordVal) &&
                /[0-9]/.test(passwordVal) &&
                /[!@#$%^&*(),.":{}|<>]/.test(passwordVal)
        };

        emailInput.classList.toggle('is-valid', validations.email);
        emailInput.classList.toggle('is-invalid', !validations.email);

        passswordInput.classList.toggle('is-valid', validations.password);
        passswordInput.classList.toggle('is-invalid', !validations.password);

        const allValid = Object.values(validations).every(v => v === true);

        if (allValid) {
            form.submit();
        } else {
            console.error("Error at all valid" + allValid);
            if (!validations.email) {
                emailInput.focus();
            } else if (!validations.password) {
                passswordInput.focus();
            }
        }
    })
})