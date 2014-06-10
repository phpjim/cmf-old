<?php
/**
 *
 * head.php layout
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
?>
<meta charset="utf-8">
<?php Yii::app()->clientScript->registerMetaTag('width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"', 'viewport'); ?>
<title><?php echo $this->pageTitle; ?></title>
<?php Yii::app()->clientScript->registerLinkTag('apple-touch-icon-precomposed', null, $themeAssets . '/ico/apple-touch-icon-144-precomposed.png', null, array("sizes"=>"144x144")); ?>
<?php Yii::app()->clientScript->registerLinkTag('apple-touch-icon-precomposed', null, $themeAssets . '/ico/apple-touch-icon-114-precomposed.png', null, array("sizes"=>"114x114")); ?>
<?php Yii::app()->clientScript->registerLinkTag('apple-touch-icon-precomposed', null, $themeAssets . '/ico/apple-touch-icon-72-precomposed.png', null, array("sizes"=>"72x72")); ?>
<?php Yii::app()->clientScript->registerLinkTag('apple-touch-icon-precomposed', null, $themeAssets . '/ico/apple-touch-icon-57-precomposed.png'); ?>
<?php Yii::app()->clientScript->registerLinkTag('shortcut icon', 'image/x-icon', $themeAssets . '/ico/favicon.ico'); ?>
<?php Yii::app()->clientScript->registerMetaTag('', 'description'); ?>
<?php Yii::app()->clientScript->registerMetaTag('', 'keywords'); ?>
<?php Yii::app()->clientScript->registerCssFile( $themeAssets . '/css/bootstrap/bootstrap.min.css'); ?>
<?php Yii::app()->clientScript->registerCssFile( $themeAssets . '/css/bootstrap/bootstrap-themes.css'); ?>
<?php Yii::app()->clientScript->registerCssFile( $themeAssets . '/css/style.css'); ?>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
