# composer-ui
ComposerUI for Composer

> Note: This is just a try for composer, and should be considered as experimental.

## Strategy
Via [this issue at Composer](https://github.com/composer/composer/issues/4429), we started with the idea to build
a general UI for composer. However, the UI couldn't exist without a `helper` to create and execute commands.

At the moment we are working on the helper. The goal is that the helper can be used in future without the UI. The UI
will be the second part.

## Installation
You can install this package via... Yeah... Composer:

    composer require bobmulder/composer-ui:dev-master


## Usage
The following commands are supported for now:
- composer
- install
- archive
- update
- require
- remove

### The ComposerHelper Class
You can start using composer by creating an instance of the `ComposerUI/ComposerHelper`-class:

    $composer = new ComposerHelper();

You can configure the working path via:

    $composer = new ComposerHelper('/custom/path');

Now you are ready to go!

### Options
On every command you can use every option that is available at composer.

> Note: Read this to get a list of commands and options: https://getcomposer.org/doc/03-cli.md

> Note: Need a specific command? Open up an issue or better a pull request!

### Composer
Just initializes composer. Nothing special.

    $composer->composer();

### Install
The install command reads the `composer.json` file from the current directory, resolves the dependencies, and installs
them into vendor.

    $composer->install();

### Archive
This command is used to generate a zip/tar archive for your entire project.

    $composer->archive();

> Note: Composer itself supports to archive specific packages, but this library doesn't support that yet...

### Update
In order to get the latest versions of the dependencies and to update the `composer.lock` file, you should use the
update command.

    $composer->update();

### Require
The require command adds new packages to the `composer.json` file from the current directory. If no file exists one will
be created on the fly.

    $composer->requirePackages([
        'vendor/package' => '2.x',
        'vendor/secondpackage' => 'dev-master',
        'vendor/thirthpackage',
    ]);

### Remove
The remove command removes packages from the `composer.json` file from the current directory.

 $composer->removePackages([
        'vendor/package' => '2.x',
        'vendor/secondpackage' => 'dev-master',
        'vendor/thirthpackage',
    ]);

## Next
We would like to refer you to the composer docs itself: https://getcomposer.org/doc/03-cli.md

If you need help, don't fear to get in touch via gitter: https://gitter.im/bobmulder/composer-ui

[![Join the chat at https://gitter.im/bobmulder/composer-ui](https://badges.gitter.im/Join%20Chat.svg)]
(https://gitter.im/bobmulder/composer-ui?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)