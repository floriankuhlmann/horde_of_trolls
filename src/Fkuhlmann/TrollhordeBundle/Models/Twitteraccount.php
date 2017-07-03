<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19.02.17
 * Time: 23:40
 */

namespace Fkuhlmann\TrollhordeBundle\Models;

use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\DependencyInjection\ContainerInterface;


class Twitteraccount implements TwitteraccountInterface
{

    private $owner;
    private $owner_id;
    private $consumer_key;
    private $consumer_secret;
    private $access_token;
    private $access_token_secret;
    private $a_twitterConfig;
    protected $container;
    protected $lastTwitterTweetId;

    public function __construct(ContainerInterface $container, $a_twitterConfig)
    {

        $this->container = $container;

        // all config data in one array
        $this->a_twitterConfig = $a_twitterConfig;

        //
        $this->owner = $a_twitterConfig['owner'];
        $this->owner_id = $a_twitterConfig['owner_id'];
        $this->consumer_key = $a_twitterConfig['consumer_key'];
        $this->consumer_secret = $a_twitterConfig['consumer_secret'];
        $this->access_token = $a_twitterConfig['access_token'];
        $this->access_token_secret = $a_twitterConfig['access_token_secret'];

        $this->connection = new TwitterOAuth(
            $this->consumer_key,
            $this->consumer_secret,
            $this->access_token,
            $this->access_token_secret
        );

    }

    public function connectToTwitter() {

        return $this->connection = new TwitterOAuth(
            $this->consumer_key,
            $this->consumer_secret,
            $this->access_token,
            $this->access_token_secret
        );
    }


    /**
     * getLastTweets
     *
     * @param	int	    $count		Number of tweet
     * @return	object Json-Object with tweet data
     *
     */

    public function getLastTweets($count = 1)
    {
        return $this->connection->get("statuses/user_timeline", ["count" => $count, "exclude_replies" => false, "screen_name" => $this->owner]);
    }


    /**
     * getLastTweetId()
     *
     * @return	int     id of last tweet on twitter
     *
     */

    public function getLastTwitterTweetId()
    {
        $tweet = $this->connection->get("statuses/user_timeline", ["count" => 1, "exclude_replies" => false, "screen_name" => $this->owner]);
        return $tweet[0]->id;
    }



    /* the standard getter und setter methods */

    /**
     * @return array
     */
    public function getATwitterConfig()
    {
        return $this->a_twitterConfig;
    }

    /**
     * @param mixed $a_twitterConfig
     */
    public function setATwitterConfig($a_twitterConfig)
    {
        $this->a_twitterConfig = $a_twitterConfig;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * @return mixed
     */
    public function getAccessTokenSecret()
    {
        return $this->access_token_secret;
    }

    /**
     * @param mixed $access_token_secret
     */
    public function setAccessTokenSecret($access_token_secret)
    {
        $this->access_token_secret = $access_token_secret;
    }

    /**
     * @return mixed
     */
    public function getConsumerKey()
    {
        return $this->consumer_key;
    }

    /**
     * @param mixed $consumer_key
     */
    public function setConsumerKey($consumer_key)
    {
        $this->consumer_key = $consumer_key;
    }

    /**
     * @return mixed
     */
    public function getConsumerSecret()
    {
        return $this->consumer_secret;
    }

    /**
     * @param mixed $consumer_secret
     */
    public function setConsumerSecret($consumer_secret)
    {
        $this->consumer_secret = $consumer_secret;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * @param mixed $owner_id
     */
    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
    }



}