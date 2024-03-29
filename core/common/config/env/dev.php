<?php
/**
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
return array(
	'modules' => array(
        '{BLOCK_GII_START}',
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '{GII_PASSWORD}',
			'ipFilters' => '{GII_IPFILTER}',
		),
        '{BLOCK_GII_END}',
	),
	'components' => array(
		// configure to suit your needs
        'db' => array(
            'connectionString' => '{DB_CONNECTION}',
            'username' => '{DB_USER}',
            'password' => '{DB_PASSWORD}',
            'tablePrefix' => '{TABLE_PREFIX}',
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'charset' => 'utf8',
        ),
	),
	'params' => array(
		'yii.handleErrors'   => true,
		'yii.debug' => true,
		'yii.traceLevel' => 3,
	)
);