<?php $this->need('header.php'); ?>
<div id="main" role="main">
            <div class="archive-page">
                <?php if ($this->have()): ?>
                    <header class="archive-header">
                        <h1 class="archive-title" accesskey="2"><?php $this->archiveTitle(array(
                            'category'  =>  _t('Category: %s'),
                            'search'    =>  _t('Search Results for: %s'),
                            'tag'       =>  _t('Tag: %s'),
                            'author'    =>  _t('Author: %s')
                            ), '', ''); ?></h1>
                    </header>
                    
                    <div class="post-list archive-post-list">
                        <?php while($this->next()): ?>
                        <article class="post-list-item">
                            <header class="item-header">
                                <h2 class="item-title"><a href="<?php $this->permalink() ?>" accesskey="3"><?php $this->title() ?></a></h2>
                                <div class="item-meta">
                                    <span><?php _e('On '); ?><?php $this->date('Y-m-d'); ?></span>
                                    <?php if ($this->is('post')): // Only show author and category for actual posts, not all archive types ?>
                                    | <span><?php _e('By '); ?><?php $this->author(); ?></span>
                                    | <span><?php _e('In '); ?><?php $this->category(','); ?></span>
                                    <?php endif; ?>
                                </div>
                            </header>
                            <?php // Add an excerpt for archive pages to make them more informative ?>
                            <div class="item-excerpt">
                                <?php $this->excerpt(120, '...'); // Display a 120-character excerpt ?>
                            </div>
                        </article>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="no-results">
                        <p><?php _e('Sorry, no content found.'); ?></p>
                    </div>
                <?php endif; ?>

                <?php $this->pageNav(_t('&laquo; Previous'), _t('Next &raquo;')); ?>
            </div><?php // .archive-page ?>
        </div><?php // #main ?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
<?php 
        // Comment out the original audio tag
        /* <audio autoplay="autoplay" src="/usr/themes/VIMFS/res/article.mp3"></audio> */
?>