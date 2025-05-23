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
    let els = document.all; // Note: document.all is non-standard, consider document.querySelectorAll(focusSelector)
    let len = els.length;
    let ae = document.activeElement;
    let aeIndex = 0,
    index = 0;
    for (let i = 0; i < len; i++) {
      if (els[i] == ae) {
        aeIndex = index = i;
        break;
      }
    }
    let i = op == '+' ? index + 1 : index - 1;
    while (i != aeIndex) {
      // Consider using a more specific selector if possible, or ensure focusSelector is robust
      if (els[i].matches(focusSelector) && isVisible(els[i])) {
        index = i;
        break;
      }
      i = op == '+' ? i + 1 : i - 1;
      if (i >= len) {
        i = 0;
      }
      if (i < 0) {
        i = len - 1;
      }
    }
    let el = els[index];
    if (el) { // Ensure el exists
        let tagName = el.tagName.toLowerCase();
        let pels = ['div', 'p', 'span', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'ul', 'ol', 'li', 'form', 'img', 'nav', 'header', 'main', 'footer', 'section', 'aside'];
        if (pels.includes(tagName) || (tagName == 'a' && !el.hasAttribute('href'))) {
          if (!el.hasAttribute('tabindex')) {
            el.setAttribute('tabindex', '-1');
          }
        }
        el.focus();
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
