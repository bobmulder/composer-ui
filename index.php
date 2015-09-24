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
 * Call composer
 *
 * You can call composer by calling `composer`.
 */
//$composer->composer();



/**
 * Install packages
 *
 * You can install composer packages by calling `install`.
 */
//$composer->install();


/**
 * Archive composer
 *
 * You can archive composer by calling `archive`.
 */
//$composer->archive();


/**
 * Installing packages
 *
 * You can installing a package by calling `requirePackages`.
 * Use the first parameter to define the package.
 * Use the second parameter to define the version.
 */
//$composer->requirePackages([
//    'symfony/stopwatch' => 'dev-master',
//]);


/**
 * Removing packages
 *
 * You can remove a package by calling `removePackages`.
 * Use the first parameter to define the package.
 */
//$composer->removePackages([
//    'symfony/stopwatch' => 'dev-master',
//]);


/**
 * Update packages
 *
 * You can update composer by calling `update`.
 */
//$composer->update();