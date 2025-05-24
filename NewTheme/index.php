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
// <?php /* <audio src="/usr/themes/VIMFS/res/starting.mp3" preload="auto" autoplay="true"></audio> */ ?>
// <?php /* <bgsound src="/usr/themes/VIMFS/res/starting.mp3" loop="1"> */ ?>