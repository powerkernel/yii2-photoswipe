Yii2 PhotoSwipe
===============
PhotoSwipe extension for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist powerkernel/yii2-photoswipe "*"
```

or add

```
"powerkernel/yii2-photoswipe": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

Add Gallery
```php
<?=
\powerkernel\photoswipe\Gallery::widget([
    'items' => [
        [
            'image' => 'https://c2.staticflickr.com/2/1518/24267732553_54aed33368_b.jpg',
            'title' => 'Image Title 1',
            'caption' => 'Caption 2',
            'size' => '1024x685',
            'thumb' => 'https://c2.staticflickr.com/2/1518/24267732553_54aed33368_m.jpg',
        ],
        [
            'image' => 'https://farm6.staticflickr.com/5023/5578283926_822e5e5791_b.jpg',
            'title' => 'Image Title 2',
            'caption' => 'Caption 3',
            'size' => '1024x768',
            'thumb' => 'https://farm6.staticflickr.com/5023/5578283926_822e5e5791_m.jpg',
        ],
    ]
])
?>
```

Enable lightbox for existing images on your page
```php
<?php
    echo \powerkernel\photoswipe\Modal::widget([
        'selector'=>'.lightbox',
        'images' => [
                [
                    'src' => 'https://c2.staticflickr.com/2/1518/24267732553_54aed33368_b.jpg',
                    'width' => 1024,
                    'height' => 685,
                    'alt' => 'Title 1',
                ],
                [
                    'src' => 'https://farm6.staticflickr.com/5023/5578283926_822e5e5791_b.jpg',
                    'width' => 1024,
                    'height' => 768,
                    'alt' => 'Title 2',
                ],
            ]
    ]);
?>
```
