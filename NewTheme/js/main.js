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

function setupDailyBackgroundImage() {
    const BING_API_URL = 'https://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN';
    const CACHE_KEY_IMAGE_URL = 'daily_bing_image_url';
    const CACHE_KEY_DATE = 'daily_bing_image_date';
    const today = new Date().toISOString().split('T')[0]; // Get YYYY-MM-DD

    const cachedImageUrl = localStorage.getItem(CACHE_KEY_IMAGE_URL);
    const cachedDate = localStorage.getItem(CACHE_KEY_DATE);

    if (cachedImageUrl && cachedDate === today) {
        applyBackground(cachedImageUrl);
    } else {
        fetch(BING_API_URL)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok for Bing API');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.images && data.images.length > 0) {
                    const imageUrl = 'https://www.bing.com' + data.images[0].url;
                    localStorage.setItem(CACHE_KEY_IMAGE_URL, imageUrl);
                    localStorage.setItem(CACHE_KEY_DATE, today);
                    applyBackground(imageUrl);
                } else {
                    throw new Error('No image data found in Bing API response');
                }
            })
            .catch(error => {
                console.error('Error fetching or processing Bing daily image:', error);
                // Optional: clear cache if fetch fails, or implement fallback
                // localStorage.removeItem(CACHE_KEY_IMAGE_URL);
                // localStorage.removeItem(CACHE_KEY_DATE);
            });
    }

    function applyBackground(imageUrl) {
        const img = new Image();
        img.onload = function() {
            document.body.style.backgroundImage = 'url(' + imageUrl + ')'; // For ::before to inherit
            document.body.classList.add('with-daily-background');
            // Add bg-loaded class after a tiny delay to ensure CSS transition applies
            requestAnimationFrame(function() {
                requestAnimationFrame(function() { // Double rAF for good measure in some browsers
                    document.body.classList.add('bg-loaded');
                });
            });
        };
        img.onerror = function() {
            console.error('Error loading background image:', imageUrl);
            document.body.classList.remove('with-daily-background');
            document.body.classList.remove('bg-loaded');
        };
        img.src = imageUrl;
    }
}

function setupMobileMenu() {
    var menuToggle = document.getElementById('mobile-menu-toggle');
    var mainNav = document.getElementById('main-navigation');

    if (menuToggle && mainNav) {
        // If the mobile menu toggle button is hidden by CSS (typically on desktop)
        // then don't attach listeners or manage its ARIA states.
        if (getComputedStyle(menuToggle).display === 'none') {
            return;
        }

        // Existing event listener logic:
        menuToggle.addEventListener('click', function() {
            var isExpanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            var newExpandedState = !isExpanded;
            menuToggle.setAttribute('aria-expanded', newExpandedState);
            mainNav.classList.toggle('nav-open');
            mainNav.setAttribute('aria-hidden', !newExpandedState); 
            menuToggle.classList.toggle('active'); 

            if (newExpandedState) { 
                const focusableElementsSelector = 'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';
                var focusableItems = mainNav.querySelectorAll(focusableElementsSelector);
                if (focusableItems.length > 0) {
                    requestAnimationFrame(function() {
                        focusableItems[0].focus();
                    });
                }
            } else { 
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
        setupDailyBackgroundImage(); // Added
    });
} else { // Already loaded
    setupHotkeyModal();
    setupMobileMenu(); 
    setupDailyBackgroundImage(); // Added
}
