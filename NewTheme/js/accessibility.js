// NewTheme/js/accessibility.js
// Contains JavaScript related to accessibility enhancements:
// 1. Custom accesskey focusing behavior.
// 2. Keyboard controls for HTML5 media elements.

// Script for enhancing accesskey behavior to cycle through multiple elements.
(function() {
  function isVisible(t) {
    return !! (!t.hasAttribute('disabled') && t.getAttribute('aria-hidden') !== 'true' && t.offsetParent !== null);
  }

  function removeAccesskeyAttribute(selector) {
    document.querySelectorAll(selector).forEach(function(el) {
      el.removeAttribute('accesskey');
    });
  }
  function addClass(selector, clsName) {
    document.querySelectorAll(selector).forEach(function(el) {
      el.classList.add(clsName);
    });
  }
  function toFocus(focusSelector, op) {
    let focusableElements = document.querySelectorAll(focusSelector);
    if (focusableElements.length === 0) {
        return; 
    }

    let els = Array.from(focusableElements); // Convert NodeList to Array
    let len = els.length;
    let ae = document.activeElement;
    let currentIndex = -1;

    if (ae) {
        currentIndex = els.indexOf(ae);
    }

    let nextElementIndex;
    if (currentIndex === -1) { // If current active element is not in our list or no ae
        nextElementIndex = (op === '+') ? 0 : len - 1;
    } else {
        if (op === '+') {
            nextElementIndex = (currentIndex + 1) % len;
        } else {
            nextElementIndex = (currentIndex - 1 + len) % len;
        }
    }
    
    for (let i = 0; i < len; i++) { // Iterate through all elements once
        let potentialEl = els[nextElementIndex];
        if (isVisible(potentialEl)) {
            let tagName = potentialEl.tagName.toLowerCase();
            // These are the types of elements that might need tabindex="-1" to be focusable
            let nonNaturallyFocusable = ['div', 'p', 'span', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'ul', 'ol', 'li', 'form', 'img', 'nav', 'header', 'main', 'footer', 'section', 'aside'];
            
            if (nonNaturallyFocusable.includes(tagName) || (tagName === 'a' && !potentialEl.hasAttribute('href'))) {
                if (!potentialEl.hasAttribute('tabindex')) {
                    potentialEl.setAttribute('tabindex', '-1');
                }
            }
            potentialEl.focus();
            return; // Element focused, exit
        }

        // Move to the next element index for the next iteration
        if (op === '+') {
            nextElementIndex = (nextElementIndex + 1) % len;
        } else {
            nextElementIndex = (nextElementIndex - 1 + len) % len;
        }
    }
  }

  function nextFocus(selector) {
    toFocus(selector, '+');
  }

  function previousFocus(selector) {
    toFocus(selector, '-');
  }

  function isIE() {
    return ( !! window.ActiveXObject || "ActiveXObject" in window);
  }

  if (!isIE()) {
    let els = document.querySelectorAll('[accesskey]');
    let keys = [];
    els.forEach(function(el) {
      let key = el.getAttribute('accesskey');
      if (!keys.includes(key)) {
        keys.push(key);
      }
    });
    keys.forEach(function(key) {
      addClass('[accesskey="' + key + '"]', 'accesskey-' + key);
      removeAccesskeyAttribute('[accesskey="' + key + '"]');
    });

    document.addEventListener('keydown',
    function(e) {
      keys.forEach(function(key) {
        // Ensure key is a string before calling toUpperCase
        let keyCode = typeof key === 'string' ? key.toUpperCase().charCodeAt() : 0; 
        if (keyCode && e.altKey && e.shiftKey && e.keyCode == keyCode) {
          e.preventDefault(); // Prevent default browser action for the shortcut
          previousFocus('.accesskey-' + key);
          return false;
        }
        if (keyCode && e.altKey && e.keyCode == keyCode) {
          e.preventDefault(); // Prevent default browser action for the shortcut
          nextFocus('.accesskey-' + key);
          return false;
        }
      });
    },
    null);
  }

})();

// Script for providing keyboard controls for audio/video elements.
(function() {
function getMedia() {
return document.querySelector('audio, video');
}
function setMediaVolume(op) {
var c = getMedia();
if(c == null) { return false; }
if(op == '+') {
c.volume = Math.min(c.volume + 0.05, 1);
} else {
c.volume = Math.max(c.volume - 0.05, 0);
}
}
function setMediaCurrentTime(op) {
var c = getMedia();
if(c == null) { return false; }
if(op == '+') {
c.currentTime += 5;
} else {
c.currentTime -= 5;
}
}
function toggleMediaPlay() {
var c = getMedia();
if(c == null) { return false; }
if(c.paused) {
c.play();
} else {
c.pause();
}
}
let c = getMedia();
if(c != null) {
document.addEventListener('keydown', function(e) {
let keyCode = e.keyCode;
let shiftKey = e.shiftKey;
if(shiftKey && keyCode == 32 || keyCode == 27) { // Space or Esc
e.preventDefault();
toggleMediaPlay();
}
if(shiftKey && keyCode == 38) { // Up arrow
e.preventDefault();
setMediaVolume('+');
}
if(shiftKey && keyCode == 40) { // Down arrow
e.preventDefault();
setMediaVolume('-');
}
if(shiftKey && keyCode == 37) { // Left arrow
e.preventDefault();
setMediaCurrentTime('-');
}
if(shiftKey && keyCode == 39) { // Right arrow
e.preventDefault();
setMediaCurrentTime('+');
}

}, null);
}
})();
