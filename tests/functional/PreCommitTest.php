<?php

namespace DiffSniffer;

use builder;
use PHPUnit\Framework\TestCase;

class PreCommitTest extends TestCase
{
    private static $fixtureDir;
    private static $buildDir;
    private static $gitDir;

    public static function setUpBeforeClass()
    {
        self::$fixtureDir = __DIR__ . '/../fixtures';
        self::$buildDir = __DIR__ . '/../../build';
        $dir = self::$gitDir = tempnam(sys_get_temp_dir(), 'dst');

        unlink($dir);
        mkdir($dir, 0777, true);
        chdir($dir);
        exec('git init "' . $dir . '"');
    }

    protected function tearDown()
    {
        exec('git reset');
    }

    public static function tearDownAfterClass()
    {
        exec('rm -rf "' . self::$gitDir . '"');
    }

    /**
     * @dataProvider provider
     */
    public function testPreCommit($project, $fixture, $expected)
    {
        $fixtureFile = $fixture . '.php';
        $fixturePath = self::$gitDir . '/' . $fixtureFile;
        copy(self::$fixtureDir . '/' . $fixtureFile, $fixturePath);

        $app = self::$buildDir . '/' . $project . '.phar';
        exec('git add "' . $fixturePath . '"');

        $this->assertFileExists($app, $project . '.phar is not built');
        exec('"' . $app . '"', $output, $exit_code);

        if ($expected) {
            $this->assertEquals(0, $exit_code, implode(PHP_EOL, $output));
        } else {
            $this->assertEquals(1, $exit_code);
        }
    }

    public static function provider()
    {
        $projects = array(
            'pre-commit' => array(
                'empty' => true,
                'no-comma-space' => false,
                'no-vendor-prefix' => false,
                'sugarcrm' => false,
            ),
        );

        $data = array();
        foreach ($projects as $project => $fixtures) {
            foreach ($fixtures as $fixture => $expected) {
                $data[] = array($project, $fixture, $expected);
            }
        }

        return $data;
    }
}
