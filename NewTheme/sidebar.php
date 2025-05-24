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
        
        <?php // "Friendly Links" (ShowOther) block removed ?>

    </div><?php // .sidebar-inner ?>
</div><?php // #rightbar ?>
