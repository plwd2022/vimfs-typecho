<?php $this->need('header.php'); ?>
<div id="main" role="main">
  <div class="post">
        <article class="post-entry">
            <header class="entry-header">
                <h1 class="entry-title"><?php $this->title(); ?></h1>
                <div class="entry-meta">
                    <span><?php _e('By: '); ?><?php $this->author(); ?></span> | 
                    <span><?php _e('Date: '); ?><?php $this->date('Y-m-d'); ?></span> | 
                    <span><?php _e('Category: '); ?><?php $this->category(','); ?></span>
                </div>
            </header>
            
            <div class="entry-content">
                <?php $this->content(); ?>
            </div>
            
            <footer class="entry-footer">
                <div class="post-tags">
                    <?php _e('Tags: '); ?><?php $this->tags(', ', true, 'None'); ?>
                </div>
                <nav class="post-navigation">
                    <div class="nav-previous"><?php _e('Previous: '); $this->thePrev('%s','None'); ?></div>
                    <div class="nav-next"><?php _e('Next: '); $this->theNext('%s','None'); ?></div>
                </nav>
            </footer>
        </article>
        
        <?php // Comment out the original audio tag
        /* <audio autoplay="autoplay" src="/usr/themes/VIMFS/res/article.mp3"></audio> */
        ?>

        <?php // Related Posts
        $this->related(5)->to($relatedPosts); 
        if ($relatedPosts->have()):
        ?>
        <section class="related-posts">
            <h2 class="section-title" accesskey="2"><?php _e('Related Articles'); ?></h2>
            <ul class="widget-list">
                <?php while ($relatedPosts->next()): ?>
                <li><a href="<?php $relatedPosts->permalink(); ?>"><?php $relatedPosts->title(); ?></a><span><?php $relatedPosts->date('Y-m-d'); ?></span></li>
                <?php endwhile; ?>
            </ul>
        </section>
        <?php endif; ?>
    <?php $this->need('comments.php'); ?>
  </div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
