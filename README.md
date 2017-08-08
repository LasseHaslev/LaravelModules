# (Deprecated) laravelmodules
> This package is deprecated in favor for [lassehaslev/laravel-modules](https://github.com/LasseHaslev/laravel-modules)

> Package for ordering folders in modules

## Motivation
It can be a good practice to organize you application features into different modules.
This package helps you with that. 

## Install
Begin by installing the package through Composer in your project folder.
```
composer require lassehaslev/laravelmodules
```

Open ```config/app.php``` and add ```LasseHaslev\LaravelModules\Providers\ServiceProvider::class``` to the ```providers``` array.

## Usage
In your ```app/``` folder create a folder named ```Modules/```. This is where you place all your modules.

Then this folder will be treated as its own ```app/``` folder.

**Example**
```
app/Modules/MyModule/
    Http/
        Controllers/
        Requests/
        routes.php
        routes.php
    Jobs/
    views/
```
## License
MIT, dawg
