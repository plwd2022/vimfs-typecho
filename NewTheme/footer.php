</div> <?php // This might be the closing div of site-content or similar ?>
<footer id="footer" role="contentinfo">
  <?php // Removed <script type="text/javascript">startdoing();</script> ?>
  <div id="hspan">
        <div class="copyright-info">
            <?php echo _t('该主题基于 '); ?><a href="http://www.staraudio.net/" target="_blank" rel="nofollow external"><?php echo _t('星之音'); ?></a><?php echo sprintf(_t(' 的主题通过AI二次开发后形成，by %s'), '<a href="https://typecho.org" target="_blank" rel="nofollow external">Typecho</a>'); ?>
        </div>
        <div class="icp-info">
            <a href="https://beian.miit.gov.cn/" target="_blank" rel="nofollow external">宁ICP备 2022000156号</a>
        </div>
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