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
    private static $_params = array();

    public static function deploy()
    {
        Console::output("\n%BJimDeploy 1.0.0%n\n");
        Console::output("* configures your bootstrap files");
        Console::output("* configures your config files\n");

        if (Console::confirm("Start deploy project?"))
        {
            self::deployBootstrapFiles();
            self::deployConfigFiles();
        }
        else
            Console::output("\n%RDeploy aborted%n.\n");
    }

    private static function deployBootstrapFiles()
    {
        $rootPath = realpath(Config::value('yiinitializr.app.root'));
        self::$_params['{PROJECT_ROOT}'] = $rootPath . '/';
        $files = Config::value('yiinitializr.app.files.bootstrap');

        foreach( $files as $file )
        {
            $filePath = realpath($file);
            $file = str_replace('{PROJECT_ROOT}', $rootPath . '/', file_get_contents($file));
            file_put_contents($filePath, $file);
        }
    }

    private static function deployConfigFiles()
    {
        $commonConfigDir = Config::value('yiinitializr.app.directories.config.common');
        $commonConfigFiles['main'] = realpath($commonConfigDir) . '/main.php';
        $commonConfigFiles['env'] = realpath($commonConfigDir) . '/env.php';

        self::$_params['{APPLICATION NAME}'] = Console::prompt('Please, enter your application name: ', array('default' => 'JimCMF'));
        Console::output("\n%gApplication name set as '" . self::$_params['{APPLICATION NAME}'] . "'.%n");

        self::setDBConfig($commonConfigFiles['env']);
        self::setGiiConfig($commonConfigFiles['env']);
        self::setNginxConfig();
    }

    private static function setDBConfig($filePath)
    {
        $file = file_get_contents($filePath);
        $start = strpos($file,'{DB_CONNECTION}');
        if ($start === false)
        {
            Console::output("\n%rDB already configured.%n");
            return;
        }
        else
        {
            Console::output("\n%gStart DB configuration.%n\n");

            $serverHost = Console::prompt('Please, enter your MySQL server host: ', array('default' => 'localhost'));
            $serverHostPort = Console::prompt('Please, enter your MySQL server port: ', array('default' => '3306'));
            $serverDB = Console::prompt('Please, enter your db name: ', array('default' => 'JimCMF'));
            self::$_params['{DB_CONNECTION}'] = "mysql:host={$serverHost};port={$serverHostPort};dbname={$serverDB}";
            self::$_params['{DB_USER}'] = Console::prompt('Please, enter your MySQL user: ', array('default' => 'root'));
            self::$_params['{DB_PASSWORD}'] = Console::prompt('Please, enter your MySQL user password: ', array('default' => 'root'));
            self::$_params['{TABLE_PREFIX}'] = Console::prompt('Please, enter table prefix: ', array('default' => 'jim_'));

            Console::output("\n%gDB connection string set as '" . self::$_params['{DB_CONNECTION}'] . "'.%n");
            Console::output("%gDB user set as '" . self::$_params['{DB_USER}'] . "'.%n");
            Console::output("%gDB user password set as '" . self::$_params['{DB_PASSWORD}'] . "'.%n");
            Console::output("%gDB table prefix set as '" . self::$_params['{TABLE_PREFIX}'] . "'.%n");

            $file = strtr($file,self::$_params);

            Console::output("\n%gWrite DB configuration to file: '{$filePath}'.%n");
            file_put_contents($filePath, $file);

            Console::output("\n%gDB configuration process finished.%n");
        }
    }

    private static function setGiiConfig($filePath)
    {
        $file = file_get_contents($filePath);
        $start = strpos($file,'{BLOCK_GII_START}');
        if ($start === false)
        {
            Console::output("\n%rCan't find Gii block in config file. Maybe your environment is 'prod' or Gii already configured.%n");
            return;
        }
        else
        {
            if (Console::confirm("\nDo you want to use Gii?"))
            {
                $file = str_replace(array('    \'{BLOCK_GII_START}\','."\n", '    \'{BLOCK_GII_END}\','."\n"), '', $file);
                Console::output("\n%rIf you don't use password protection, then GiiModule can be accessed without password (DO NOT DO THIS UNLESS YOU KNOW THE CONSEQUENCE!!!).%n");
                if (Console::confirm("\nDo you want use Gii password protection?"))
                {
                    self::$_params['{GII_PASSWORD}'] = Console::prompt('Please, enter password for GiiModule: ', array('default' => 'JimCMF'));
                }
                else
                    $file = str_replace('\'{GII_PASSWORD}\'', 'false', $file);

                $note = "the IP filters that specify which IP addresses are allowed to access GiiModule."
                    . " Each array element represents a single filter."
                    . " A filter can be either an IP address or an address with wildcard (e.g. 192.168.0.*) to represent a network segment."
                    . " If you want to allow all IPs to access gii, you may set this property to be false (DO NOT DO THIS UNLESS YOU KNOW THE CONSEQUENCE!!!)"
                    . " The default value is array('127.0.0.1', '::1'), which means GiiModule can only be accessed on the localhost.";
                Console::output("\n%r{$note}%n");
                if (Console::confirm("\nDo you want use Gii IP filters?"))
                {
                    self::$_params['\'{GII_IPFILTER}\''] = Console::prompt('Please, enter ip list for GiiModule: ', array('default' => '\'127.0.0.1\', \'::1\''));
                    self::$_params['\'{GII_IPFILTER}\''] = 'array(' . self::$_params['\'{GII_IPFILTER}\''] . ")";
                }
                else
                    $file = str_replace('\'{GII_IPFILTER}\'', 'false', $file);
            }
            else
            {
                $start--;
                $end = strpos($file,'{BLOCK_GII_END}')+strlen('{BLOCK_GII_END}')+2;
                $block = substr($file,$start,$end-$start);
                $file = str_replace($block."\n",'',$file);
            }
            $file = strtr($file,self::$_params);
            file_put_contents($filePath, $file);
        }
    }

    private static function setNginxConfig(){
        if (Console::confirm("\nDid you need configure nginx?"))
        {
            self::$_params['{PHPCGI_PASS}'] = Console::prompt('Please, enter fastcgi_pass:', array('default' => '127.0.0.1:9000'));

            if (Console::confirm("\nDid you need configure frontend?")){
                self::$_params['{LISTEN_FRONTEND_IP}'] = Console::prompt('Please, enter listen ip:', array('default' => '*'));
                self::$_params['{LISTEN_FRONTEND_PORT}'] = Console::prompt('Please, enter listen ip:', array('default' => '80'));
                self::$_params['{LISTEN_FRONTEND_DOMAIN}'] = Console::prompt('Please, enter listen ip:', array('default' => 'LOCALHOST'));

                $configFile = self::$_params['{PROJECT_ROOT}'] . '_config/nginx/frontend.conf';
                $file = file_get_contents($configFile);
                $file = strtr($file,self::$_params);
                file_put_contents($configFile, $file);
            }
            if (Console::confirm("\nDid you need configure backend?")){
                self::$_params['{LISTEN_BACKEND_IP}'] = Console::prompt('Please, enter listen ip:', array('default' => '*'));
                self::$_params['{LISTEN_BACKEND_PORT}'] = Console::prompt('Please, enter listen ip:', array('default' => '80'));
                self::$_params['{LISTEN_BACKEND_DOMAIN}'] = Console::prompt('Please, enter listen ip:', array('default' => 'LOCALHOST'));

                $configFile = self::$_params['{PROJECT_ROOT}'] . '_config/nginx/backend.conf';
                $file = file_get_contents($configFile);
                $file = strtr($file,self::$_params);
                file_put_contents($configFile, $file);
            }
            Console::output("\n%gnginx configuration process finished.%n");
        }
        else
            Console::output("\n%gSkeep nginx configuration.%n");
    }
}