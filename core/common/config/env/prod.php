<?php
/**
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
return array(
	'components' => array(
//		configure to suit your needs
        'db' => array(
            'connectionString' => '{DB_CONNECTION}',
            'username' => '{DB_USER}',
            'password' => '{DB_PASSWORD}',
            'tablePrefix' => '{TABLE_PREFIX}',
            'enableProfiling' => false,
            'enableParamLogging' => false,
            'charset' => 'utf8',
        ),
	),
	'params' => array(
		'yii.debug' => false,
		'yii.traceLevel' => 0,
		'yii.handleErrors'   => APP_CONFIG_NAME !== 'test',
	)
);