<?php
/**
 * Bootstrap index file
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
define("JIM_ROOT", "{PROJECT_ROOT}");

require(JIM_ROOT . 'core/lib/vendor/autoload.php');

Yiinitializr\Helpers\Initializer::create(JIM_ROOT .'core/', 'frontend', array(
    JIM_ROOT . 'core/common/config/main.php',
    JIM_ROOT . 'core/common/config/env.php',
    JIM_ROOT . 'core/common/config/local.php'
))->run();