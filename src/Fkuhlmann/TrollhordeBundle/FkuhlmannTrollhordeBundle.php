<?php

namespace Fkuhlmann\TrollhordeBundle;

use Fkuhlmann\TrollhordeBundle\Models\Horde;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Config\FileLocator;
use Fkuhlmann\TrollhordeBundle\Entity\HordeApp;

class FkuhlmannTrollhordeBundle extends Bundle
{

    public function __construct() {

        $this->setup();

    }

    private function setup() {

    }


}
