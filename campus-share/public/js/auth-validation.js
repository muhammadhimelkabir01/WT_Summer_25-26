// public/js/auth-validation.js

document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');

    // --- REGISTRATION VALIDATION ---
    if (registerForm) {
        const fullNameInput = registerForm.querySelector('input[name="full_name"]');
        const studentIdInput = registerForm.querySelector('input[name="student_id"]');
        const emailInput = registerForm.querySelector('input[name="email"]');
        const passwordInput = registerForm.querySelector('input[name="password"]');
        const errorDiv = document.getElementById('js-error-msg');

       
        const namePattern = /^[a-zA-Z\s.]{3,50}$/;
       
        const idPattern = /^\d{2}-\d{5}-[1-3]$/;

      
        fullNameInput.addEventListener('input', () => {
            const val = fullNameInput.value.trim();
            if (val.length > 0 && !namePattern.test(val)) {
                fullNameInput.style.border = '2px solid #ef4444';
            } else if (val.length >= 3) {
                fullNameInput.style.border = '2px solid #10b981';
            } else {
                fullNameInput.style.border = '1px solid #cbd5e1';
            }
        });

       
        studentIdInput.addEventListener('input', () => {
            const val = studentIdInput.value.trim();
            if (val.length > 0 && !idPattern.test(val)) {
                studentIdInput.style.border = '2px solid #ef4444';
            } else if (val.length > 0) {
                studentIdInput.style.border = '2px solid #10b981';
            } else {
                studentIdInput.style.border = '1px solid #cbd5e1';
            }
        });

        
        registerForm.addEventListener('submit', (e) => {
            const fullName = fullNameInput.value.trim();
            const studentId = studentIdInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value;

            let errorMessage = '';

            if (!namePattern.test(fullName)) {
                errorMessage = 'Full Name must contain only letters, dots, and spaces (minimum 3 characters, no numbers allowed).';
                fullNameInput.focus();
            } else if (!idPattern.test(studentId)) {
                errorMessage = 'Invalid Student ID! Must be in format: XX-XXXXX-X (e.g. 23-51481-1).';
                studentIdInput.focus();
            } else if (!email.includes('@') || !email.includes('.')) {
                errorMessage = 'Please provide a valid institutional email address.';
                emailInput.focus();
            } else if (password.length < 6) {
                errorMessage = 'Password must be at least 6 characters long.';
                passwordInput.focus();
            }

            if (errorMessage !== '') {
                e.preventDefault(); // ফর্ম সাবমিট ব্লক করবে
                if (errorDiv) {
                    errorDiv.innerText = errorMessage;
                    errorDiv.style.display = 'block';
                } else {
                    alert(errorMessage);
                }
            }
        });
    }

    
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            const identifier = loginForm.querySelector('input[name="email"]').value.trim();
            const password = loginForm.querySelector('input[name="password"]').value;

            if (identifier === '' || password === '') {
                e.preventDefault();
                alert('Both fields are required.');
            }
        });
    }
});