</div> <?php // This might be the closing div of site-content or similar ?>
<div id="footer">
  <?php // Removed <script type="text/javascript">startdoing();</script> ?>
  <div id="hspan">
        <div class="copyright-info">
            该主题基于 <a href="http://www.staraudio.net/" target="_blank" rel="nofollow external">星之音</a> 的主题通过AI二次开发后形成，by Typecho
        </div>
        <div class="icp-info">备案号预留区域</div>
  </div>
</div>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    // Initial page focus logic (PHP-dependent)
    (function() { // Keep the IIFE for scope, or remove if not strictly needed inside DOMContentLoaded
      <?php if($this->is('index')): ?>
      try { 
          var sHeader = document.getElementById('s-header');
          if (sHeader) sHeader.focus();
      } catch(e) { console.error("Error focusing on #s-header:", e); }
      <?php else: // Not index page, so it's a post, page, archive, etc. ?>
      try {
          var mainContentArea = document.getElementById('main');
          if (mainContentArea) {
            mainContentArea.setAttribute('tabindex', -1); // Make it programmatically focusable
            mainContentArea.focus();
          }
      } catch(e) { console.error("Error focusing on #main:", e); }
      <?php endif; ?>
    })();
  });
</script>

<script type="text/javascript" src="<?php $this->options->themeUrl('js/main.js'); ?>" defer></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/accessibility.js'); ?>" defer></script>
<?php $this->footer(); ?>
</body>
</html>