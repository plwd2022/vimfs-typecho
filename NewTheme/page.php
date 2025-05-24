<?php $this->need('header.php'); ?>
<div id="main" role="main">
  <div class="post">
        <article class="page-entry">
            <header class="entry-header">
                <h1 class="entry-title"><?php $this->title(); ?></h1>
            </header>
            
            <div class="entry-content">
                <?php $this->content(); ?>
            </div>
        </article>
        
        <?php // Comment out the original audio tag
        /* <audio autoplay="autoplay" src="/usr/themes/VIMFS/res/article.mp3"></audio> */
        ?>
	<?php $this->need('comments.php'); ?>
  </div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>