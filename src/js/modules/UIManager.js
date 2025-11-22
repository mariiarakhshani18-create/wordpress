export class UIManager {
    constructor() {
        this.initMobileMenu();
        this.initSmoothScroll();
    }

    initMobileMenu() {
        // Placeholder for mobile menu logic
        // In a real project, we would have a hamburger button in the HTML
        console.log('UI Manager initialized');
    }

    initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
}
