<?php

require __DIR__ . '/vendor/autoload.php';

use ComposerUI\ComposerHelper;

function debug($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

$composer = new ComposerHelper();

debug('welcome to ComposerTools. This stuff is needed before setting up a full working UI');

/**
 * Installing a package
 *
 * You can installing a package by calling `requirePackage`.
 * Use the first parameter to define the package.
 * Use the second parameter to define the version.
 */
//$composer->requirePackage('symfony/config', 'dev-master');


/**
 * Removing a package
 *
 * You can remove a package by calling `removePackage`.
 * Use the first parameter to define the package.
 */
//$composer->removePackage('symfony/config');

/**
 * Update packages
 *
 * You can update composer by calling `update`.
 */
//$composer->update();