<?php
/**
 * @author Harry Tang <harry@modernkernel.com>
 * @link https://modernkernel.com
 * @copyright Copyright (c) 2016 Modern Kernel
 */

namespace modernkernel\photoswipe;


use yii\web\AssetBundle;

/**
 * Class PhotoswipeAsset
 * @package modernkernel\photoswipe
 */
class PhotoswipeAsset extends AssetBundle
{
    public $sourcePath = '@bower/photoswipe/dist';
    public $js = [
        'photoswipe.min.js',
        'photoswipe-ui-default.min.js'
    ];
    public $css = [
        'photoswipe.css',
        'default-skin/default-skin.css'
    ];
} 
