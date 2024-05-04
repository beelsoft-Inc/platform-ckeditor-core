<h1 align="center"> tungnt-ckeditor </h1>

<p align="center">ckeditor for tungnt/laravel-admin</p>

## Installing

```shell
composer require tungnt/mrkun-ckeditor
```

```shell
php artisan vendor:publish --tag=mrkun-ckeditor --tag="ckfinder-config"
```
## Configuration
In the extensions section of the config/admin.php file, add some configuration that belongs to this extension.
```php
  'extensions' => [
          'ckeditor' => [
  
              //Set to false if you want to disable this extension
              'enable' => true,
  
              // Editor configuration
              'config' => [
                  'filebrowserBrowseUrl' =>   '/admin/ckfinder/browser',
                  'filebrowserImageBrowseUrl' =>  '/admin/ckfinder/browser',
              ]
          ]
      ],
```

add `admin/routes.php`
```php
Route::group([
    'prefix' => 'admin/ckfinder',
    'middleware'    => config('admin.route.middleware'),
], function () {
    Route::any('connector', '\Tungnt\CKEditor\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

    Route::any('browser', '\Tungnt\CKEditor\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
});
```


edit `app/Http/Middleware/EncryptCookies.php`

```php
// app/Http/Middleware/EncryptCookies.php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'ckCsrfToken',
        // ...
    ];
}
```

edit `app/Http/Middleware/VerifyCsrfToken.php`
```php
// app/Http/Middleware/VerifyCsrfToken.php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'admin/ckfinder/*',
        // ...
    ];
}
```

## Usage

```php
$form->ckeditor('content', 'content');
```

```php
$form->ckeditor('content')->options(['height' => 500,'contentsCss' => '/css/frontend.css']);
```

```php
$form->ckuploader('image', __('cover'));
```

## License

MIT
