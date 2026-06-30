// ============================================
// Custom JavaScript for Business Website
// ============================================

// Counter animation for stats
document.addEventListener('DOMContentLoaded', function () {
    const counters = document.querySelectorAll('.counter');

    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const step = Math.max(1, Math.floor(target / (duration / 16))); // 60fps

        let current = 0;
        const increment = () => {
            current += step;
            if (current >= target) {
                counter.textContent = target + '+';
                return;
            }
            counter.textContent = current;
            requestAnimationFrame(increment);
        };
        increment();
    };

    // Intersection Observer for scroll-triggered animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                animateCounter(counter);
                observer.unobserve(counter);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Auto-dismiss alerts after 5 seconds
document.querySelectorAll('.alert').forEach(alert => {
    setTimeout(() => {
        const closeBtn = alert.querySelector('.btn-close');
        if (closeBtn) {
            closeBtn.click();
        }
    }, 5000);
});

// Form validation helper
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Add 'active' class to current nav item
document.addEventListener('DOMContentLoaded', function () {
    const currentPage = window.location.pathname.split('/').pop() || 'index.php';
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPage) {
            link.classList.add('active');
        }
    });
});

// ============================================
// STAT CARD FILTER CLICK HANDLER
// ============================================

document.addEventListener('DOMContentLoaded', function () {
    // Make stat cards clickable for filtering
    const cards = document.querySelectorAll('.stat-clickable');
    cards.forEach(function (card) {
        card.style.cursor = 'pointer';
        card.addEventListener('click', function () {
            const filter = this.dataset.filter;
            window.location.href = '?filter=' + filter;
        });
    });
});