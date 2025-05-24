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
            <div class="archive-page">
                <?php if ($this->have()): ?>
                    <header class="archive-header">
                        <h1 class="archive-title" accesskey="2"><?php $this->archiveTitle(array(
                            'category'  =>  _t('分类：%s'),
                            'search'    =>  _t('搜索结果：%s'),
                            'tag'       =>  _t('标签：%s'),
                            'author'    =>  _t('作者：%s')
                            ), '', ''); ?></h1>
                    </header>
                    
                    <div class="post-list archive-post-list">
                        <?php while($this->next()): ?>
                        <article class="post-list-item">
                            <?php if ($this->fields->post_thumbnail): ?>
                                <div class="post-item-thumbnail archive-thumbnail">
                                    <a href="<?php $this->permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <img src="<?php $this->fields->post_thumbnail(); ?>" alt="<?php echo sprintf(_t('%s 的缩略图'), $this->title()); ?>" />
                                    </a>
                                </div>
                            <?php endif; ?>
                            <header class="item-header">
                                <h2 class="item-title"><a href="<?php $this->permalink() ?>" accesskey="3"><?php $this->title() ?></a></h2>
                                <div class="item-meta">
                                    <span><?php echo _t('发布于'); ?> <?php $this->date('Y-m-d'); ?></span>
                                    <?php if ($this->is('post')): // Only show author and category for actual posts, not all archive types ?>
                                    | <span><?php echo _t('作者'); ?> <?php $this->author(); ?></span>
                                    | <span><?php echo _t('分类于'); ?> <?php $this->category(','); ?></span>
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
                        <p><?php echo _t('抱歉，没有找到相关内容。'); ?></p>
                    </div>
                <?php endif; ?>

                <?php $this->pageNav(_t('&laquo; 上一页'), _t('下一页 &raquo;')); ?>
            </div><?php // .archive-page ?>
        </div><?php // #main ?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
<?php 
        // Comment out the original audio tag
        /* <audio autoplay="autoplay" src="/usr/themes/VIMFS/res/article.mp3"></audio> */
?>