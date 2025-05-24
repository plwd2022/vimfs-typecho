<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
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
    <div class="site-stats">
      <?php \Widget\Stat::alloc()->to($stat); ?>
      <div class="eeyinfo" accesskey="2" tabindex="0"><?php _e(_t('自 2021 年 建立网站以来，我们已经创建了 %s 个分类，共发布了 %s 篇文章，并收到了 %s 条相关评论。'), $stat->categoriesNum, $stat->publishedPostsNum, $stat->publishedCommentsNum); ?></div>
    </div>
    <?php \Widget\Metas\Category\Rows::alloc()->to($categories); ?>
    <?php while($categories->next()): ?>
      <section class="category-section">
        <?php \Widget\Archive::alloc(['pageSize' => 10, 'type' => 'category', 'mid' => $categories->mid])->to($categoryPosts); ?>
        <h2 class="widget-title"><a accesskey="2" href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?></a></h2>
        <ul class="widget-index-list">
          <?php while($categoryPosts->next()): ?>
            <li class="post-item-with-thumbnail" itemscope itemtype="http://schema.org/BlogPosting">
                <?php if ($categoryPosts->fields->post_thumbnail): ?>
                    <div class="post-item-thumbnail">
                        <a href="<?php $categoryPosts->permalink(); ?>" aria-hidden="true" tabindex="-1">
                            <img src="<?php $categoryPosts->fields->post_thumbnail(); ?>" alt="<?php echo sprintf(_t('%s 的缩略图'), $categoryPosts->title()); ?>" itemprop="image"/>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="post-item-content">
                    <h3 class="post-item-title" itemprop="name headline"><a accesskey="3" itemprop="url" href="<?php $categoryPosts->permalink() ?>"><?php $categoryPosts->title() ?></a></h3>
                    <span class="post-item-date"><time datetime="<?php $categoryPosts->date('c'); ?>" itemprop="datePublished"><?php $categoryPosts->date('Y-m-d'); ?></time></span>
                    <?php // Optional: Add excerpt here if desired for index page ?>
                    <?php // <div itemprop="articleBody"> $categoryPosts->excerpt(70, '...'); </div> ?>
                </div>
            </li>
          <?php endwhile; ?>
        </ul>
      </section>
    <?php endwhile; ?>
  </div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>