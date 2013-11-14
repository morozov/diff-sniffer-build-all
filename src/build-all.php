<?php

/**
 * Pre-commit hook entry point
 *
 * PHP version 5
 *
 * @category  DiffSniffer
 * @package   DiffSniffer
 * @author    Sergei Morozov <morozov@tut.by>
 * @copyright 2013 Sergei Morozov
 * @license   http://mit-license.org/ MIT Licence
 * @link      http://github.com/morozov/diff-sniffer-build-all
 */
$autoload = __DIR__ . '/../vendor/autoload.php';

if (!file_exists($autoload)) {
    echo 'You must set up the project dependencies, run the following commands:'
        . PHP_EOL . 'curl -sS https://getcomposer.org/installer | php'
        . PHP_EOL . 'php composer.phar install'
        . PHP_EOL;
    exit(2);
}

require $autoload;

$appRoot = dirname(__DIR__);
$workspaceRoot = dirname($appRoot);
$builder = $workspaceRoot . '/diff-sniffer-builder/bin/build';
$projects = require $appRoot . '/projects.php';

builder\buildAll($workspaceRoot, $appRoot, $builder, $projects);
