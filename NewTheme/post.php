<?php $this->need('header.php'); ?>
<div id="main" role="main">
  <div class="post">
        <article class="post-entry">
            <header class="entry-header">
                <h1 class="entry-title"><?php $this->title(); ?></h1>
                <div class="entry-meta">
                    <span>作者：<?php $this->author(); ?></span> | 
                    <span>日期：<?php $this->date('Y-m-d'); ?></span> | 
                    <span>分类：<?php $this->category(','); ?></span>
                </div>
            </header>
            
            <div class="entry-content">
                <?php $this->content(); ?>
            </div>
            
            <footer class="entry-footer">
                <div class="post-tags">
                    标签：<?php $this->tags(', ', true, '无标签'); ?>
                </div>
                <nav class="post-navigation">
                    <div class="nav-previous">上一篇：<?php $this->thePrev('%s','没有了'); ?></div>
                    <div class="nav-next">下一篇：<?php $this->theNext('%s','沒有了'); ?></div>
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
            <h2 class="section-title" accesskey="2">相关文章</h2>
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
