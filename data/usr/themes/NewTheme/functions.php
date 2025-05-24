<?php
function themeConfig($form) {
  $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, '站点LOGO地址', '在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO');
  $form->addInput($logoUrl);
  $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
  array('ShowRecentPosts' => '最新文章',
  'ShowRecentComments' => '最近回复',
  'ShowCategory' => '文章分类',
  'ShowArchive' => '文章归档'),
  array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive'), '侧边栏显示');
  $form->addInput($sidebarBlock->multiMode());

  $defaultOgpImage = new Typecho_Widget_Helper_Form_Element_Text(
      'defaultOgpImage',
      NULL,
      NULL,
      '默认OGP分享图片URL', 
      '设置一个默认的图片URL，用于文章/页面没有指定缩略图时，在社交媒体上分享时显示。建议尺寸1200x630像素。'
  );
  $form->addInput($defaultOgpImage);
}

/**
 * Define custom fields for posts and pages.
 *
 * @param Typecho_Widget_Helper_Layout $layout
 */
function themeFields(Typecho_Widget_Helper_Layout $layout) {
    $post_thumbnail = new Typecho_Widget_Helper_Form_Element_Text(
        'post_thumbnail', // Field name
        NULL,             // Options (for select/radio)
        NULL,             // Default value
        '文章缩略图 URL', // Label (Hardcoded Chinese)
        '输入文章缩略图的完整URL地址。将显示在文章列表和文章顶部（如果主题支持）。' // Help text (Hardcoded Chinese)
    );
    $layout->addItem($post_thumbnail); // Add to all layout types (post, page)
}
?>