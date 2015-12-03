<?php

namespace dpodium\colorpicker;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

class ColorPickerWidget extends InputWidget {

    /**
     * Widget Options
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var boolean
     */
    public $render = true;

    public function run() {
        if ($this->render) {
            $hiddenInput = '';
            echo Html::beginTag('div', [
                'id' => $this->options['id'] . '-custom-colorpicker',
                'class' => 'custom-colorpicker dropdown'
            ]);
            echo Html::beginTag('div', ['class' => 'colorpicker-selected', 'data-toggle' => 'dropdown']);

            if ($this->hasModel()) {
                $hiddenInput = Html::activeHiddenInput($this->model, $this->attribute, $this->options);
                $this->value = Html::getAttributeValue($this->model, $this->attribute);
                echo Html::tag('div', '', ['style' => "background-color: {$this->value}"]);
            } else {
                $hiddenInput = Html::hiddenInput($this->name, $this->value, $this->options);
                echo Html::tag('div', '', ['style' => 'background-color: #00ff00']);
            }

            echo Html::endTag('div');
            echo Html::tag('div', '', [
                'id' => $this->options['id'] . '-colorpicker-holder',
                'class' => 'colorpicker-holder dropdown-menu',
            ]);
            echo $hiddenInput;
            echo Html::endTag('div');
        }
        $this->registerClientScript();
    }

    public function registerClientScript() {
        $view = $this->getView();
        $this->initClientOptions();
        $id = $this->options['id'];
        $js = "jQuery(function() {"
                . "jQuery('#{$id}-colorpicker-holder').ColorPicker(" . Json::encode($this->clientOptions) . "); "
                . "jQuery('.colorpicker-holder.dropdown-menu').bind('click', function() { "
                . "return false;"
                . "});"
                . "});";
        ColorPickerAsset::register($view);
        $view->registerJs($js);
    }

    protected function initClientOptions() {
        // ColorPicker optional params
        $id = $this->options['id'];
        $params = ['color', 'onChange'];
        $onChange = "function(hsb, hex, rgb) { "
                . "var selected_color = '#' + hex;"
                . "jQuery('#{$id}-custom-colorpicker .colorpicker-selected > div').css('background-color', selected_color);"
                . "jQuery('#{$id}-custom-colorpicker > input').val(selected_color);"
                . "}";

        $options = [];
        $options['color'] = $this->value ? $this->value : '#ffffff';
        $options['flat'] = true;
        $options['onChange'] = new JsExpression($onChange);

        foreach ($params as $key) {
            if (isset($this->clientOptions[$key])) {
                $options[$key] = $this->clientOptions[$key];
            }
        }
        $this->clientOptions = $options;
    }

}
