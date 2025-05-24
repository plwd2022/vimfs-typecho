<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="main" role="main">
<?php
    // Breadcrumbs
    echo '<div class="here">';
    echo _t('当前位置：');
    echo ' <a href="' . $this->options->siteUrl . '">' . _t('首页') . '</a>';
    if ($this->is('index')) {
        // Index page, no further breadcrumb
    } elseif ($this->is('category')) {
        echo ' · ';
        $this->category(' · ', false); // Output category links without the final item being a link
    } elseif ($this->is('search')) {
        echo ' · ' . _t('搜索结果：') . $this->getArchiveTitle();
    } elseif ($this->is('tag')) {
        echo ' · ' . _t('标签：') . $this->getArchiveTitle();
    } elseif ($this->is('author')) {
        echo ' · ' . _t('作者：') . $this->getArchiveTitle();
    } elseif ($this->is('archive')) { // Other archives like date
        echo ' · ' . $this->getArchiveTitle();
    }
    // For single posts or pages, show category if applicable, then title
    if ($this->is('post')) {
        $categories = $this->categories;
        if ($categories && count($categories) > 0) {
            echo ' · ';
            $this->category(' · ', true); // Output category links
        }
        echo ' · ' . $this->title;
    } elseif ($this->is('page')) {
        echo ' · ' . $this->title;
    }
    echo '</div>';

    // Description
    echo '<div class="description">';
    if ($this->is('category')) {
        echo $this->getDescription();
    } else if ($this->is('archive') || $this->is('index')) { // Show site description for general archives and index
        echo $this->options->description;
    }
    // For single posts/pages, the main content/excerpt serves as description, so no separate div here.
    echo '</div>';
    ?>
  <div class="post">
        <article class="post-entry" itemscope itemtype="http://schema.org/BlogPosting">
            <header class="entry-header">
                <h1 class="entry-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a></h1>
                <div class="entry-meta">
                    <span itemprop="author" itemscope itemtype="http://schema.org/Person">
                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-author"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <?php echo _t('作者：'); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a>
                    </span> | 
                    <span>
                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-date"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <?php echo _t('日期：'); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time>
                    </span> | 
                    <span>
                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-category"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        <?php echo _t('分类：'); ?><?php $this->category(','); ?>
                    </span>
                </div>
            </header>
            
            <?php if ($this->fields->post_thumbnail): ?>
                <div class="single-post-thumbnail">
                    <img src="<?php $this->fields->post_thumbnail(); ?>" alt="<?php echo sprintf(_t('%s 的缩略图'), $this->title()); ?>" itemprop="image" />
                </div>
            <?php endif; ?>
            
            <div class="entry-content" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
            
            <footer class="entry-footer">
                <div class="post-tags">
                    <?php echo _t('标签：'); ?><span itemprop="keywords"><?php $this->tags(', ', true, _t('无标签')); ?></span>
                </div>
                <nav class="post-navigation">
                    <div class="nav-previous"><?php echo _t('上一篇：'); ?><?php $this->thePrev('%s',_t('没有了')); ?></div>
                    <div class="nav-next"><?php echo _t('下一篇：'); ?><?php $this->theNext('%s',_t('没有了')); ?></div>
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
            <h2 class="section-title" accesskey="2"><?php echo _t('相关文章'); ?></h2>
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
