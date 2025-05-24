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