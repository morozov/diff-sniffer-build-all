<?php

return array(
    'diff-sniffer-pre-commit' => array(
        'app_name' => 'pre-commit',
    ),
    'diff-sniffer-pre-commit-sugarcrm' => array(
        'app_name' => 'pre-commit',
        'src' => 'diff-sniffer-pre-commit',
        'standard' => __DIR__
            . '/../sugarcrm-coding-standards/PHP/CodeSniffer/Standards/SugarCRM',
    ),
    'diff-sniffer-pre-commit-psr2' => array(
        'app_name' => 'pre-commit',
        'src' => 'diff-sniffer-pre-commit',
        'standard' => 'PSR2',
    ),
    'diff-sniffer-pull-request' => array(
        'app_name' => 'pull-request',
    ),
    'diff-sniffer-pull-request-sugarcrm' => array(
        'app_name' => 'pull-request',
        'src' => 'diff-sniffer-pull-request',
        'standard' => __DIR__
            . '/../sugarcrm-coding-standards/PHP/CodeSniffer/Standards/SugarCRM',
    ),
);
