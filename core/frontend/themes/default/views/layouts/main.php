<?php
/**
 *
 * main.php layout
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
$themeAssets = Yii::app()->assetManager->publish(Yii::app()->theme->basePath . '/assets/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $this->renderPartial('//layouts/html/head', array('themeAssets' => $themeAssets)); ?>
<?php echo $this->renderPartial('//layouts/html/scripts', array('themeAssets' => $themeAssets)); ?>
</head>
<body>
<div id="wrap">
<?php echo $this->renderPartial('//layouts/html/header', array('themeAssets' => $themeAssets)); ?>
<?php echo $content; ?>
<?php echo $this->renderPartial('//layouts/html/footer', array('themeAssets' => $themeAssets)); ?>
</div>
</body>
</html>