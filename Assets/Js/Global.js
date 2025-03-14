$(document).ready(function() {
    // 绑定点击事件到 .mobile_menu
    $('.mobile_menu').on('click', function() {
        // 获取 .layout-container .aside 的当前 left 值
        var currentLeft = $('.layout-container .aside').css('left');
        
        // 检查当前 left 值，切换 left: '0' 和 left: '-22rem'
        if (currentLeft === '0px') {
            $('.layout-container .aside').css('left', '-22rem');
            $('.menu_off').css('left', '-100vw');
        } else {
            $('.layout-container .aside').css('left', '0px');
            $('.menu_off').css('left', '0');
        }
    });
});
$(document).on('click','.menu_off',function() {
    $('.layout-container .aside').css('left','-22rem');
    $('.menu_off').css('left','-100vw');
});
// 评论表情按钮
function emoji_btn() {
    $(".emoji-btn").click(function () {
        var $commentEmoji = $(".comment-emoji");
        if ($commentEmoji.hasClass("show")) {
            $commentEmoji.removeClass("show");
        } else {
            $commentEmoji.addClass("show");
        }
    });
};
// 为指定选择器的所有元素添加类名，用于初始化动画
function FadeSelects(selector) {
    // 获取所有匹配选择器的元素
    const elements = document.querySelectorAll(selector);
    // 遍历这些元素，并为每个元素添加 'fade-before' 类
    elements.forEach(element => {
        element.classList.add('fade-before');
    });
};

// 处理动画效果，使得元素在滚动到视口时添加动画类
function FadeAnimate() {
    // 获取所有已经添加了 'fade-before' 类的元素
    const items = document.querySelectorAll('.fade-before');
    // 定义一个函数，用于在元素滚动到视口时添加动画效果
    const animateOnScroll = (elements, delay) => {
        // 创建一个IntersectionObserver实例，用于监听元素是否进入视口
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry, index) => {
                // 如果元素进入视口
                if (entry.isIntersecting) {
                    // 设置一个延迟，然后为元素添加 'fade-after' 类，触发动画
                    setTimeout(() => {entry.target.classList.add('fade-after');}, index * delay);
                    // 停止观察当前元素
                    observer.unobserve(entry.target);
                }
            });
        });
        // 遍历所有元素，并开始观察它们
        elements.forEach((element) => {
            observer.observe(element);
        });
    };
    // 调用animateOnScroll函数，为元素设置150毫秒的延迟
    animateOnScroll(items, 150);
};

// 处理动画的延迟效果，使得子元素在父元素动画完成后依次延迟显示
function animateDelayed(parentSelector, childSelector, delayFirstTime, delayChildTime) {
    // 获取所有匹配父选择器的元素
    const parents = document.querySelectorAll(parentSelector);
    // 遍历这些父元素
    parents.forEach((parent, index) => {
        // 获取每个父元素下匹配子选择器的子元素
        const children = parent.querySelectorAll(childSelector);
        // 遍历这些子元素，并为每个子元素设置动画延迟
        children.forEach((child, childIndex) => {
            // 计算总延迟时间，包括初始延迟和每个子元素的额外延迟
            child.style.animationDelay = `${delayFirstTime + childIndex * delayChildTime}s`;
        });
    });
};

// 顶栏固定
function HeadFixed() {
	window.addEventListener('scroll', function(e) {
		var t = document.documentElement.scrollTop || document.body.scrollTop;
		if (t < 84) {
			document.body.classList.remove('nav-fixed');
		} else {
			document.body.classList.add('nav-fixed');
		}
	});
};

