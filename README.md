Yii2 Color Picker Widget
========================
This widget is based on jQuery plugin by Stefan Petre (http://www.eyecon.ro/colorpicker/)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist dpodium/yii2-colorpicker "*"
```

or add

```
"dpodium/yii2-colorpicker": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \dpodium\colorpicker\ColorPickerWidget::widget(['id' => 'color-picker', 'name' => 'color-picker']); ?>```
