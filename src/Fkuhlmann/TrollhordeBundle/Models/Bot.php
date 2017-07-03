<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19.02.17
 * Time: 23:42
 */

namespace Fkuhlmann\TrollhordeBundle\Models;


class Bot extends Twitteraccount
{

    public function postTweet($tweetid = NULL) {

        $tweetstatus = "tweet_non";
        $tweet = New Tweet();

        if ($tweetid == NULL) {
            $status = $this->connection->post("statuses/update", ["status" => "hello @fkuhlmann we still follow you now.".rand(1,50000)]);

        } else {

            echo "tweetid".$tweetid."<br>";

            $status = $this->connection->post("statuses/update", [
                "status" => $tweet->generateStatusText(),
                "in_reply_to_status_id" => $tweetid
            ]);

            $favstatus = $this->connection->post("favorites/create", [
                "id" => $tweetid
            ]);

        }

        if ($this->connection->getLastHttpCode() == 200) {
            // Tweet posted succesfully
            $tweetstatus = "tweet_success";
        } else {
            // Handle error case
            $tweetstatus = "tweet_error";
        }

        return $tweetstatus;

    }



}