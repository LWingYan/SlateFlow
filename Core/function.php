<?php
/* 获取主题当前版本号 */
function _getVersion()
{
  return "1.1";
};

/* 获取资源路径 */
function _getAssets($assets, $type = true)
{
  $assetsURL = "";
  // 是否本地化资源
  if (Helper::options()->AssetsURL) {
    $assetsURL = Helper::options()->AssetsURL . '/' . $assets;
  } else {
    $assetsURL = Helper::options()->themeUrl . '/' . $assets;
  }
  if ($type) echo $assetsURL;
  else return  $assetsURL;
}

/* 获取全局懒加载图 */
function _getLazyload($type = true)
{
  if ($type) echo Helper::options()->Lazyload;
  else return Helper::options()->Lazyload;
}

/* 获取头像懒加载图 */
function _getAvatarLazyload($type = true)
{
  $str = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAMAAAC5zwKfAAAC/VBMVEUAAAD87++g2veg2ff++fmg2feg2fb75uag2fag2fag2fag2fag2feg2vah2fef2POg2feg2vag2fag2fag2fag2fag2vah2fag2vb7u3Gg2fag2fb0tLSg2fb3vHig2ff0s7P2wMD0s7Og2fXzs7Pzs7Of2fWh2veh2vf+/v7///+g2vf9/f2e1/ag2fSg2/mg3PT3r6+30tSh2fb+0Hj76ev4u3P6u3K11dr60H3UyKr+/v766On80Hz49vj2xcXm5u3z0IfUx6v2u7vazKTn0pfi6PKg2fbztLT///+g2faf2fag2vf///+g2feg2fe63O6l3vb///+g2fb80Kb8um+x1uD80Hv86er+0Hf73tb0s7P10YX/0Hiq2Or+/v6g2vbe0qL60YT+/v6y1NzuvoS20dSz09ru0Y6z3fTI1MDbxp+h2fag2fb////O4PDuv4XA3/LOz7bh06Du0o/1t7ex3PP+/v6h2ffSzrLdxZ3s5u3/2qag2fb7+/z40NCg2fb9/f2f2PWf2PX0tLT+/v70s7P+/v7M7Pyf1/b1s7P////zs7P0tbWZ2fL20dH+/v7+0Hep2vWl2O+x2/P+/v641tbI1b7C1cf8xpCz0tj1wMD1x8fTya392KPo0ZT56ez4vXbN1bn26Orh0p3x8/jbxZ/CzcT8xo7327DV1tHt0Y7u8/n759661tLyy6L049710IK8z870s7PX1a3xvX/y6OzA1cvBzsXI1cG30dP+38D73Mn/0oX3ysrpwYzv5+zo0pXv5+zH4PDW4e/n5O3+/v786+vN4vP9/f30s7P9/f2f2fSu0er//Pzgu8X///+4zOD////z8/OW0vCq1f+g2fb86er0s7P+z3f8um/+/v72xcX948ym2O/85+T839D8v3v86ej54eH828X+3Kz80qz8w4T8u3Oq2/Wq1ees2Ob64OCx1d/F2N785tv529v94MH82b/1vb382bj93LD91pf91ZH+04b+0X2p2er+2aH8zJ78yZX8yJU3IRXQAAAA1nRSTlMA8PbEz5vhv1X6Y0wzrX9A8/DJt6mHsnH98uzo4NzY19DJwKGAf3tpZmVVSD86LysgIP787ejn4uHf29jW1M3MysnHxcK+vbywn5ONg39wW0AlIBr8+/f29PTx7+rm5eTj4+Df29nX1tLR0dHQz8zKyMXFxcPCwL+9u7u5t7KsqaObmH1wbWBcVVJQSUAwFA34+Pbz8vHx8O7u7ero6Ofl4ODf3t7d3Nvb2djY19fU1NLS0M/NzcrJycjHx8LCwcHAwL68uraxr5SSkId4X1NTNTItFREGybAGmgAABQNJREFUWMOl13N0HEEcwPFp2lzTpElq20jTpLZt27Zt27Zt27b7m9vbpqlt+3Xvdvd2ZncWufv+e+993t7saJFJ0wL8M1UKjJ4yTpyU0QMrZfIPmIa8qLZ/edBU3r+2Z1pY5qGg09DMYVHmsicCwxJljxIXnABMSxBsmcsxAiw1IoclLtQXLOcbau75tYAo1MLPzMsEUSyTsZceolx6Iy86eFB0fS8ZeFQyPS85eFhythcfPC4+y0sIXpRQ6yUGr0qs9vzBy/xpLwC8LsDghXj/YvzApJdgHrmsB4BuzfaXKVkwT6u6+VL1KNXOEBygeNVBrwJlm3LOlj13OEtV6r6BWN10Cc/rwEl9rOMQy1fIYFGbTZk9Mzm5iEYOubYFTKdOPPa/LckpvccP3WLSUnpgPOkIAVb1CnJEGP9xKHXWE8VDpgowekt5PzD+5CDSG8gqLrALaHvdhCP7hnHkQ1Jcyga7OL3YwGgNR/UUY1yHBOvmYouxdbatBRzdRwF84CBrq7+NpQZN91vR3s9HWOifw3wYUyOUE7St4uh+Y6x5xHzALCeaCNo2q8AI7OoZJbJHcSLKDJp+cepXIhb5nATXMcHMKAg0zedUc0buATl1kjLBIOQLmlqqn08RXxAic+PxRYyL5XLS+4rJnhD/+hXzIsraGYhV8j0C00U+kx7yxd937P3BBprqu5fw10dY04Mnn748exKJMRO0oVhA16l3h40u8ef3L5HYqO2DetXTgLGQD1CVFajDOCIi4j02a6HDkb+NGvRR3ZA4Z0OwlcQtd5Hm3pRSO2GOWvKKiLNRNXlSoq7kLsi5arjVCniEuXt3pU68Thxn/T9vEMGVqpOPWinysVTUgrfDIdVetVKygFIeGTxhDm6SwYEUmIU8AZpxUgN7mnqnIL8EHqfPAPKmflDy8syGwSZe3n4wSAJTUfd36ibXWwJPAtiKGINnANo4pHKTdzrqLrxT9PqAUD9D7ywIHUgqgu2omzF5qDR0eWXB1WkDb7W4XneJw1iGPFLIu9c2J9dU+DkJOCunP4A2EGu/1wn2UN+/RoNYH2G+9PIRPBGEnnnZXom4irA+lSAeArnRiHF1SOIe5DklGNyK7kCV6+2r+8qkYX2C5iZ2yI6DG9BcgxIvLXyYBtNbpAASZDllAj3a130WGBWMpAIpkNpyEwTVrnmh3Ja1xYoVG3atFgqtVl7fC2R/9vj4EFz2kKojeaL+VW/FrhTH/NNnFBP0rZExBq/pfMabVeKyvFFIKcxGgNIYpr6asbFdAh9/XlxRBmPaG2cMDdR6tjACJDexONLjXU9ht8vgG3sK1NoN2u27p1bTgFkQVaAK9Btutysg/jA8K6+AQuP8NG+ErqaNAoOz3ZNBORpMN5YWbTWRKvfvcV0erwKbt6bBvvz4YPrLUVNCBQzKxtPg48/pkBrkswWRd2tGCWQwdY3CIki9FBoszfOFa8R1z1fEzFecNlC9Iq8C8YfHvAbkR1ZzH3U6VRaveJN5AqSiQX6yuJVWRrq5RiWgmwJG09bI7iwtL9QtQLwFG5QYIN54XgbZKSCf1QaxsiPDYkPl/tbBYVfi3UEm3Z3AWwfnTkDmjbUEFuddVUUWylrYKtg8K7LU7cszLIEXpyOr1arILzEGj/HnQswUmgyZeimNnpZmTHjIDeRB4WMYZoVx4ciLwqdMypChQroUwmOlq5Ahw6QpZuP2HxxXd11eM9wcAAAAAElFTkSuQmCC";
  if ($type) echo $str;
  else return $str;
}

