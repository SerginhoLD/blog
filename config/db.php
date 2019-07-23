<?php
use UltraLite\Container\Container;
use RedBeanPHP\R;

/**
 * @var string $projectDir
 * @var Container $di
 */

define('REDBEAN_MODEL_PREFIX', '\\Blog\\Model\\');

R::setup('sqlite:/' . $projectDir . '/blog.sqlite');
