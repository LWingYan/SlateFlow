<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/* Haze核心文件 */
require_once("Core/core.php");

function themeConfig($form){
    
    $index_img = new Typecho_Widget_Helper_Form_Element_Text('index_img', NULL, NULL, _t('全局 IMG 地址'), _t('在这里填入一个图片 URL 地址, 以在网站侧栏博主部和全局添加 IMG'));
    $form->addInput($index_img);
    
    
    
}