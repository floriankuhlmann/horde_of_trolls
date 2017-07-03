<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 20.02.17
 * Time: 18:48
 */

namespace Fkuhlmann\TrollhordeBundle\Helper;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;


class YamlLoader extends FileLoader
{
    public function load($resource, $type = null)
    {
        $configValues = Yaml::parse(file_get_contents($resource));
        return $configValues;

    }

    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }

}