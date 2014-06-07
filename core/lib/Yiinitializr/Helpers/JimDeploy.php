<?php
/**
 * JimDeploy class file.
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace Yiinitializr\Helpers;

use Yiinitializr\Helpers\Config;
use Yiinitializr\Helpers\ArrayX;
use Yiinitializr\Cli\Console;

/**
 * JimDeploy
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @package Yiinitializr.helpers
 * @since 1.1
 */
class JimDeploy
{
    public static function deploy(){
        self::deployBootstrapFiles();
        self::deployDbConfig();
    }

    private static function deployBootstrapFiles(){
        $rootPath = realpath(Config::value('yiinitializr.app.root'));
        $files = Config::value('yiinitializr.app.files.bootstrap');

        foreach( $files as $file ){
            $filePath = realpath($file);
            $file = str_replace('{{projectRoot}}', $rootPath . '/', file_get_contents($file));
            file_put_contents($filePath, $file);
        }
    }

    private static function deployDbConfig(){

    }
}