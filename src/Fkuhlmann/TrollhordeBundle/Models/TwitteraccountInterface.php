<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 21.02.17
 * Time: 14:19
 */

namespace Fkuhlmann\TrollhordeBundle\Models;

use Symfony\Component\DependencyInjection\ContainerInterface;

interface TwitteraccountInterface
{
    public function __construct(ContainerInterface $container, $a_twitterConfig);
    public function connectToTwitter();
}