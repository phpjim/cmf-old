<?php
/**
 * Yiinitializr configuration file.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
$dirname = dirname(__FILE__);
$root = $dirname . '/../../../..';

return array(
	'yii' => array(
		'path' => $root . '/core/lib/vendor/yiisoft/yii/framework'
	),
	'yiinitializr' => array(
		'config' => array(
			'console' => $dirname . '/console.php'
		),
		'app' => array(
			'root' => $root,
			'directories' => array(
				'config' => array(
					'frontend' => $root . '/core/frontend/config',
					'console' => $root . '/core/console/config',
					'backend' => $root . '/core/backend/config',
					'common' => $root . '/core/common/config',
					'api' => $root . '/core/api/config'
				),
				'runtime' => array(
					'frontend' => $root . '/core/runtime/frontend',
					'console' => $root . '/core/runtime/console',
					'backend' => $root . '/core/runtime/backend',
					'api' => $root . '/core/runtime/api'
				),
				'assets' => array(
					$root . '/htdocs/frontend',
					$root . '/htdocs/backend',
				)
			),
			'files' => array(
				// files to merge the main configuration file with
				'config' => array(
					'frontend' => array('env', 'local'),
					'console' => array('env', 'local'),
					'backend' => array('env', 'local'),
					'common' => array('env', 'local'),
					'api' => array('env', 'local')
				)
			),
			/*
			 * uncomment this lines to provide custom class for web and/or console
			'web' => array(
				'class' => $root . '/common/components/GWebApplication.php'
			),
			'console' => array(
				'class' => $root . '/common/components/GConsoleApplication.php'
			),
			*/
		),
	)
);
