gravatari
=========

A simple gravatar package for php

*   Provides a fluent interface with Gravatar API
*   Seamless integration with Laravel 4

Installation
------------

### Installing via Composer

The recommended way to install Gravatari is through [Composer](http://getcomposer.org).

1. Add ``malonmedia/gravatari`` as a dependency in your project's ``composer.json`` file:

        {
            "require": {
                "malonmedia/gravatari": "*"
            }
        }

2. Download and install Composer:

        curl -s http://getcomposer.org/installer | php

3. Install your dependencies:

        php composer.phar install

4. Require Composer's autoloader

    Composer also prepares an autoload file that's capable of autoloading all of the classes in any of the libraries that it downloads. To use it, just add the following line to your code's bootstrap process:

        require 'vendor/autoload.php';

You can find out more on how to install Composer, configure autoloading, and other best-practices for defining dependencies at [getcomposer.org](http://getcomposer.org).

## Usage
### Images (avatars)

```php
<?php

use Gravatari\Api\Image;

$gravatar = new Image;

// Generate url for 80x80 avatar using Mystery Man if avatar does not exist
$url = $gravatar->size(80)->default('mm')->url('foo@foo.com');
```
#### Options
    size(80)                size in pixels                      1 - 2048
    default('404')          image to use as default             404, mm, identicon, monsterid, wavatar, retro, blank, OR an url
    forceDefault('no')      whether to force default image      yes, no
    rating('g')             maximum allowed content rating      g, pg, r, x
    
#### Url Generation
```php

    url('email@email.com')          //retrieve the url for the supplied email's gravatar
    
    urlSecure('email@email.com')    //retrieve a secure url for the supplied email's gravatar
```
### Profiles

```php
<?php

use Gravatari\Api\Profile;

$profile = new Profile;

// Url Methods (retrieve url in specified format)
$profile->url('foo@foo.com');
$profile->urlJson('foo@foo.com');
$profile->urlJson('foo@foo.com', 'alert');      //Json method accepts optional javascript callback paremeter
$profile->urlXml('foo@foo.com');
$profile->urlPhp('foo@foo.com');
$profile->urlVcf('foo@foo.com');
$profile->urlQr('foo@foo.com');

// Request Methods (send request and return response for specified format)
$profile->requestJson('foo@foo.com');
$profile->requestJson('foo@foo.com', 'alert');  //Json method accepts optional javascript callback paremeter
$profile->requestXml('foo@foo.com');
$profile->requestPhp('foo@foo.com');
```

## Extensions

Support for some common frameworks is/will be provided through extensions.  Below are instructions for currently supported extensions (more will be provided in the future):

#### Laravel 4
1. Add ``'Gravatari\Extension\Laravel\GravatariServiceProvider',`` to the ``providers`` array in ``app/config/app.php``.
2. Add ``'Gravatari'       => 'Gravatari\Extension\Laravel\Facades\Gravatari',`` to the ``aliases`` array in ``app/config/app.php``.
3. To access the avatar api, use ``Gravatari::image()->url('foo@foo.com')`` or simply ``Gravatari::url('foo@foo.com')``
4. To access the profile api, use ``Gravatari::profile()->urlJson('foo@foo.com')`` 
