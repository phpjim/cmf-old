JimCMF
=======
The following is a proposed project structure for advanced applications that works in conjunction with YIInitializr components. 

The package is cleaned from extensions, you choose what you wish to include in your composer.json files. The only ones included are Yii Framework (obviously) the rest is up to you. We do not want to confuse you. 


## Setup and first run

  * Set up Git by following the instructions [here](https://help.github.com/articles/set-up-git).
  * Update the configurations in `core/api/config/`, `core/frontend/config/`, `core/console/config/`, `core/backend/config/` and `core/common/config/` to suit your needs. The `core/common/config/main.php` is configured to use **sqllite** by default. Change your `core/common/config/env/dev.php` to suit your database requirements.
 * Composer is required The package `composer.phar` file.
 * Browse through the `composer.json` and remove the dependencies you don't need also update the required versions of the extensions.
 * If you have `composer` installed globally:
	 * Run `composer self-update` to make sure you have the latest version of composer.
	 * Run `composer install` to download all the dependencies.
 * If you work the `composer.phar` library within the project boilerplate.
 	 * Run `php composer.phar self-update` to make sure you have the latest version of composer.
	 * Run `php composer.phar install` to download all the dependencies.
 * `Yiinitializr\Composer\Callback` will configure everything required on your application: `runtime` and `assets` folders and migrations.

####Important
When you first run install and after the deployment script installs the dependencies, creates your runtime and assets folders, it will ask you for your environment. Make sure you use "**dev**" for your local development settings and "**stage**" or "**prod**" for their respective environment types. Also, is important that the files are actually there, do not say "**master**" without "**master.php**" not being actually there.

For more information about using Composer please see its [documentation](http://getcomposer.org/doc/).

###How to configure the application

This boilerplate is very similar to YiiBoilerplate but differs from it for the easiness of its configuration. We focused to release the pain of configuring your application and combine your configuration files. `Yiinitializr\Helpers\Initializr` is very easy to use, check for example the bootstrap `index.php` file at the frontend:

```
require('./../../common/lib/vendor/autoload.php');
require('./../../common/lib/vendor/yiisoft/yii/framework/yii.php');

Yii::setPathOfAlias('Yiinitializr', './../../common/lib/Yiinitializr');

use Yiinitializr\Helpers\Initializer;

Initializer::create('./../', 'frontend', array(
	__DIR__ .'/../../common/config/main.php', // files to merge with
	__DIR__ .'/../../common/config/env.php',
	__DIR__ .'/../../common/config/local.php',
))->run();
```

For more information about Yiinitializr please check it at [its github repo](https://github.com/2amigos/yiinitializr).

## Overall Structure

Bellow the directory structure used:

```
    |--core
    |----api
    |------config
    |--------env
    |------controllers
    |------extensions
    |--------components
    |--------filters
    |------models
    |----backend
    |------components
    |------config
    |--------env
    |------controllers
    |------extensions
    |------helpers
    |------lib
    |------models
    |------modules
    |------tests
    |------views
    |--------layouts
    |--------site
    |------widgets
    |----common
    |------components
    |------config
    |--------env
    |------data
    |------extensions
    |--------components
    |------helpers
    |------messages
    |------models
    |------schema
    |------widgets
    |----console
    |------commands
    |------components
    |------config
    |--------env
    |------data
    |------extensions
    |------migrations
    |------models
    |----frontend
    |------components
    |------config
    |--------env
    |------controllers
    |------extensions
    |------helpers
    |------models
    |------modules
    |------tests
    |------views
    |--------layouts
    |--------site
    |------widgets
    |----lib
    |------YiiRestTools
    |--------Common
    |----------Enum
    |----------Exception
    |--------Helpers
    |------Yiinitializr
    |--------Cli
    |--------Composer
    |--------Helpers
    |--------config
    |----runtime
    |--htdocs
    |----api
    |----backend
    |------assets
    |----frontend
    |----assets
  
 ```

## Extensions

 * Yiinitializr [https://github.com/2amigos/yiinitializr](https://github.com/2amigos/yiinitializr)
