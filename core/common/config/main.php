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
	'aliases' => array(
        'frontend' => JIM_ROOT . 'core/frontend',
        'common' => JIM_ROOT . 'core/common',
        'backend' => JIM_ROOT . 'core/backend',
        'vendor' => JIM_ROOT . 'core/lib/vendor',
	),
	'import' => array(),
	'components' => array(
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class'  => 'CLogRouter',
			'routes' => array(
				array(
					'class'        => 'CDbLogRoute',
					'connectionID' => 'db',
					'levels'       => 'error, warning',
				),
			),
		),
	),
	// application parameters
	'params' => array(
		// php configuration
		'php.defaultCharset' => 'utf-8',
		'php.timezone'       => 'UTC',
	),
);
