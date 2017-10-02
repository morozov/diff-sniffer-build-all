<?php

return array(
    'pre-commit' => array(
        'app_name' => 'pre-commit',
        'standard' => 'PSR2',
    ),
    'pre-commit-sugarcrm' => array(
        'app_name' => 'pre-commit',
        'src' => 'pre-commit',
        'standard' => __DIR__
            . '/../../sugar-lint-rules/phpcs/Mango',
    ),
    'pull-request' => array(
        'app_name' => 'pull-request',
        'standard' => 'PSR2',
    ),
    'pull-request-sugarcrm' => array(
        'app_name' => 'pull-request',
        'src' => 'pull-request',
        'standard' => __DIR__
            . '/../../sugar-lint-rules/phpcs/Mango',
    ),
);
