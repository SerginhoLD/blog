<?php
namespace PHPSTORM_META
{
    // https://gist.github.com/bcremer/be2a558a452d4f45dc04994ffe7b8292
    // https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata

    override(\Psr\Container\ContainerInterface::get(0), map([
        '' => '@',
    ]));
}
