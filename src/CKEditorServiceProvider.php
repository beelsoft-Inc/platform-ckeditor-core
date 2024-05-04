<?php

namespace Tungnt\CKEditor;

use Illuminate\Support\ServiceProvider;
use Tungnt\Admin\Admin;
use Tungnt\Admin\Form;

class CKEditorServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('ckfinder.connector', function() {
            if (!class_exists('\CKSource\CKFinder\CKFinder')) {
                throw new \Exception(
                    "Couldn't find CKFinder conector code. ".
                    "Please run `artisan ckfinder:download` command first."
                );
            }

            $ckfinderConfig = config('ckfinder');

            if (is_null($ckfinderConfig)) {
                throw new \Exception(
                    "Couldn't load CKFinder configuration file. ".
                    "Please run `artisan vendor:publish --tag=ckfinder` command first."
                );
            }

            $ckfinder = new \CKSource\CKFinder\CKFinder($ckfinderConfig);

            return $ckfinder;
        });
    }

	public function boot(CKEditorConf $extension)
	{
		if (!CKEditorConf::boot()) {
			return;
		}

        if (config('ckfinder.loadRoutes')) {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        }

		if ($this->app->runningInConsole() && $assets = $extension->assets()) {
		    $this->publishes([
					$assets => public_path('vendor/mrkun-ckeditor')
		    ], ['mrkun-ckeditor']);

            $this->publishes([
                __DIR__.'/config-ckfinder.php' => config_path('ckfinder.php')
            ], ['ckfinder-config']);
		}

		if ($views = $extension->views()) {
			$this->loadViewsFrom($views, 'mrkun-ckeditor');
		}

		Admin::booting(function () {
		    Form::extend('ckeditor', CKEditor::class);
            Form::extend('ckuploader', CKUploader::class);
		});
	}
}