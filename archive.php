<?php $this->need('header.php'); ?>
<div id="main">
  <div class="post">
    <?php if ($this->have()): ?>
      <ul class="widget-list">
        <h2 id="autord" class="widget-title" accesskey="z" tabindex="0"><?php $this->archiveTitle(array(
        'category'  =>  _t('分类 %s 下的文章'),
        'search'  =>  _t('包含关键字 %s 的文章'),
        'tag'     =>  _t('标签 %s 下的文章'),
        'author'  =>  _t('%s 发布的文章')
        ), '', ''); ?></h2>
        <?php while($this->next()): ?>
          <li><a accesskey="x" href="<?php $this->permalink() ?>"><?php $this->title() ?></a><span><?php $this->date('Y-m-d'); ?></span></li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p><?php _e('没有找到内容'); ?></p>
    <?php endif; ?>
    <?php $this->pageNav('上一页', '下一页'); ?>
  </div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
<audio autoplay="autoplay" src="/usr/themes/VIMFS/res/article.mp3"></audio>