// 音乐
function initializeAudioPlayer() {
    $(document).ready(function() {
        // 获取播放按钮
        const playBtn = $('.play_btn');
        // 获取音乐文件的链接
        const musicLink = playBtn.attr('data-music');

        // 创建音频元素
        const audio = new Audio(musicLink);

        // 为播放按钮添加点击事件
        playBtn.click(function(event) {
            event.preventDefault(); // 阻止默认行为（即不跳转到音乐文件链接）
            if (audio.paused) {
                audio.play();
                playBtn.html('<svg class="icon" style="width:2em;height:2em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6008"><path d="M512 64C264.64 64 64 264.64 64 512c0 247.424 200.64 448 448 448 247.424 0 448-200.576 448-448C960 264.64 759.424 64 512 64zM448 635.584c0 23.552-18.432 42.688-41.216 42.624-22.656 0.064-41.088-19.072-41.088-42.56L365.696 383.04c0-23.68 18.432-42.688 41.152-42.688C429.568 340.224 448 359.488 448 382.976L448 635.584zM658.24 635.584c0 23.552-18.432 42.688-41.216 42.624C594.368 678.272 576 659.136 576 635.648L576 383.04c0-23.68 18.432-42.688 41.152-42.688 22.656-0.128 41.152 19.136 41.152 42.624L658.304 635.584z" fill="#020202" p-id="6009"></path></svg>');
            } else {
                audio.pause();
                playBtn.html('<svg class="icon" style="width:2em;height:2em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3994"><path d="M513 61c249.08 0 451 201.92 451 451S762.08 963 513 963 62 761.08 62 512 263.92 61 513 61z m-72.752 266.918c-20.82 0-37.697 16.94-37.697 37.837v301.69c0 7.35 2.132 14.54 6.137 20.692 11.386 17.495 34.746 22.413 52.176 10.985L688.25 550.037a39.865 39.865 0 0 0 11.552-11.595c12.019-18.467 6.847-43.216-11.552-55.279L460.864 334.078a37.597 37.597 0 0 0-20.616-6.16z" fill="#020202" p-id="3995"></path></svg>');
            }
        });

        // 监听音频播放结束事件
        audio.addEventListener('ended', function() {
            playBtn.html('<svg class="icon" style="width:2em;height:2em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3994"><path d="M513 61c249.08 0 451 201.92 451 451S762.08 963 513 963 62 761.08 62 512 263.92 61 513 61z m-72.752 266.918c-20.82 0-37.697 16.94-37.697 37.837v301.69c0 7.35 2.132 14.54 6.137 20.692 11.386 17.495 34.746 22.413 52.176 10.985L688.25 550.037a39.865 39.865 0 0 0 11.552-11.595c12.019-18.467 6.847-43.216-11.552-55.279L460.864 334.078a37.597 37.597 0 0 0-20.616-6.16z" fill="#020202" p-id="3995"></path></svg>');
        });
    });
};

// 幻灯片
function initializeSlickSlider() {
    $('.slick').slick({
      dots: false, // 不显示导航小圆点
      centerPadding: '10px',
      infinite: true, // 允许无限循环滚动
      slidesToShow: 2, // 每次显示1张图片
        responsive: [ // 响应式设置，根据屏幕宽度调整滑动效果
        {
          breakpoint: 767.9, // 当屏幕宽度小于767.9px时
          settings: {
            slidesToShow: 1, // 显示1张图片
            adaptiveHeight: true, // 允许图片宽度不同
            variableWidth: false // 允许图片宽度不同
          }
        }
      ],
      centerMode: false, // 不开启居中模式
      variableWidth: true, // 允许图片宽度不同
      arrows: true, // 显示箭头按钮
      prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M10.8284 12.0007L15.7782 16.9504L14.364 18.3646L8 12.0007L14.364 5.63672L15.7782 7.05093L10.8284 12.0007Z"></path></svg></button>', // 自定义上一页按钮
      nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg></button>' // 自定义下一页按钮
    });
    
    // 监听 slick 的初始化事件
    $('.slick').on('init', function(event, slick) {
      updateArrowVisibility();
    });
    
    // 监听 slick 的滑动事件
    $('.slick').on('afterChange', function(event, slick, currentSlide) {
      updateArrowVisibility();
    });
    
    // 更新箭头按钮的显示状态
    function updateArrowVisibility() {
      const slick = $('.slick').slick('getSlick'); // 获取 slick 实例
      const currentSlide = slick.currentSlide; // 当前显示的幻灯片索引
      const totalSlides = slick.slideCount; // 总幻灯片数量
    
      // 如果是第一张，隐藏上一页按钮
      if (currentSlide === 0) {
        $('.slick-prev').hide();
      } else {
        $('.slick-prev').show();
      }
    
      // 如果是最后一张，隐藏下一页按钮
      if (currentSlide === totalSlides - 1) {
        $('.slick-next').show(); // 确保下一页按钮显示（因为可能之前被隐藏了）
        $('.slick-next').prop('disabled', true); // 禁用按钮
      } else {
        $('.slick-next').show();
        $('.slick-next').prop('disabled', false); // 启用按钮
      }
    }
};

document.addEventListener("DOMContentLoaded", () => {
    emoji_btn();
    FadeSelects(".formatted-content post_image");
    FadeSelects(".friends_books_tags li");
    FadeSelects(".books-post .article-wrapper>* ");
    animateDelayed('.comment-list', 'li', 1.3, 0.2);
    animateDelayed('.book-description', '*', 1.5, 0.2);
    FadeAnimate();
    HeadFixed();
    initializeAudioPlayer();
    initializeSlickSlider();
    
});