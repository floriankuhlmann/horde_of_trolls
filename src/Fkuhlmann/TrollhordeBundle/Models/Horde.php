<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 21.02.17
 * Time: 18:33
 */

namespace Fkuhlmann\TrollhordeBundle\Models;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Fkuhlmann\TrollhordeBundle\Entity;

class Horde
{

    private $container;
    private $config;
    private $target;
    private $trollmode;

    private $a_Horde;

    public function __construct(ContainerInterface $container) {

        $this->container = $container;

    }



    /*
     * hasTargetNewTweet()
     *
     * @return Boolean
     *
     */

    public function hasTargetNewTweet() {

        return $this->target->hasNewTweet();

    }


    /*
     * updateTargetLastTweetId()
     *
     * @return Boolean
     *
     */

    public function updateTargetLastTweetId() {

        return $this->target->updateLastTweetId();

    }


    /*
     * trollNow()
     *
     * @return array status
     *
     */

    public function trollNow() {

        $i=0;
        while ($i < sizeof($this->a_Horde)) {
            if (rand(0,10) > 3) {
                $status[] = $this->a_Horde[$i]->postTweet($this->target->getLastTwitterTweetId());
            }
            $i++;
        }

        return $status;

    }


    /**
     * @return mixed
     */
    public function getAHorde()
    {
        return $this->a_Horde;
    }

    /**
     * @param mixed $a_Horde
     */
    public function setAHorde(array $a_Horde)
    {
        $this->a_Horde = $a_Horde;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * @return Target
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param Target $target
     */
    public function setTarget($target)
    {

        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getTrollmode()
    {

        /* get last local saved tweet id */
        $HordeAppTrollmode = $this->container
            ->get('doctrine')
            ->getRepository('FkuhlmannTrollhordeBundle:HordeApp')
            ->findOneByType('trollmode');

        return $HordeAppTrollmode->getValue('trollmode');

    }

    /**
     * @param mixed $trollmode
     *
     */
    public function setTrollmode($trollmode)
    {
        $this->trollmode = $trollmode;

        $HordeAppTrollmode = $this->container
            ->get('doctrine')
            ->getRepository('FkuhlmannTrollhordeBundle:HordeApp')
            ->findOneByType('trollmode');

        // var_dump($lastSavedTweetId);

        $HordeAppTrollmode->setValue($this->trollmode);

        $em = $this->container->get('doctrine.orm.entity_manager');
        $em->persist($HordeAppTrollmode);
        $em->flush();

        return $this->trollmode;


    }


}