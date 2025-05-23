// NewTheme/js/main.js
// Contains main theme JavaScript: initial focus logic and Hotkey Help Modal control.

function startdoing() {
    // Initial page focus logic:
    // Focus search on homepage, or main content title on other pages.
    <?php if($this->is('index')): ?>
    try { 
        var sHeader = document.getElementById('s-header');
        if (sHeader) sHeader.focus();
    } catch(e) { console.error("Error focusing on #s-header:", e); }
    <?php else: ?>
    try {
        var entryTitle = document.querySelector('.entry-title');
        if (entryTitle) {
          entryTitle.setAttribute('tabindex', -1);
          entryTitle.focus();
        }
    } catch(e) { console.error("Error focusing on .entry-title:", e); }
    <?php endif; ?>
    
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
} // end of startdoing()

// Initialize the startdoing function once the DOM is ready.
if (document.readyState === 'loading') { 
    document.addEventListener('DOMContentLoaded', startdoing);
} else {
    startdoing(); // Call it directly if already loaded
}
