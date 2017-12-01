<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2017 Power Kernel
 */

namespace powerkernel\photoswipe;


use yii\base\Widget;
use yii\helpers\Html;


/**
 * Class Gallery
 * @package powerkernel\photoswipe
 */
class Gallery extends Widget
{
    public $items = []; // Gallery images
    public $col = 'col-sm-3'; // Bootstrap grid system
    public $imgClass = 'img-responsive img-thumbnail'; // the img class
    public $clientOptions = []; // photoswipe options, see http://photoswipe.com/documentation/options.html


    /**
     * Renders the widget.
     */
    public function run()
    {
        if (!empty($this->items)) {
            /* register */
            $this->register();

            /* render HTML */
            $html = <<<EOD
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
EOD;
            echo $html;

            echo Html::beginTag('div', ['class' => 'my-gallery', 'itemscope'=>true, 'itemtype' => 'http://schema.org/ImageGallery']);
            echo Html::beginTag('div', ['class' => 'row']);
            foreach ($this->items as $i=>$item) {
                echo Html::beginTag('div', ['class' => $this->col]);
                echo Html::beginTag('figure', ['itemscope'=>true, 'itemprop' => 'associatedMedia', 'itemtype' => 'http://schema.org/ImageObject']);
                echo '<a data-index="'.$i.'" class="gallery-image" href="' . $item['image'] . '" itemprop="contentUrl" data-size="' . $item['size'] . '">';
                echo '<img class="' . $this->imgClass . '" src="' . $item['thumb'] . '" itemprop="thumbnail" alt="' . $item['title'] . '" />';
                echo '</a>';
                if (!empty($item['caption'])) {
                    echo Html::beginTag('figcaption', ['itemprop' => 'caption description']);
                    echo $item['caption'];
                    echo Html::endTag('figcaption');
                }
                echo Html::endTag('figure');
                echo Html::endTag('div');
            }
            echo Html::endTag('div');
            echo Html::endTag('div');
        }

    }

    /**
     * register asset
     */
    protected function register()
    {
        $view = $this->getView();
        PhotoswipeAsset::register($view);
        /* data */
        $items = [];
        foreach ($this->items as $item) {
            list($w, $h) = explode("x", $item['size']);
            $items[] = [
                'src' => $item['image'],
                'w' => $w,
                'h' => $h,
                'title' => !empty($item['caption']) ? $item['caption'] : null
            ];
        }
        $items = json_encode($items);
        $clientOptions = json_encode($this->clientOptions);
        $js = <<<EOB
var pswpElement = document.querySelectorAll('.pswp')[0];        
$(document).on("click", ".gallery-image", function(e){
    e.preventDefault();    
    var index = $(this).data("index");
    var options = {
        index: index,
        bgOpacity: 0.7,
        showHideOpacity: true
    };  
    $.merge(options, {$clientOptions});
    var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, {$items}, options);
    gallery.init();    
});
EOB;
        $view->registerJs($js);
    }
}
