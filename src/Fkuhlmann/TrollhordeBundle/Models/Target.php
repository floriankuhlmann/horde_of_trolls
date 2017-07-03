<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19.02.17
 * Time: 23:42
 */

namespace Fkuhlmann\TrollhordeBundle\Models;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Fkuhlmann\TrollhordeBundle\Entity\HordeApp;

class Target extends Twitteraccount
{

    /*
     * hasTargetNewTweet()
     *
     * @return Boolean
     *
     */

    public function hasNewTweet() {

        $newTweet = false;

        $logger = $this->container->get('logger');

        /* get last local saved tweet id */
        $lastSavedTweetId = $this->container
            ->get('doctrine')
            ->getRepository('FkuhlmannTrollhordeBundle:HordeApp')
            ->findOneByType('lastTargetTweetId');

        /* get last twitter-tweet id */

        /* check if ids are the same and perhaps check if twitter tweet is younger oder older than local tweet? */
        // $logger->info("lastSavedTweetId: ".$lastSavedTweetId->getValue()." this->getLastTwitterTweetId: ".$this->getLastTwitterTweetId());

        // is the tweet in storag the same like the one on twitter?
        if ($lastSavedTweetId->getValue() == $this->getLastTwitterTweetId()) {



            // yes. theres nothing to see. please go ahead.
            $newTweet = false;

            // or do we have a new tweet id?
        } else {

            // no, tweet id is different, we got a new tweet. lets start the trolling
            $newTweet = true;

        }

        /* if tweetstatus is different */

        return $newTweet;

    }


    /*
     * updateTargetLastTweetId()
     *
     * @return Boolean
     *
     */

    public function updateLastTweetId($lastTwitterTweetId) {

        $lastSavedTweetId = $this->container
            ->get('doctrine')
            ->getRepository('FkuhlmannTrollhordeBundle:HordeApp')
            ->findOneByType('lastTargetTweetId');

        // var_dump($lastSavedTweetId);

        $lastSavedTweetId->setValue($lastTwitterTweetId);

        $em = $this->container->get('doctrine.orm.entity_manager');
        $em->persist($lastSavedTweetId);
        $em->flush();

        return $this->lastTwitterTweetId;

    }



}