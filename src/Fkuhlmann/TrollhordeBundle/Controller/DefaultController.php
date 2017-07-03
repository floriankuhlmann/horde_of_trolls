<?php

namespace Fkuhlmann\TrollhordeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fkuhlmann\TrollhordeBundle\Models\Bot;
use Fkuhlmann\TrollhordeBundle\Models\Target;
use Fkuhlmann\TrollhordeBundle\Models\Horde;
use Fkuhlmann\TrollhordeBundle\Entity\HordeApp;
use Fkuhlmann\TrollhordeBundle\Entity\Redditpost;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $logger = $this->get('logger');
        $logger->info('I just got the logger');

        /* instantiate the trolltarget */
        $target = new Target($this->container, $this->container->getParameter('fkuhlmann_trollhorde.twitter.target'));

        /* controll system for the horde */
        $theHorde = $this->container->get('fkuhlmann_trollhorde.horde');
        $theHorde->setTarget($target);

        /* check twitterstatus of target account */
        if ($target->hasNewTweet()) {

            /* new tweet start trolling */
            echo "<h1>ok there is a new tweet on twitter, set horde in Trollmode now</h1>";
            $theHorde->setTrollmode(TRUE);

        } else {

            echo "<h1>no new tweet. everybody stay calm</h1>";
        }

        /* no new tweets or status updates go to sleep again */
        return $this->render('FkuhlmannTrollhordeBundle:Default:index.html.twig');
    }


    public function trollTargetAction() {

        /* instantiate the trolltarget */
        $target = new Target($this->container, $this->container->getParameter('fkuhlmann_trollhorde.twitter.target'));

        /* controll system for the horde */
        $theHorde = $this->container->get('fkuhlmann_trollhorde.horde');
        $theHorde->setTarget($target);

        /* check twitterstatus of target account */
        if ($theHorde->getTrollmode()) {

            /* new tweet start trolling */
            echo "<h1>Horde is in trollmode, troll target now.</h1>";

            /* get the configs for all bots of the horde */
            $a_allBotsConfig = $this->container->getParameter('fkuhlmann_trollhorde.twitter.bots');

            /* and then instantiate all bots of the horde */
            foreach($a_allBotsConfig as $a_BotConfig ) {

                $a_Bot[] = new Bot($this->container, $a_BotConfig);

            }

            $theHorde->setAHorde($a_Bot);
            $status = $theHorde->trollNow();

            print_r($status);

        } else {

            var_dump($target->getLastTweets());

        }

        return $this->render('FkuhlmannTrollhordeBundle:Default:index.html.twig');

    }


    public function getRedditAction($parameter)
    {

        $subreditJson = file_get_contents('https://www.reddit.com/r/' . $parameter . '.json');
        $subreditObj = json_decode($subreditJson);


        $redditpostRepo = $this->container
            ->get('doctrine')
            ->getRepository('FkuhlmannTrollhordeBundle:Redditpost');

        foreach ($subreditObj->data->children as $subreditChild) {
            //$subreditChild = $subreditObj->data->children[2];

            echo "<h2>" . $subreditChild->data->id . "</h2>";

            // https://www.reddit.com/r/insults/5zaqlm.json
            $children_json = json_decode(file_get_contents('https://www.reddit.com/r/' . $parameter . '/' . $subreditChild->data->id . '.json'));

            // var_dump($children_json);


            $data = $children_json[0]->data->children[0]->data;

            if ($redditpostRepo->findOneByRedditid($subreditChild->data->id) == NULL) {

                echo "<h3>no " . $subreditChild->data->id . " in database</h3>";




                echo $data->selftext;
                echo "<br>";
                echo $data->title;
                echo "<br>";
                echo $data->permalink;
                echo "<br>";
                echo "new entry:" . $data->id;
                $redditpost = new Redditpost();

            } else {

                echo "update entry:" . $data->id;
                $redditpost = $redditpostRepo->findOneByRedditid($subreditChild->data->id);

            }

            $redditpost->setRedditid($data->id);
            $redditpost->setSubreddit($data->subreddit);
            $redditpost->setSelftext($data->selftext);
            $redditpost->setTitle($data->title);
            $redditpost->setIscomment(FALSE);
            $redditpost->setPermalink($data->permalink);

            $em = $this->container->get('doctrine.orm.entity_manager');
            $em->persist($redditpost);
            $em->flush();

        }
            // https://www.reddit.com/r/insults/5zaqlm.json

            /*$redditpost = new Redditpost();
            $redditpost->setRedditid()
        */

            //var_dump(json_decode($children_json));

        //

        /*$HordeAppTrollmode = $this->container
            ->get('doctrine')
            ->getRepository('FkuhlmannTrollhordeBundle:HordeApp')
            ->findOneByType('trollmode');

        // var_dump($lastSavedTweetId);

        $HordeAppTrollmode->setValue($this->trollmode);

        $em = $this->container->get('doctrine.orm.entity_manager');
        $em->persist($HordeAppTrollmode);
        $em->flush();

        */
        //var_dump($obj1->data->children);

        /*$json2 = file_get_contents('https://www.reddit.com/r/insults.json?after=t3_5v0lbc');
        $obj2 = json_decode($json2);

        var_dump($obj2);
        */
        /* no new tweets or status updates go to sleep again */
        return $this->render('FkuhlmannTrollhordeBundle:Default:index.html.twig');
    }


}
