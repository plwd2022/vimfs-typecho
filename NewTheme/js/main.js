// NewTheme/js/main.js
// Contains main theme JavaScript: Hotkey Help Modal control.

function setupHotkeyModal() {
    // Hotkey Help Modal functionality
    var hotkeyHelpTrigger = document.getElementById('hotkey-help-trigger');
    var hotkeyHelpModal = document.getElementById('hotkey-help-modal');
    var closeHotkeyModal = document.getElementById('close-hotkey-modal');

    if (hotkeyHelpTrigger && hotkeyHelpModal && closeHotkeyModal) {
        // Event listener to open the modal
        hotkeyHelpTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            var modalContent = hotkeyHelpModal.querySelector('.hotkey-modal-content'); // Get content area

            hotkeyHelpModal.style.display = 'block';
            hotkeyHelpModal.setAttribute('aria-hidden', 'false');
            
            if (modalContent) {
                modalContent.setAttribute('aria-live', 'assertive'); // Activate live region
            }

            // Delay focus slightly to ensure modal is ready
            requestAnimationFrame(function() {
                closeHotkeyModal.focus();
            });
        });

        // Event listener to close the modal via button
        closeHotkeyModal.addEventListener('click', function() {
            var modalContent = hotkeyHelpModal.querySelector('.hotkey-modal-content');
            hotkeyHelpModal.style.display = 'none';
            hotkeyHelpModal.setAttribute('aria-hidden', 'true');
            if (modalContent) {
                modalContent.removeAttribute('aria-live'); // Deactivate live region
            }
            hotkeyHelpTrigger.focus(); 
        });

        // Event listener to close the modal via Escape key
        hotkeyHelpModal.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                var modalContent = hotkeyHelpModal.querySelector('.hotkey-modal-content');
                hotkeyHelpModal.style.display = 'none';
                hotkeyHelpModal.setAttribute('aria-hidden', 'true');
                if (modalContent) {
                    modalContent.removeAttribute('aria-live'); // Deactivate live region
                }
                hotkeyHelpTrigger.focus();
            }
        });
    }
} // end of setupHotkeyModal()

// Initialize the modal setup once the DOM is ready.
if (document.readyState === 'loading') { 
    document.addEventListener('DOMContentLoaded', setupHotkeyModal);
} else {
    setupHotkeyModal(); // Call it directly if already loaded
}
