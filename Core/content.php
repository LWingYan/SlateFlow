<?php
function parseMarkTags($content) {
    
    // ====== 安全转义处理 ======
    $escape = function ($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    };
    
    // ====== 自定义标签解析 ======
    // ====== 处理 复选框 标签 ======
    $content = strtr($content, array(
        "{x}" => '✅',
        "{ }" => '☑️'
    ));
    
    // ====== 处理 {mark} 标签 ======
    $content = preg_replace_callback(
        '/\{mark\s+color="([^"]+)"\s+content="([^"]+)"\}/i',
        function ($matches) use ($escape) {
            return '<mark style="color: ' . $escape($matches[1]) . ';">' . $escape($matches[2]) . '</mark>';
        },
        $content
    );

    // ====== 处理 本地音乐 标签 ======
    $content = preg_replace_callback(
        '/\{music\s+musicCover="([^"]+)"\s+musicName="([^"]+)"\s+musicAuthor="([^"]+)"\s+musicLinks="([^"]+)"\}/i',
        function ($matches) use ($escape) {
            return 
                '<div class="custom-block music-player">' .
                    '<div class="cover player_cover">' .
                        '<img class="lazyload" src="' . $escape($matches[1]) . '" alt="' . $escape($matches[2]) . ' - ' . $escape($matches[3]) . '">' .
                    '</div>' .
                    '<div class="info player_meta">' .
                        '<div class="title">'.
                            '<span class="title">' . $escape($matches[2]) . '</span>' .
                            '<span class="author">' . $escape($matches[3]) . '</span>' .
                        '</div>'.
                        '<a class="play_btn" data-music="' . $escape($matches[4]) . '">'.
                            '<svg class="icon" style="width:2em;height:2em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3994"><path d="M513 61c249.08 0 451 201.92 451 451S762.08 963 513 963 62 761.08 62 512 263.92 61 513 61z m-72.752 266.918c-20.82 0-37.697 16.94-37.697 37.837v301.69c0 7.35 2.132 14.54 6.137 20.692 11.386 17.495 34.746 22.413 52.176 10.985L688.25 550.037a39.865 39.865 0 0 0 11.552-11.595c12.019-18.467 6.847-43.216-11.552-55.279L460.864 334.078a37.597 37.597 0 0 0-20.616-6.16z" fill="#020202" p-id="3995"></path></svg>'.
                        '</a>'.
                        '<div class="play_bg">' .
                            '<img class="lazyload" src="' . $escape($matches[1]) . '" alt="' . $escape($matches[2]) . ' - ' . $escape($matches[3]) . '">' .
                        '</div>' .
                    '</div>' .
                '</div>';
        },
        $content
    );
    
    // ====== 处理 官方音乐/视频 标签 ======
    $content = preg_replace_callback(
        // 匹配音乐和视频的正则表达式
        '/\{(music|video)\s+type="([^"]+)"\s+(musicid|id|url)="([^"]+)"\}/i',
        function ($matches) {
            $mediaType = htmlspecialchars($matches[1], ENT_QUOTES); // 媒体类型（music 或 video）
            $type = htmlspecialchars($matches[2], ENT_QUOTES); // 平台类型
            $idOrUrl = htmlspecialchars($matches[4], ENT_QUOTES); // 音乐 ID 或视频 ID/URL
    
            // 处理音乐
            if ($mediaType === 'music') {
                if ($type === 'netease') {
                    return 
                        '<div class="custom-block media-player thyuu-music lazyload" data-type="netease" data-id="' . $idOrUrl . '">' .
                            '<iframe src="https://music.163.com/outchain/player?type=2&id=' . $idOrUrl . '&height=66" allowtransparency="true"></iframe>' .
                        '</div>';
                } elseif ($type === 'qq') {
                    return 
                        '<div class="custom-block media-player thyuu-music lazyload" data-type="qq" data-id="' . $idOrUrl . '">' .
                            '<iframe src="https://i.y.qq.com/n2/m/outchain/player/index.html?songid=' . $idOrUrl . '" allowtransparency="true"></iframe>' .
                        '</div>';
                } else {
                    return ''; // 其他音乐类型暂不支持
                }
            }
            // 处理视频
            elseif ($mediaType === 'video') {
                if ($type === 'local') {
                    return 
                        '<thyuu-embed class="custom-block media-player thyuu-video lazyload" id="myIframe" data-type="local">' .
                            '<video controls style="width: 100%;">' .
                                '<source src="' . $idOrUrl . '" type="video/mp4">' .
                                '您的浏览器不支持视频播放' .
                            '</video>' .
                        '</thyuu-embed>';
                } elseif ($type === 'douyin') {
                    return 
                        '<thyuu-embed class="custom-block media-player thyuu-video lazyload" data-type="douyin" data-id="' . $idOrUrl . '">' .
                            '<iframe src="https://open.douyin.com/player/video?vid=' . $idOrUrl . '" loading="lazy" scrolling="no" referrerpolicy="unsafe-url" allow="autoplay; encrypted-media" allowtransparency="true" allowfullscreen="true"></iframe>' .
                        '</thyuu-embed>';
                } elseif ($type === 'bilibili') {
                    return 
                        '<thyuu-embed class="custom-block media-player thyuu-video lazyload" data-type="bilibili" data-id="' . $idOrUrl . '">' .
                            '<iframe src="https://www.bilibili.com/blackboard/html5mobileplayer.html?bvid=' . $idOrUrl . '&amp;as_wide=1&amp;danmaku=0&amp;hasMuteButton=1" loading="lazy" scrolling="no" referrerpolicy="unsafe-url" allow="autoplay; encrypted-media" allowtransparency="true" allowfullscreen="true"></iframe>' .
                        '</thyuu-embed>';
                } else {
                    return ''; // 其他视频类型暂不支持
                }
            }
            return ''; // 其他媒体类型暂不支持
        },
        $content
    );
    
    
    
    // ====== 处理 {photos} 包裹的图片 ======
    $content = preg_replace_callback(
        '/\{photos\}(.*?)\{\/photos\}/is',
        function ($matches) {
            // 移除所有 <br> 标签
            $cleaned = preg_replace('/<br\s*\/?>/i', '', $matches[1]);
            // 转换为 gallery 容器
            return '<div class="custom-block photo-gallery">' . $cleaned . '</div>';
        },
        $content
    );

    // ====== 处理普通图片 ======
    $content = preg_replace_callback(
        '/(<img\s[^>]*?>)/i',
        function ($matches) {
            // 检查图片是否已被包裹
            if (preg_match('/<div[^>]*class="[^"]*img_container[^"]*"[^>]*>/i', $matches[0])) {
                return $matches[0]; // 已被包裹，直接返回
            }
            // 添加容器
            return '<div class="custom-block img_container">' . $matches[1] . '</div>';
        },
        $content
    );
    
    // ====== 处理 {panel} 标签 ======
    $content = preg_replace_callback(
        '/\{panel\s+color="([^"]+)"\s+title="([^"]+)"\}(.*?)\{\/panel\}/is',
        function ($matches) {
            $color = htmlspecialchars($matches[1], ENT_QUOTES); // 转义颜色
            $title = htmlspecialchars($matches[2], ENT_QUOTES); // 转义标题
            $content = htmlspecialchars($matches[3], ENT_QUOTES); // 转义内容
            return 
                '<div class="custom-block pandastudio-panel" style="box-shadow: 0 2px 2px rgb(' . $color . ' / .2); border: 1px solid rgba(' . $color . ');">' .
                    '<div class="title" style="color: rgba(' . $color . '); background: rgba(' . $color . ' / .2); border-bottom: 1px solid rgba(' . $color . ');">' . $title . '</div>' .
                    '<div class="nv-blocks content">' . $content . '</div>' .
                '</div>';
        },
        $content
    );
    
    // ====== 处理 {tip} 标签 ======
    $content = preg_replace_callback(
        '/\{tip\s+color="([^"]+)"\s+content="([^"]+)"\}/i',
        function ($matches) {
            $color = htmlspecialchars($matches[1], ENT_QUOTES); // 转义颜色
            $content = htmlspecialchars($matches[2], ENT_QUOTES); // 转义内容
            return '<div class="custom-block toast ' . $color . '">' . $content . '</div>';
        },
        $content
    );
    
    // ====== 处理 {prompt} 标签 ======
    $content = preg_replace_callback(
        '/\{prompt\s+color="([^"]+)"\}(.*?)\{\/prompt\}/is',
        function ($matches) {
            $color = htmlspecialchars($matches[1], ENT_QUOTES); // 转义颜色
            $content = htmlspecialchars($matches[2], ENT_QUOTES); // 转义内容
            return 
                '<div class="custom-block prompt ' . $color . '">' .
                    '<div class="flex items-center">' .
                        '<div class="icon ' . $color . '"></div>' .
                        '<b>提示</b>' .
                    '</div>' .
                    '<div class="w-full content">' . $content . '</div>' .
                '</div>';
        },
        $content
    );
    
    // ====== 处理 {div class="slick"} 包裹的图片 ======
    $content = preg_replace_callback(
        '/\{div\s+class="slick"\}(.*?)\{\/div\}/is',
        function ($matches) {
            // 移除所有 <br> 标签
            $cleaned = preg_replace('/<br\s*\/?>/i', '', $matches[1]);
            // 转换为 slick 容器
            return '<div class="custom-block slick">' . $cleaned . '</div>';
        },
        $content
    );

    // 其他自定义标签（如 {video}）可在此追加解析逻辑

    // ====== 智能处理 <p> 标签 ======
    // 规则：移除所有包裹块级元素（如 .custom-block）的 <p> 标签
    $content = preg_replace(
        [
            '/<p>\s*<div class="custom-block([^>]*)">/is',  // 匹配开头 <p>
            '/<\/div>\s*<\/p>/is'                           // 匹配结尾 </p>
        ],
        [
            '<div class="custom-block$1">',                 // 替换为干净的开头
            '</div>'                                         // 替换为干净的结尾
        ],
        $content
    );

    // 移除所有空 <p> 标签
    $content = preg_replace('/<p>\s*<\/p>/i', '', $content);

    return $content;
}
?>