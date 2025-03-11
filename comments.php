<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments" class="">
    <?php $this->comments()->to($comments); ?>
    <!--自定义评论函数-->
    <div style="color:var(--text-secondary);" class="my-3 flex gap-2 items-center">
        <svg class="icon" style="width:1.5em;height:1.5em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3976"><path d="M521.2672 922.112c-6.6048 0-13.1584-2.0992-18.688-6.2976-14.2848-10.9056-28.2624-26.1632-43.0592-42.2912-15.7184-17.152-39.5264-43.0592-51.6096-46.2848-175.5648-46.5408-298.1888-197.376-298.1888-366.848 0-210.3808 184.6272-381.5424 411.5456-381.5424s411.5456 171.1616 411.5456 381.5424c0 165.5808-113.9712 311.3472-283.5968 362.752-15.2064 4.608-38.2464 27.392-58.5728 47.4624-16.7936 16.5888-34.1504 33.7408-51.8144 46.0288a30.56128 30.56128 0 0 1-17.5616 5.4784z m0-781.7728c-193.0752 0-350.1056 143.616-350.1056 320.1024 0 141.6704 103.8336 268.0832 252.5184 307.5072 29.44 7.8336 55.7568 36.4032 81.152 64.1024 5.9392 6.4512 11.9296 13.0048 17.664 18.8928 8.192-7.424 16.64-15.7696 24.9856-24.0128 26.624-26.3168 54.1696-53.504 83.968-62.5152 143.5136-43.4688 239.9744-165.632 239.9744-303.9232-0.0512-176.5888-157.0816-320.1536-350.1568-320.1536z" fill="var(--text-secondary)" p-id="3977"></path><path d="M397.7728 438.1184m-48.0256 0a48.0256 48.0256 0 1 0 96.0512 0 48.0256 48.0256 0 1 0-96.0512 0Z" fill="var(--text-secondary)" p-id="3978"></path><path d="M640.9216 438.1184m-48.0256 0a48.0256 48.0256 0 1 0 96.0512 0 48.0256 48.0256 0 1 0-96.0512 0Z" fill="var(--text-secondary)" p-id="3979"></path></svg>
        <?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?>
    </div>
     <!--评论列表开始-->
    <?php if ($comments->have()): ?>
    <?php function threadedComments($comments, $options) {
            $commentClass = '';
            if ($comments->authorId) {
                    if ($comments->authorId == $comments->ownerId) {
                        $commentClass .= ' comment-by-author';
                    } else {
                        $commentClass .= ' comment-by-user';
                    }
                }
            $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="my-3 comment-body<?php if ($comments->levels > 0) { echo ' comment-child';$comments->levelsAlt(' comment-level-odd', ' comment-level-even');} else {echo ' comment-parent';}
        $comments->alt(' comment-odd', ' comment-even');
        echo $commentClass;
        ?>">
        <div id="<?php $comments->theId(); ?>">
            <div class="flex gap-2 comment-author items-center">
                <img width="35" height="35" class="avatar lazyload rounded-full border-light-gray lazyloaded" src="<?php _getAvatarLazyload() ?>" data-src="<?php _getAvatarByMail($comments->mail); ?>" alt="头像" />
                <div class="comment-info gap-2 flex flex-col">
                    <div class="fn DarkB">
                        <?php $comments->author(); ?>
                        <?php if ($comments->status === "waiting") : ?>
                            <em class="waiting">（正在审核中...）</em>
                        <?php endif; ?>
                    </div>
                    <div class="comment-info-bottom">
                        <span><?php $comments->date('Y-m-d H:i'); ?></span>
                        <span class="comment-reply"><?php $comments->reply(); ?></span>       
                    </div>
                </div>
            </div>
            <?php if ($comments->status === "waiting") : ?>
            <div class="p-waiting"><?php $comments->content(); ?><p>提醒：该评论已提交审核，审核通过才会显示。</p></div>
            <?php else: ?>
            <div class="comments-content">
                <?php $comments->content(); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
        <?php } ?>
    </li>
    <?php } ?>

    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('', ''); ?>

    <?php
        // 获取当前页面的文章 CID
        $cid = $this->cid;
        // 查询当前页面的评论总数
        // 查询当前页面的评论总数，只查询 parent 为 0 的评论
        $comment_count = $this->db->fetchRow($this->db->select('COUNT(*) AS count')->from('table.comments')
            ->where('cid = ?', $cid)
            ->where('status = ?', 'approved')
            ->where('parent = ?', 0))['count'];//只查询父级评论，否则会导致分页存在问题
            
        if($comment_count > 6)://注意 这里的数字一定要与主题设置中分页显示的评论数一致，换言之 如果评论数有下一页 则显示加载更多按钮?>
        
        <!-- 添加一个按钮用来加载下一页评论 -->
        <div class="center flex justify-center">
            <button id="load-more-comments">
                <svg class="icon comment-icon" style="width:1.2em;height: 1.2em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6733"><path d="M600.32 498.432H988.16c-82.688-115.2-194.048-232.96-308.736-232.96h-150.272V427.52c0 39.168 31.744 70.912 71.168 70.912z m-339.968-153.856v150.272H422.4c39.424 0 71.168-31.744 71.168-71.168V35.84c-115.456 82.944-233.216 194.304-233.216 308.736z m158.464 186.112H30.72c82.688 115.2 194.048 232.96 308.736 232.96h150.272V601.6c0-39.168-31.744-70.912-70.912-70.912z m106.752 74.752V993.28c115.2-82.688 232.96-194.048 232.96-308.736v-150.272H596.48c-39.168 0-70.912 31.744-70.912 71.168z m0 0" p-id="6734"></path></svg>
                <span class="comment-lable">查看更多</span>
            </button>
        </div>
        <?php endif; ?>
        <!-- 添加一个用于显示提示信息的元素 -->
        <div class="flex justify-center center">
            <div id="no-more-comments" style="display: none;">— 已显示全部评论 —</div>
         </div>

    <?php endif; ?>
    
    <!--评论列表end-->
    
    
    <!--评论输入框-->

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
    	    
    	        <div class="my-3 flex flex-col gap-2">
                    <div class="comment-textarea">
                         <textarea placeholder="请输入留言内容..." style="min-height:100px;" rows="3" cols="50" name="text" id="textarea" class="textarea Comment_Textarea w-full p-2 rounded" required ><?php $this->remember('text'); ?></textarea>
                    </div>
                    <div id="emoji" class="comment-emoji">
    					<div class="emoji-icons no-scrollbar"><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😀')">😀</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😃')">😃</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😄')">😄</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😁')">😁</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😆')">😆</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😅')">😅</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤣')">🤣</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😂')">😂</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🙂')">🙂</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🙃')">🙃</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😉')">😉</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😊')">😊</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😇')">😇</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🥰')">🥰</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😍')">😍</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤩')">🤩</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😘')">😘</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😗')">😗</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😚')">😚</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😙')">😙</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😋')">😋</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😛')">😛</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😜')">😜</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤪')">🤪</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😝')">😝</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤑')">🤑</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤗')">🤗</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤭')">🤭</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤫')">🤫</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤔')">🤔</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤐')">🤐</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤨')">🤨</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😐')">😐</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😑')">😑</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😶')">😶</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😏')">😏</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😒')">😒</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🙄')">🙄</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😬')">😬</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤥')">🤥</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😌')">😌</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😔')">😔</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😪')">😪</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤤')">🤤</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😴')">😴</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😷')">😷</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤒')">🤒</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤕')">🤕</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤢')">🤢</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤮')">🤮</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤧')">🤧</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🥵')">🥵</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🥶')">🥶</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🥴')">🥴</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😵')">😵</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤯')">🤯</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤠')">🤠</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🥳')">🥳</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😎')">😎</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤓')">🤓</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🧐')">🧐</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😕')">😕</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😟')">😟</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🙁')">🙁</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '☹️')">☹️</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😮')">😮</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😯')">😯</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😲')">😲</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😳')">😳</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🥺')">🥺</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😦')">😦</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😧')">😧</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😨')">😨</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😰')">😰</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😥')">😥</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😢')">😢</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😭')">😭</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😱')">😱</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😖')">😖</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😣')">😣</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😞')">😞</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😓')">😓</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😩')">😩</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😫')">😫</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🥱')">🥱</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😤')">😤</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😡')">😡</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '😠')">😠</span><span onclick="$('textarea.Comment_Textarea').val($('textarea.Comment_Textarea').val() + '🤬')">🤬</span>
    					</div>
    					<div class="button emoji-btn icon-add">🖐️</div>
    				</div>
                </div>
    	    
        	    <?php if ($this->user->hasLogin() && isset($this->user->group) && $this->user->group == "administrator"): ?>
                <!-- 用户是管理员时的内容 -->
                <?php else: ?>
                <div class="comment-author-info flex gap-2">
                    <div class="w-full">
                        <label for="author" class="opacity-75 DarkC text-xs"><?php _e('称呼'); ?><span class="required">*</span></label>
                        <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
                    </div>	    
                    <div class="w-full">
                        <label class="opacity-75 DarkC text-xs" for="mail"<?php if ($this->options->commentsRequireMail): ?><?php endif; ?>><?php _e('邮箱'); ?><span class="required">*</span></label>
                        <input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    </div>	
                    <div class="w-full comment-url">
                        <label class="opacity-75 DarkC text-xs" for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?><span class="required">*</span></label>
                        <input type="url" name="url" id="url" class="text" placeholder="<?php _e('https://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="comment-submit flex items-center gap-2 my-3">
                    <div class="submit-right flex gap-2">
                        <button type="submit" class="submit">
                            <svg class="icon" style="width: 1.5009765625em;height: 1.5em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1025 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="10772"><path d="M72.29895 532.543482l239.820905 141.600138 495.512313-452.044774-408.312726 462.713277L725.987257 793.525056l219.012915-707.559842z m327.020492 391.472361L508.208714 793.525056l-108.889272-52.90167z m0 0" fill="rgb(var(--DarkA) / var(--bgA-opacity))" p-id="10773"></path></svg>
                            <sapn id="comment-submit"><?php _e('提交审核'); ?></sapn>
                        </button>
                    </div>
                    <div class="comment-reply-right flex gap-2">
                        <button class="cancel-comment-reply" id="cancel-comment-reply-link"  style="display:none"  onclick="return TypechoComment.cancelReply();">
                            <svg class="icon" style="width: 1.5em;height: 1.5em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="15726"><path d="M329.3 394.3c18.3 0 34.9 11.1 41.9 28.1 7 17.1 3.2 36.7-9.8 49.8-12.9 13.1-32.4 17-49.4 9.9-16.9-7.1-28-23.7-28-42.2 0.1-25.1 20.3-45.5 45.3-45.6zM513.5 394.3c18.3 0 34.9 11.1 41.9 28.1 7 17.1 3.2 36.7-9.8 49.8-12.9 13.1-32.4 17-49.4 9.9-16.9-7.1-28-23.7-28-42.2 0.1-25.1 20.3-45.5 45.3-45.6zM697.7 394.3c18.3 0 34.9 11.1 41.9 28.1 7 17.1 3.2 36.7-9.8 49.8-12.9 13.1-32.4 17-49.4 9.9-16.9-7.1-28-23.7-28-42.2 0.1-25.1 20.3-45.5 45.3-45.6zM600.4 686.7v-2.3H486.6c-7.1 0-13.9 2.5-19.3 7.2L341.8 799.1v-89.3c0-14-11.4-25.4-25.4-25.4H178.9v-480h668v315c18.6 7.4 35.7 17.8 50.7 30.7V195.8c0-22-18-40-40-40h-688c-22 0-40 18-40 40v500c0 22 18 40 40 40h122.9V843c0 20.8 23.9 32.6 40.4 19.9l165.8-127.2h108.6c-4.5-15.5-6.9-32-6.9-49zM852 646.3l-113 113c-7.8 7.8-20.9 7.5-29-0.7-8.2-8.2-8.5-21.2-0.7-29l113-113c7.8-7.8 20.9-7.5 29 0.7 8.2 8.1 8.5 21.2 0.7 29zM822.3 759.4l-113-113c-7.8-7.8-7.5-20.9 0.7-29 8.2-8.2 21.2-8.5 29-0.7l113 113c7.8 7.8 7.5 20.9-0.7 29-8.1 8.2-21.2 8.5-29 0.7zM780.7 518c-93.9 0-170 76.1-170 170s76.1 170 170 170 170-76.1 170-170-76.1-170-170-170z m0 300c-71.8 0-130-58.2-130-130s58.2-130 130-130 130 58.2 130 130-58.2 130-130 130z" p-id="15727"></path></svg>
                            <sapn id="comment-reply">取消回复</sapn>
                        </button>
                    </div>
                </div>
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>