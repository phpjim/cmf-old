<?php
/**
 *
 * scripts.php layout
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

/* Jquery Library */
Yii::app()->clientScript->registerScriptFile( $themeAssets . '/js/jquery.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile( $themeAssets . '/js/jquery.ui.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile( $themeAssets . '/plugins/bootstrap/bootstrap.min.js', CClientScript::POS_HEAD);
/* Modernizr Library For HTML5 And CSS3 */
Yii::app()->clientScript->registerScriptFile( $themeAssets . '/js/modernizr/modernizr.js', CClientScript::POS_HEAD);
/* Library Owl Carousel  */
Yii::app()->clientScript->registerScriptFile( $themeAssets . '/plugins/owl-carousel/owl.carousel.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile( $themeAssets . '/plugins/owl-carousel/owl.carousel.css');
Yii::app()->clientScript->registerCssFile( $themeAssets . '/plugins/owl-carousel/owl.theme.css');
Yii::app()->clientScript->registerCssFile( $themeAssets . '/plugins/owl-carousel/owl.transitions.css');
/* Select Nav */
Yii::app()->clientScript->registerScriptFile( $themeAssets . '/plugins/selectnav/selectnav.min.js', CClientScript::POS_END);
/* Fancybox plugin */
Yii::app()->clientScript->registerScriptFile( $themeAssets . '/plugins/fancybox/jquery.fancybox.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile( $themeAssets . '/plugins/fancybox/jquery.fancybox.css');
/* Library Themes Customize */
Yii::app()->clientScript->registerScriptFile( $themeAssets . '/js/caplet.custom.js', CClientScript::POS_END);
?>