// NewTheme/js/main.js
// Contains main theme JavaScript: Hotkey Help Modal control and Mobile Menu.

function setupHotkeyModal() {
    // Hotkey Help Modal functionality
    var hotkeyHelpTrigger = document.getElementById('hotkey-help-trigger');
    var hotkeyHelpModal = document.getElementById('hotkey-help-modal');
    var closeHotkeyModal = document.getElementById('close-hotkey-modal');
    var hotkeyModalStatus = document.getElementById('hotkey-modal-status'); // New

    if (hotkeyHelpTrigger && hotkeyHelpModal && closeHotkeyModal && hotkeyModalStatus) {
        let focusableElements = [];
        const focusableElementsSelector = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
        let firstFocusableElement;
        let lastFocusableElement;

        // Named function for focus trapping keydown event
        function trapFocusKeyDown(e) {
            if (e.key !== 'Tab' && e.keyCode !== 9) {
                return; // Not a Tab key
            }

            if (focusableElements.length === 0) return; // Should not happen if modal is open

            if (e.shiftKey) { // Shift + Tab
                if (document.activeElement === firstFocusableElement) {
                    lastFocusableElement.focus();
                    e.preventDefault();
                }
            } else { // Tab
                if (document.activeElement === lastFocusableElement) {
                    firstFocusableElement.focus();
                    e.preventDefault();
                }
            }
        }
        
        // Named function for Escape key
        function escapeKeyClose(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                hideModal();
            }
        }

        function showModal() {
            hotkeyHelpModal.style.display = 'block';
            hotkeyHelpModal.setAttribute('aria-hidden', 'false');
            hotkeyModalStatus.textContent = '键盘快捷键帮助已显示'; // "Hotkey help displayed"

            focusableElements = Array.from(hotkeyHelpModal.querySelectorAll(focusableElementsSelector));
            if (focusableElements.length > 0) {
                firstFocusableElement = focusableElements[0];
                lastFocusableElement = focusableElements[focusableElements.length - 1];
                hotkeyHelpModal.addEventListener('keydown', trapFocusKeyDown);
            }
            
            hotkeyHelpModal.addEventListener('keydown', escapeKeyClose);

            requestAnimationFrame(function() {
                // In this specific modal, the close button is the primary focusable element.
                // If there were other focusable elements, ensure the first one (or a specific one) gets focus.
                if(firstFocusableElement) firstFocusableElement.focus();
                else closeHotkeyModal.focus(); // Fallback, though firstFocusableElement should be closeHotkeyModal
            });
        }

        function hideModal() {
            hotkeyHelpModal.style.display = 'none';
            hotkeyHelpModal.setAttribute('aria-hidden', 'true');
            hotkeyModalStatus.textContent = ''; // Clear status text
            
            hotkeyHelpModal.removeEventListener('keydown', trapFocusKeyDown);
            hotkeyHelpModal.removeEventListener('keydown', escapeKeyClose);
            
            hotkeyHelpTrigger.focus(); 
        }

        // Event listener to open the modal
        hotkeyHelpTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            showModal();
        });

        // Event listener to close the modal via button
        closeHotkeyModal.addEventListener('click', function() {
            hideModal();
        });
    }
} // end of setupHotkeyModal()

function setupMobileMenu() {
    var menuToggle = document.getElementById('mobile-menu-toggle');
    var mainNav = document.getElementById('main-navigation');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            var isExpanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            var newExpandedState = !isExpanded;
            menuToggle.setAttribute('aria-expanded', newExpandedState);
            mainNav.classList.toggle('nav-open');
            menuToggle.classList.toggle('active'); // Optional for styling the button

            if (newExpandedState) { // Menu is now open
                // Find focusable elements within the navigation menu
                const focusableElementsSelector = 'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';
                var focusableItems = mainNav.querySelectorAll(focusableElementsSelector);
                if (focusableItems.length > 0) {
                    requestAnimationFrame(function() {
                        focusableItems[0].focus();
                    });
                }
            } else { // Menu is now closed
                menuToggle.focus();
            }
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
