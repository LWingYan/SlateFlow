<?php
/**
 * 友链
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('Public/Include.php');
$this->need('Public/Header.php');
?>

<div class="layout-container">
    <?php $this->need('Public/Sidebar.php');?>
    <main class="articles links">
        <div class="links_grid">
            <?php
                  $mypattern = <<<eof
                  <a href="{url}" target="_blank" alt="{name}" class="links__item">
                    <img src="<?php _getLazyload() ?>" data-src="{image}" alt="头像" class="avatar lazyload" width="40px" height="40px">
                    <span class="title" alt="头像">{name}</span>
                    <p class="description" alt="介绍">{description}</p>
                  </a>
eof;
            Links_Plugin::output($mypattern, 0, "");
            ?>
        </div>
        <div class="friend__description">
            <article class="entry__layout formatted-content">
                <?php echo parseMarkTags($this->content); ?>
            </article>
            <div class="Page_friend__sticky">
                <div class="xm_link" role="form">
                        <form action="/link_xm" method="post">
                            <!-- 隐藏的反爬虫陷阱 -->
                            <input 
                                type="text" 
                                id="anti_spam_field" 
                                name="website" 
                                style="display:none !important;" 
                                autocomplete="off"
                            >
                            
                            <div class="item">
                                <label for="name">网站名称:</label>
                                <input type="text" id="name" name="name" required>
                        
                                <label for="url">网站地址:</label>
                                <input type="url" id="url" name="url" required>
                            </div>
                            
                            <div class="item">
                                <label for="email">友链邮箱:</label>
                                <input type="email" id="email" name="email" required>
                                
                                <label for="image">友链图片:</label>
                                <input type="text" id="image" name="image" required>
                            </div>
                            
                            <div class="item captcha">
                                <label for="description">网站描述:</label>
                                <textarea id="description" name="description"></textarea>
                                <!-- 算术验证 -->
                                <label>验证：3 + 5 = </label>
                                <input style="max-width: 50px;" type="text" id="captcha_input" required>
                                
                            </div>
                            
                            <button type="submit" id="submit" class="submit">
                                <span>提交友链</span>
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </main>
</div>
<?php $this->need('Footer.php');?>