// Language switcher functionality
document.addEventListener('DOMContentLoaded', function() {
    const languageButton = document.querySelector('.language-dropdown-btn');
    const languageMenu = document.querySelector('.language-menu');
    const languageLinks = document.querySelectorAll('.language-menu a');

    // Toggle language menu
    if (languageButton && languageMenu) {
        languageButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            languageMenu.classList.toggle('show');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!languageButton.contains(e.target) && !languageMenu.contains(e.target)) {
                languageMenu.classList.remove('show');
            }
        });
    }

    // Add loading state to language links
    languageLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const currentLang = this.getAttribute('data-lang');
            
            // Show loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang chuyển đổi...';
            
            // Optional: Add fade effect to page
            document.body.style.opacity = '0.8';
            
            // Let the default action proceed (navigate to route)
        });
    });

    // Get language info via API
    async function getLanguageInfo() {
        try {
            const response = await fetch('/api/language/info');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error getting language info:', error);
            return null;
        }
    }

    // Initialize language info
    getLanguageInfo().then(info => {
        if (info) {
            console.log('Current language:', info.current);
            console.log('Supported languages:', info.supported);
            
            // Update UI with current language info
            updateLanguageUI(info.current.locale);
        }
    });

    // Update language UI based on current locale
    function updateLanguageUI(currentLocale) {
        // Highlight current language in menu
        languageLinks.forEach(link => {
            const linkLang = link.getAttribute('data-lang');
            if (linkLang === currentLocale) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        // Set document language attribute
        document.documentElement.setAttribute('lang', currentLocale);
        
        // Set direction for RTL languages (if needed in future)
        // document.documentElement.setAttribute('dir', getDirection(currentLocale));
    }

    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 5000);
    });
});
