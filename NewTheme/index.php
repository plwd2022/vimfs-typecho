<?php
/**
 * 这是一个清亮级主题
 * 
 * @package VIMFS
 * @author xy
 * @version 2.0
 * @link http://www.vimfs.com
 */ 
 $this->need('header.php');
 ?>
<div id="main" role="main">
  <div class="post">
    <div class="site-stats">
      <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
      <div class="eeyinfo" accesskey="2" tabindex="0"><?php _e('自 2021 年 建立网站以来，我们已经创建了 %s 个分类，共发布了 %s 篇文章，并收到了 %s 条相关评论。', $stat->categoriesNum, $stat->publishedPostsNum, $stat->publishedCommentsNum); ?></div>
    </div>
    <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
    <?php while($category->next()): ?>
      <section class="category-section">
        <?php $category->widget("Widget_Archive@$category->mid", 'pageSize=10&type=category', "mid= $category->mid")->to($categoryPosts); ?>
        <h2 class="widget-title"><a accesskey="2" href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a></h2>
        <ul class="widget-index-list">
          <?php while($categoryPosts->next()): ?>
            <li><a accesskey="3" href="<?php $categoryPosts->permalink() ?>"><?php $categoryPosts->title() ?></a><span><?php $categoryPosts->date('Y-m-d'); ?></span></li>
          <?php endwhile; ?>
        </ul>
      </section>
    <?php endwhile; ?>
  </div>
</div>
<?php $this->need('sidebar.php'); ?>
<div>
  <div class="post">
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
    <ul class="widget-lists">
      <h2 class="widget-title" accesskey="2" tabindex="0"><?php _e('友情链接'); ?></h2>
      <li><a href="http://www.staraudio.net/" target="_blank">星之音</a></li>
          
	
	</ul>
    <?php endif; ?>
  </div>
</div>
<?php $this->need('footer.php'); ?>
// <?php /* <audio src="/usr/themes/VIMFS/res/starting.mp3" preload="auto" autoplay="true"></audio> */ ?>
// <?php /* <bgsound src="/usr/themes/VIMFS/res/starting.mp3" loop="1"> */ ?>