<?php

/**
 * Created by PhpStorm.
 * User: florian
 * Date: 06.03.17
 * Time: 23:05
 */

namespace Fkuhlmann\TrollhordeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Fkuhlmann\TrollhordeBundle\Models\Target;

class CheckTargetStatusCommand extends ContainerAwareCommand
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
        if ($target->hasNewTweet()) {

            /* new tweet start trolling */
            $logger->info("ok there is a new tweet on twitter, set horde in Trollmode now.");
            $theHorde->setTrollmode(TRUE);

        } else {

            $logger->info("no new tweet. everybody stay calm.");
        }

    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:checkTargetStatus')

            // the short description shown while running "php bin/console list"
            ->setDescription('Checks the status of a target. Checks if target has a new tweet, retweets, replys, etc.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command checks for new tweets and events in the targets stream.')
        ;
    }



}