/* 通过邮箱生成头像地址 */
function _getAvatarByMail($mail)
{
  $gravatarsUrl = Helper::options()->CustomAvatarSource ? Helper::options()->CustomAvatarSource : 'https://gravatar.helingqi.com/wavatar/';
  $mailLower = strtolower($mail);
  $md5MailLower = md5($mailLower);
  $qqMail = str_replace('@qq.com', '', $mailLower);
  if (strstr($mailLower, "qq.com") && is_numeric($qqMail) && strlen($qqMail) < 11 && strlen($qqMail) > 4) {
    echo 'https://thirdqq.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';
  } else {
    echo $gravatarsUrl . $md5MailLower . '?d=mm';
  }
}

/*
* 无插件阅读数，cookie保证阅读量真实性
* 大于一千，转化为k,大于一万转化为W,最多显示10W+
*/
function num2tring($num) {
	if ($num >= 100000) {
		$num = '10w+';
	} elseif ($num >= 10000) {
        $num = round($num / 10000 * 100) / 100 ;
        $num = round($num,1).' w';//四舍五入保留一位小数
    } elseif($num >= 1000) {
        $num = round($num / 1000 * 100) / 100 ;
        $num = round($num,1). ' k';//四舍五入保留一位小数
    } else {
        $num = $num;
    }
    return $num;
}

