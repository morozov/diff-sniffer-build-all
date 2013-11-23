<?php

namespace builder;

function buildAll($workspaceRoot, $appRoot, $builder, array $projects)
{
    foreach ($projects as $project => $params) {
        $appName = $params['app_name'];
        if (isset($params['src'])) {
            $src = $params['src'];
        } else {
            $src = $project;
        }

        if (isset($params['standard'])) {
            $standard = $params['standard'];
        } else {
            $standard = null;
        }

        $cmd = getCommand(
            $builder,
            $appName,
            $workspaceRoot . '/' . $src,
            $standard,
            $appRoot . '/build/' . $project . '/' . $appName . '.phar'
        );

        echo 'Building ' . $project . '... ';

        $result = execCommand($cmd, $error);

        if ($result) {
            echo 'Done.', PHP_EOL;
        } else {
            echo 'Failed.', PHP_EOL;
            echo formatError($error), PHP_EOL;
        }
    }
}

function getCommand($builder, $appName, $src, $standard, $output)
{
    $cmd = array(
        $builder,
        $appName,
        $src,
    );

    if ($standard !== null) {
        $cmd[] = '-s';
        $cmd[] = $standard;
    }
    $cmd[] = $output;

    return implode(' ', $cmd);
}

function execCommand($cmd, &$error)
{
    $pipes = array();
    $process = proc_open(
        $cmd,
        array(
            2 => array('pipe', 'w'),
        ),
        $pipes
    );

    $error = stream_get_contents($pipes[2]);

    return proc_close($process) == 0;
}

function formatError($error)
{
    $marker = '> ';
    if (posix_isatty(STDOUT)) {
        $cols = `tput cols`;
        $error = chunk_split($error, $cols - strlen($marker), $marker);
        $error = substr($error, 0, -strlen($marker));
    }
    return $marker . $error;
}
