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
            hotkeyHelpModal.style.display = 'block';
            hotkeyHelpModal.setAttribute('aria-hidden', 'false');
            closeHotkeyModal.focus(); 
        });

        // Event listener to close the modal via button
        closeHotkeyModal.addEventListener('click', function() {
            hotkeyHelpModal.style.display = 'none';
            hotkeyHelpModal.setAttribute('aria-hidden', 'true');
            hotkeyHelpTrigger.focus(); 
        });

        // Event listener to close the modal via Escape key
        hotkeyHelpModal.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                hotkeyHelpModal.style.display = 'none';
                hotkeyHelpModal.setAttribute('aria-hidden', 'true');
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
