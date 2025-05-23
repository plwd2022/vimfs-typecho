<?php $this->need('header.php'); ?>
<div id="main">
  <div class="post">
    <h2><?php $this->title() ?></h2>
    	<div class="post-title" id="autord" tabindex="-1" accesskey="x">
	<center>正文：</center>
	<div class="post-content">
      	  <?php $this->content(); ?>
    </div>
	</div>
    		<audio autoplay="autoplay" src="/usr/themes/VIMFS/res/article.mp3"></audio>
	<?php $this->need('comments.php'); ?>
  </div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>