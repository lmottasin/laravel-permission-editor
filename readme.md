# Laravel Permission Editor

This is a package that gives a very simple visual UI for managing roles/permissions for [Spatie Laravel Permission]() package.

## How to Use

1. Make sure to install the spatie/laravel-permission package first and configure it
2. Run `composer require lmottasin/laravel-permission-editor`
3. Run `php artisan vendor:publish --provider="Lmottasin\LaravelPermissionEditor\Providers\PermissionEditorServiceProvider"` to publish the Assets and Config
4. Launch `/permission-editor/roles` in your browser

How it looks visually:

<img width="1680" alt="Screenshot 2024-04-26 at 11 32 17 AM" src="https://github.com/lmottasin/laravel-permission-editor/assets/68915904/60904414-e8b4-4178-a21d-17a9e120d0c5">


**Notice**: you may want to secure the routes by adding extra middleware like `auth`, you can do it in the published `config/permission-editor.php` file.

---

## Importat Info

- Do not use this package, this package is only for learning purpose
