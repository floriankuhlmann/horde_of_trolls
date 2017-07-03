<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 06.03.17
 * Time: 02:29
 */

namespace Fkuhlmann\TrollhordeBundle\Models;

use Fkuhlmann\TrollhordeBundle\Entity\Redditpost;

class Tweet
{

    public function generateStatusText() {





        /*switch(rand(1,5)) {
            case 1;
                $text = "Hey @fkuhlmann";
                break;
            case 2:
                $text = "OMG!!! @fkuhlmann gives me Doublefaceplam.";
                break;
            case 3:
                $text = "@fkuhlmann please stop!";
                break;
            case 4:
                $text = "ouhmpf @fkuhlmann tweets again.";
                break;
            case 5:
                $text = "ouhmpf @fkuhlmann go home.";
                break;
        }

        switch(rand(1,5)) {
            case 1;
                $text .= " this is so dump! #hordeoftrolls!";
                break;
            case 2:
                $text .= " look what this retard posted again! #hordeoftrolls";
                break;
            case 3:
                $text .= " what a loser he is. #hordeoftrolls";
                break;
            case 4:
                $text .= " dont tweet again. #hordeoftrolls";
                break;
            case 5:
                $text .= " go home and never come back. #hordeoftrolls";
                break;
        }*/



        return $text;

    }



}