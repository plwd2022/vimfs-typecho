// NewTheme/js/main.js
// Contains main theme JavaScript: Hotkey Help Modal control and Mobile Menu.

function setupHotkeyModal() {
    // Hotkey Help Modal functionality
    var hotkeyHelpTrigger = document.getElementById('hotkey-help-trigger');
    var hotkeyHelpModal = document.getElementById('hotkey-help-modal');
    var closeHotkeyModal = document.getElementById('close-hotkey-modal');

    if (hotkeyHelpTrigger && hotkeyHelpModal && closeHotkeyModal) {
        // Event listener to open the modal
        hotkeyHelpTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            hotkeyHelpModal.style.display = 'block';
            hotkeyHelpModal.setAttribute('aria-hidden', 'false');
            hotkeyHelpModal.setAttribute('aria-live', 'assertive'); 
            
            requestAnimationFrame(function() {
                closeHotkeyModal.focus();
            });
        });

        // Event listener to close the modal via button
        closeHotkeyModal.addEventListener('click', function() {
            hotkeyHelpModal.style.display = 'none';
            hotkeyHelpModal.setAttribute('aria-hidden', 'true');
            hotkeyHelpModal.removeAttribute('aria-live'); 
            hotkeyHelpTrigger.focus(); 
        });

        // Event listener to close the modal via Escape key
        hotkeyHelpModal.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                hotkeyHelpModal.style.display = 'none';
                hotkeyHelpModal.setAttribute('aria-hidden', 'true');
                hotkeyHelpModal.removeAttribute('aria-live'); 
                hotkeyHelpTrigger.focus();
            }
        });
    }
} // end of setupHotkeyModal()

function setupMobileMenu() {
    var menuToggle = document.getElementById('mobile-menu-toggle');
    var mainNav = document.getElementById('main-navigation');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            var isExpanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            mainNav.classList.toggle('nav-open');
            menuToggle.classList.toggle('active'); // Optional for styling the button
        });
    }
} // end of setupMobileMenu()

// Initialize functionalities once the DOM is ready.
if (document.readyState === 'loading') { 
    document.addEventListener('DOMContentLoaded', function() {
        setupHotkeyModal();
        setupMobileMenu(); 
    });
} else {
    setupHotkeyModal();
    setupMobileMenu(); 
}
