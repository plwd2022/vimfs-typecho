<div id="rightbar" role="complementary">
    <div class="sidebar-inner">

        <?php // 1. Search Widget ?>
        <aside class="widget widget_search">
            <h2 class="widget-title" accesskey="2">站内搜索</h2>
            <form method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                <label for="s" class="sr-only">搜索关键字</label>
                <input type="text" name="s" id="s" class="text" placeholder="输入关键字搜索..." />
                <button type="submit" class="submit">搜索</button>
            </form>
        </aside>

        <?php // 2. Recent Posts ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_recent_posts">
            <h2 class="widget-title" accesskey="2">最新文章</h2>
            <ul class="widget-list">
                <?php $this->widget('Widget_Contents_Post_Recent')->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
            </ul>
        </aside>
        <?php endif; ?>

        <?php // 3. Recent Comments ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_recent_comments">
            <h2 class="widget-title" accesskey="2">最近回复</h2>
            <ul class="widget-list">
                <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
                <?php while($comments->next()): ?>
                    <li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?>:</a> <?php $comments->excerpt(35, '...'); ?></li>
                <?php endwhile; ?>
            </ul>
        </aside>
        <?php endif; ?>

        <?php // 4. Categories ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_categories">
            <h2 class="widget-title" accesskey="2">文章分类</h2>
            <ul class="widget-list">
                <?php $this->widget('Widget_Metas_Category_List')->parse('<li><a href="{permalink}">{name}</a> ({count})</li>'); ?>
            </ul>
        </aside>
        <?php endif; ?>

        <?php // 5. Archives ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_archive">
            <h2 class="widget-title" accesskey="2">文章归档</h2>
            <ul class="widget-list">
                <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y年m月')->parse('<li><a href="{permalink}">{date}</a> ({count})</li>'); ?>
            </ul>
        </aside>
        <?php endif; ?>
        
        <?php // 6. Friendly Links (ShowOther) ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
        <aside class="widget widget_links">
            <h2 class="widget-title" accesskey="2">友情链接</h2>
            <ul class="widget-list">
                <?php // These are typically managed via theme options or a plugin in more advanced themes.
                      // For now, replicating the hardcoded links from the original index.php as an example.
                      // Users would need to edit this PHP directly or we'd need a new theme option for these.
                ?>
                 <li><a href="http://www.staraudio.net/" target="_blank">星之音</a></li>
                 <li><a href="http://www.typecho.org" target="_blank">Typecho</a></li>
                <?php // Add more links here if needed ?>
            </ul>
        </aside>
        <?php endif; ?>

    </div><?php // .sidebar-inner ?>
</div><?php // #rightbar ?>
