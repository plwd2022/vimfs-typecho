<div id="rightbar">
<div class="post">
  <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
    <ul class="widget-list">
      <h2 class="widget-title" accesskey="z" tabindex="0"><?php _e('最新文章'); ?></h2>
      <?php $this->widget('Widget_Contents_Post_Recent')->parse('<li><a href="{permalink}" target="_blank">{title}</a></li>'); ?>
    </ul>
  <?php endif; ?>
  <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
    <ul class="widget-list">
      <h2 class="widget-title" accesskey="z" tabindex="0"><?php _e('最近回复'); ?></h2>
    <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
    <?php while($comments->next()): ?>
      <li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>：<?php $comments->excerpt(35, '...'); ?></li>
    <?php endwhile; ?>
    </ul>
  <?php endif; ?>
  <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
    <ul class="widget-list">
      <h2 class="widget-title" accesskey="z" tabindex="0"><?php _e('分类'); ?></h2>
      <?php $this->widget('Widget_Metas_Category_List')->parse('<li><a href="{permalink}">{name}</a> ({count})</li>'); ?>
    </ul>
  <?php endif; ?>
  <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
    <ul class="widget-list">
      <h2 class="widget-title" accesskey="z" tabindex="0"><?php _e('归档'); ?></h2>
      <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y年m月')->parse('<li><a href="{permalink}">{date}</a> ({count})</li>'); ?>
    </ul>
  <?php endif; ?>
</div>
</div>