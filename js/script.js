document.addEventListener('DOMContentLoaded', function() {
    // form validation for contact form
    const contactForm = document.querySelector('form[action="contact.php"], form[action="/contact.php"], form.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const nameEl = document.getElementById('name');
            const emailEl = document.getElementById('email');
            const messageEl = document.getElementById('message');
            if (!nameEl || !emailEl || !messageEl) return;

            const name = nameEl.value.trim();
            const email = emailEl.value.trim();
            const message = messageEl.value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;// Simple email regex pattern
            
            // Check for empty fields
            if (name === '' || email === '' || message === '') {
                e.preventDefault();
                alert('Please fill in all required fields.');
                return false;
            }
            // Validate email format
            if (!emailPattern.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                return false;
            }
        });
    }

    // confirmation prompts for  logout button
    const interactiveButtons = document.querySelectorAll('.admin-btn-del, .logout');
    interactiveButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            const action = this.classList.contains('logout') ? 'logout' : 'delete this message';
            if (!confirm(`Are you sure you want to ${action}?`)) e.preventDefault();
        });
    });

    // fade in/out for status messages
    const statusAlerts = document.querySelectorAll('.status-msg');
    statusAlerts.forEach(statusAlert => {
        // ensure starting opacity is 0 so fade-in works
        statusAlert.style.opacity = '0';
        statusAlert.style.transition = 'opacity 0.6s ease';
        // small delay to allow browser to apply initial style
        setTimeout(() => { statusAlert.style.opacity = '1'; }, 80);

        // after 3.5s, fade out and remove
        setTimeout(() => {
            statusAlert.style.opacity = '0';
            setTimeout(() => { statusAlert.style.display = 'none'; }, 700);
        }, 3500);
    });
});