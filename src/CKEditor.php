<?php

namespace Tungnt\CKEditor;

use Tungnt\Admin\Form\Field;

class CKEditor extends Field
{
	protected static $js = [
        '/vendor/mrkun-ckeditor/ckeditor/ckeditor.js',
    ];

    protected $view = 'mrkun-ckeditor::ckeditor';

    public function render()
    {
        $config = (array)CKEditorConf::config('config');
        $config = json_encode(array_merge($config, $this->options));

        $this->script = <<<EOT
        Array.prototype.forEach.call(document.getElementsByClassName('mrkun-ckeditor'), function(item) {
            if (item.classList.contains("mrkun-ckeditor") && !item.classList.contains("active")) {
                item.classList.add("active");
                CKEDITOR.replace(item, {$config});
            }

        });
        EOT;

        return parent::render();
    }
}