/* 查询文章浏览量 */
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    $newViews = $row['views'];
    $newViews = num2tring($newViews);
    echo $newViews;
}

/*人性化时间*/
function time_diff($from, $to = '') {
    if (empty($to)) {
        $to = time();
    }
    $diff = abs($to - $from);
    $day_diff = floor($diff / 86400);

    if ($day_diff >= 1) {
        if ($day_diff == 1) {
            return _t('昨天');
        }
        return sprintf(_t('%d天前'), $day_diff);
    }

    $hour_diff = floor(($diff - $day_diff * 86400) / 3600);
    if ($hour_diff >= 1) {
        if ($hour_diff == 1) {
            return _t('1小时前');
        }
        return sprintf(_t('%d小时前'), $hour_diff);
    }

    $minute_diff = floor(($diff - $day_diff * 86400 - $hour_diff * 3600) / 60);
    if ($minute_diff >= 1) {
        if ($minute_diff == 1) {
            return _t('1分钟前');
        }
        return sprintf(_t('%d分钟前'), $minute_diff);
    }

    return _t('刚刚');
}

//总访问量
function theAllViews()
{
    $db = Typecho_Db::get();
    $row = $db->fetchAll('SELECT SUM(VIEWS) FROM `typecho_contents`');
        echo number_format($row[0]['SUM(VIEWS)']);
}

//响应耗时
function timer_start() {
    global $timestart;
    $mtime = explode( ' ', microtime()  );
    $timestart = $mtime[1] + $mtime[0];
    return true; 
}
timer_start();
function timer_stop( $display = 0, $precision = 3  ) {
    global $timestart, $timeend;
    $mtime = explode( ' ', microtime()  );
    $timeend = $mtime[1] + $mtime[0];
    $timetotal = number_format( $timeend - $timestart, $precision  );
    $r = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
    if ( $display  ) {
        echo $r;
    }
    return $r;
}

// 运行
function getBuildTime($outputSeconds = false) {
    // 获取站点创建时间
    $site_create_time = strtotime(Helper::options()->BirthDay);
    // 计算当前时间与站点创建时间的差值
    $time = time() - $site_create_time;
    
    // 如果时间计算结果不是数字，直接返回空字符串
    if (!is_numeric($time)) {
        return '';
    }

    // 计算各个时间单位
    $value = array(
        "years" => 0,
        "days" => 0,
        "hours" => 0,
        "minutes" => 0,
        "seconds" => 0,
    );

    $value["seconds"] = $time;
    $value["minutes"] = floor($value["seconds"] / 60);
    $value["seconds"] %= 60;
    $value["hours"] = floor($value["minutes"] / 60);
    $value["minutes"] %= 60;
    $value["days"] = floor($value["hours"] / 24);
    $value["hours"] %= 24;
    $value["years"] = floor($value["days"] / 365);
    $value["days"] %= 365;

    // 构建时间字符串
    $timeString = '';
    if ($value["years"]) $timeString .= $value["years"] . '年';
    if ($value["days"]) $timeString .= $value["days"] . '天';

    echo $timeString;
}

// 文章字数计算
function  art_count ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    echo mb_strlen($text,'UTF-8');
}

//文章阅读时间统计
function art_time ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    $text_word = mb_strlen($text,'utf-8');
    echo ceil($text_word / 400);
}

