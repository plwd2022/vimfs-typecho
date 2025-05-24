<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
  $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
  $form->addInput($logoUrl);
  $sidebarBlock = new \Typecho\Widget\Helper\Form\Element\Checkbox('sidebarBlock', 
  array(
      'ShowRecentPosts'    => _t('最新文章'),
      'ShowRecentComments' => _t('最近回复'),
      'ShowCategory'       => _t('文章分类'),
      'ShowArchive'        => _t('文章归档'),
      'ShowOther'          => _t('显示其它杂项')
  ),
  array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));
  $form->addInput($sidebarBlock->multiMode());

  $defaultOgpImage = new \Typecho\Widget\Helper\Form\Element\Text(
      'defaultOgpImage',
      NULL,
      NULL,
      _t('默认OGP分享图片URL'), 
      _t('设置一个默认的图片URL，用于文章/页面没有指定缩略图时，在社交媒体上分享时显示。建议尺寸1200x630像素。')
  );
  $form->addInput($defaultOgpImage);
}

/**
 * Define custom fields for posts and pages.
 *
 * @param \Typecho\Widget\Helper\Layout $layout
 */
function themeFields(\Typecho\Widget\Helper\Layout $layout) {
    $post_thumbnail = new \Typecho\Widget\Helper\Form\Element\Text(
        'post_thumbnail', // Field name
        NULL,             // Options (for select/radio)
        NULL,             // Default value
        _t('文章缩略图 URL'), // Label (Hardcoded Chinese)
        _t('输入文章缩略图的完整URL地址。将显示在文章列表和文章顶部（如果主题支持）。') // Help text (Hardcoded Chinese)
    );
    $layout->addItem($post_thumbnail); // Add to all layout types (post, page)
}
?>