// Common JavaScript functions for the hostel management system

// Toggle mobile menu
function toggleMobileMenu() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.classList.toggle('hidden');
    }
}

// Form validation
function validateLoginForm(form) {
    const username = form.querySelector('#username, #student-id').value.trim();
    const password = form.querySelector('#password').value.trim();

    if (!username) {
        alert('Please enter your username/student ID');
        return false;
    }

    if (!password) {
        alert('Please enter your password');
        return false;
    }

    return true;
}

// Initialize event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    }

    // Login form submission
    const loginForms = document.querySelectorAll('form');
    loginForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateLoginForm(this)) {
                e.preventDefault();
            }
        });
    });

    // Simulate login (for demo purposes)
    const loginButtons = document.querySelectorAll('.login-btn');
    loginButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const isAdmin = this.classList.contains('admin-login');
            window.location.href = isAdmin ? 'admin-dashboard.html' : 'student-dashboard.html';
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Handle dashboard card clicks
    const cards = document.querySelectorAll('.dashboard-card');
    
    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Prevent default if it's a link click
            if (e.target.tagName === 'A') return;
            
            // Find the link inside the card
            const link = card.querySelector('a');
            if (link) {
                window.location.href = link.href;
            }
        });
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.md\\:hidden');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        });
    }
});
// Add to your script.js or at the bottom of each dashboard
document.addEventListener('DOMContentLoaded', function() {
    const currentPage = window.location.pathname.split('/').pop();
    const links = document.querySelectorAll('.sidebar a');
    
    links.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('bg-gray-700');
        }
    });
});
// Toast notification
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}