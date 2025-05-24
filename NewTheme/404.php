<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="main">
  <div class="post">
    <h2 class="post-title" id="autord" role="tab" tabindex="0" accesskey="x"><?php echo _t('404 - 页面未找到'); ?></h2>
    <div class="post-content">
        <p><?php echo _t('抱歉，您要查看的页面已被转移或不存在！也许可以试试搜索？'); ?></p>
    </div>
    <form method="post" action="<?php $this->options->siteUrl(); ?>" role="search"> <?php // Added siteUrl action and role ?>
        <p><input type="text" name="s" class="text" autofocus /></p>
        <p><button type="submit" class="submit"><?php echo _t('搜索'); ?></button></p>
    </form>
  </div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>