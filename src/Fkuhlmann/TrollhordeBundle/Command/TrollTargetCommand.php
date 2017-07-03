<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 06.03.17
 * Time: 23:56
 */

// src/AppBundle/Command/CreateUserCommand.php
namespace Fkuhlmann\TrollhordeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Fkuhlmann\TrollhordeBundle\Models\Bot;
use Fkuhlmann\TrollhordeBundle\Models\Target;

class TrollTargetCommand extends ContainerAwareCommand
{

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $logger = $this->getContainer()->get('logger');

        /* instantiate the trolltarget */
        $target = new Target($this->getContainer(), $this->getContainer()->getParameter('fkuhlmann_trollhorde.twitter.target'));

        /* controll system for the horde */
        $theHorde = $this->getContainer()->get('fkuhlmann_trollhorde.horde');
        $theHorde->setTarget($target);

        /* check twitterstatus of target account */
        if ($theHorde->getTrollmode()) {

            /* new tweet start trolling */
            $logger->info("Horde is in trollmode, troll target now.");

            /* get the configs for all bots of the horde */
            $a_allBotsConfig = $this->getContainer()->getParameter('fkuhlmann_trollhorde.twitter.bots');

            /* and then instantiate all bots of the horde */
            foreach($a_allBotsConfig as $a_BotConfig ) {

                $a_Bot[] = new Bot($this->getContainer(), $a_BotConfig);

            }

            $theHorde->setAHorde($a_Bot);
            $status = $theHorde->trollNow();

            // print_r($status);

        } else {

            var_dump($target->getLastTweets());

        }

        if (rand(0,10) > 7) {

            $theHorde->setTrollmode(FALSE);
            /* new tweet start trolling */
            $logger->info("last tweet id:".$target->getLastTwitterTweetId());
            $target->updateLastTweetId($target->getLastTwitterTweetId());
            $logger->info("Ok trollmode off now again.");

        }

    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:trollTarget')

            // the short description shown while running "php bin/console list"
            ->setDescription('Posts trolling tweets from the horde.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This commands posts a random amount of tweets.')
        ;
    }



}