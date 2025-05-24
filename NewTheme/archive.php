<?php $this->need('header.php'); ?>
<div id="main" role="main">
            <div class="archive-page">
                <?php if ($this->have()): ?>
                    <header class="archive-header">
                        <h1 class="archive-title" accesskey="2"><?php $this->archiveTitle(array(
                            'category'  =>  '分类：%s',
                            'search'    =>  '搜索结果：%s',
                            'tag'       =>  '标签：%s',
                            'author'    =>  '作者：%s'
                            ), '', ''); ?></h1>
                    </header>
                    
                    <div class="post-list archive-post-list">
                        <?php while($this->next()): ?>
                        <article class="post-list-item">
                            <?php if ($this->fields->post_thumbnail): ?>
                                <div class="post-item-thumbnail archive-thumbnail">
                                    <a href="<?php $this->permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <img src="<?php $this->fields->post_thumbnail(); ?>" alt="<?php $this->title(); ?> 的缩略图" />
                                    </a>
                                </div>
                            <?php endif; ?>
                            <header class="item-header">
                                <h2 class="item-title"><a href="<?php $this->permalink() ?>" accesskey="3"><?php $this->title() ?></a></h2>
                                <div class="item-meta">
                                    <span>发布于 <?php $this->date('Y-m-d'); ?></span>
                                    <?php if ($this->is('post')): // Only show author and category for actual posts, not all archive types ?>
                                    | <span>作者 <?php $this->author(); ?></span>
                                    | <span>分类于 <?php $this->category(','); ?></span>
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
                        <p>抱歉，没有找到相关内容。</p>
                    </div>
                <?php endif; ?>

                <?php $this->pageNav('&laquo; 上一页', '下一页 &raquo;'); ?>
            </div><?php // .archive-page ?>
        </div><?php // #main ?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
<?php 
        // Comment out the original audio tag
        /* <audio autoplay="autoplay" src="/usr/themes/VIMFS/res/article.mp3"></audio> */
?>