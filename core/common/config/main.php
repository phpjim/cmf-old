<?php
/**
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
@defined(JIM_ROOT) or @define(JIM_ROOT, realpath(__DIR__ . "/../../../"));

return array(
	'name' => '{APPLICATION NAME}',
	'preload' => array('log'),
    'sourceLanguage'    => 'en',
	'aliases' => array(
        'frontend' => JIM_ROOT . 'core/frontend',
        'common' => JIM_ROOT . 'core/common',
        'backend' => JIM_ROOT . 'core/backend',
        'vendor' => JIM_ROOT . 'core/lib/vendor',
	),
	'import' => array(),
	'components' => array(
        'authManager'=>array(
            'class'=>'\\common\\components\\CDbAuthManager',
        ),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
        'EntityManager' => array(
            'class'=>'\\common\\components\\EntityManager'
        ),
		'log' => array(
			'class'  => 'CLogRouter',
			'routes' => array(
                array(
                    'class'        => 'CDbLogRoute',
                    'connectionID' => 'db',
                    'logTableName' => '{{syslog}}',
                    'levels'       => 'error, warning',
                ),
			),
		),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
        ),
	),
	// application parameters
	'params' => array(
		// php configuration
		'php.defaultCharset' => 'utf-8',
		'php.timezone'       => 'UTC',
	),
);
