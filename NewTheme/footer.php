</div>
<div id="footer">
  <?php // <script type="text/javascript">startdoing();</script> // Removed as startdoing() is called from main.js ?>
  <div id="hspan">
    <div class="icp-info"><?php _e('备案号预留区域'); ?> (ICP License placeholder)</div>
  </div>
</div>

<script type="text/javascript">
  // Initial page focus logic (PHP-dependent)
  (function() {
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
  })();
</script>

<script type="text/javascript" src="<?php $this->options->themeUrl('js/main.js'); ?>" defer></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/accessibility.js'); ?>" defer></script>
<?php $this->footer(); ?>
</body>
</html>