// 生成文章目录树
function generateToc($content): string {
    $idCounter = 1;
    $matches = array();
    preg_match_all('/<h([1-5])(?![^>]*class=)([^>]*)>(.*?)<\/h\1>/', $content, $matches, PREG_SET_ORDER);
    if (!$matches) {
        return '暂无目录';
    }
    $toc = '<ul class="ul-toc list-none">';
    $currentLevel = 0;
    foreach ($matches as $match) {
        $level = (int)$match[1];
        $attributes = $match[2];
        $title = strip_tags($match[3]);
        $anchor = 'header-' . $idCounter++;
        // 生成新的标题标签并添加 id
        $content = str_replace($match[0], '<h' . $level . ' id="' . $anchor . '"' . $attributes . '>' . $match[3] . '</h' . $level . '>', $content);
        // 调整目录层级
        if ($currentLevel == 0) {
            $currentLevel = $level;
        }
        while ($currentLevel < $level) {
            $toc .= '<ul>';
            $currentLevel++;
        }
        while ($currentLevel > $level) {
            $toc .= '</ul></li>';
            $currentLevel--;
        }
        $toc .= '<li><a href="#' . $anchor . '" class="toc-link">' . $title . '</a>';
        // 添加闭合标签
        $toc .= '</li>';
    }
    // 关闭所有未闭合的 ul 标签
    while ($currentLevel > 0) {
        $toc .= '</ul>';
        $currentLevel--;
    }
    $toc .= '</ul>';
    return $toc;
}

// 文章缩略图
function _getThumbnails($item)
{
  $result = [];
  $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
  $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
  $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
  /* 如果填写了自定义缩略图，则优先显示填写的缩略图 */
  if ($item->fields->thumb) {
    $fields_thumb_arr = explode("\r\n", $item->fields->thumb);
    foreach ($fields_thumb_arr as $list) $result[] = $list;
  }
  /* 如果匹配到正则，则继续补充匹配到的图片 */
  if (preg_match_all($pattern, $item->content, $thumbUrl)) {
    foreach ($thumbUrl[1] as $list) $result[] = $list;
  }
  if (preg_match_all($patternMD, $item->content, $thumbUrl)) {
    foreach ($thumbUrl[1] as $list) $result[] = $list;
  }
  if (preg_match_all($patternMDfoot, $item->content, $thumbUrl)) {
    foreach ($thumbUrl[1] as $list) $result[] = $list;
  }
  /* 如果上面的数量不足3个，则直接补充3个随即图进去 */
  if (sizeof($result) < 4) {
    $custom_thumbnail = Helper::options()->Thumbnail;
    /* 将for循环放里面，减少一次if判断 */
    if ($custom_thumbnail) {
      $custom_thumbnail_arr = explode("\r\n", $custom_thumbnail);
      for ($i = 0; $i < 4; $i++) {
        $result[] = $custom_thumbnail_arr[array_rand($custom_thumbnail_arr, 1)] . "?key=" . mt_rand(0, 1000000);
      }
    } else {
      for ($i = 0; $i < 4; $i++) {
        $result[] = _getAssets('Assets/Thumb/' . rand(1, 4) . '.jpg', false);
      }
    }
  }
  return $result;
}

/**
 * 判断当前菜单是否激活
 * @param $self
 * @param $slug
 * @return string
 */
function isActiveMenu($self, $slug) {
    $activeMenuClass = " current ";
    // 检查当前页面是否是分类页面且slug匹配
    if ($self->is("category") && $self->getArchiveSlug() === $slug) {
        return $activeMenuClass;
    }
    // 检查当前页面是否是文章页面且文章属于给定的分类slug
    if ($self->is("post") && in_array($slug, array_column($self->categories, "slug"))) {
        return $activeMenuClass;
    }
    // 如果都不是，返回空字符串
    return "";
}

// 获取文章摘要
function _getAbstract($item, $type = true)
{
  $abstract = "";
  if ($item->password) {
    $abstract = "加密文章，请前往内页查看详情";
  } else {
    if ($item->fields->abstract) {
      $abstract = $item->fields->abstract;
    } else {
      $abstract = strip_tags($item->excerpt);
      if (strpos($abstract, '{hide') !== false) {
        $abstract = preg_replace('/{hide[^}]*}([\s\S]*?){\/hide}/', '隐藏内容，请前往内页查看详情', $abstract);
      }
    }
  }
  if ($abstract === '') $abstract = "暂无简介";
  if ($type) echo $abstract;
  else return $abstract;
}
