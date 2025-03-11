<?php
/* 公用函数 */
require_once('function.php');
// 写作功能
require_once('content.php');

/* 主题初始化 */
function themeInit($self)
{
    // 强制评论关闭反垃圾保护
    Helper::options()->commentsAntiSpam = false;
    /* 强制用户要求填写邮箱 */
    Helper::options()->commentsRequireMail = true;
    /* 强制用户要求无需填写url */
    Helper::options()->commentsRequireURL = false;
    /* 强制用户开启评论回复 */
    Helper::options()->commentsThreaded = true;
    /* 强制回复楼层最高2层 */
    Helper::options()->commentsMaxNestingLevels = 2;
}
