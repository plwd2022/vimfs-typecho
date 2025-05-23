</div>
<div id="footer">
  <?php // <script type="text/javascript">startdoing();</script> // Removed as startdoing() is called from main.js ?>
  <div id="hspan">
    <div class="icp-info">备案号预留区域 (ICP License placeholder)</div>
  </div>
</div>

<?php // Moved JavaScript includes here, before Typecho's footer hook and closing body tag ?>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/main.js'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('js/accessibility.js'); ?>"></script>

<?php $this->footer(); ?>
</body>
</html>
<?php // The two IIFE script blocks for accesskeys and media player are moved to js/accessibility.js ?>