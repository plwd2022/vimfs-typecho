<?php $this->need('header.php'); ?>
<div id="main">
  <div class="post">
  <h2><?php $this->title() ?></h2>
    	
	<div id="wspan" style="text-align:center;border-top:2px solid #666666;padding-top:5px;">
	<div class="post-title" id="autord" tabindex="-1" accesskey="x">
	  <center>正文：</center>
	  
	<div class="post-content">
      </div>
	  <?php $this->content(); ?>
    
    
    <span><?php _e('由 '); ?><?php $this->author(); ?><?php _e(' 于 '); ?><?php $this->date('Y-m-d'); ?><?php _e(' 发表于：'); ?><?php $this->category(','); ?></span>
    </div>
	</div>
		<audio autoplay="autoplay" src="/usr/themes/VIMFS/res/article.mp3"></audio>
	<p class="eeyinfo"><?php $this->tags(', ', true, '没有标签'); ?></p>
    <p>上一篇：<?php $this->thePrev('%s','没有了'); ?><br>下一篇：<?php $this->theNext('%s','没有了'); ?></p>
    <?php $this->related(5)->to($relatedPosts); ?>
    <ul class="widget-list">
      <h2 class="widget-title" accesskey="z" tabindex="0"><?php _e('相关文章'); ?></h2>
      <?php while ($relatedPosts->next()): ?>
      <li><a href="<?php $relatedPosts->permalink(); ?>"><?php $relatedPosts->title(); ?></a><span><?php $relatedPosts->date('Y-m-d'); ?></span></li>
      <?php endwhile; ?>
    </ul>
    <?php $this->need('comments.php'); ?>
  </div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
