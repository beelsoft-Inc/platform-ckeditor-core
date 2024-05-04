<?php

namespace Tungnt\CKEditor;

use Tungnt\Admin\Extension;

class CKEditorConf extends Extension
{
  public $name = 'ckeditor';

  public $views = __DIR__.'/../resources/views';

  public function assets()
  {
      return __DIR__.'/../resources/assets';
  }
}