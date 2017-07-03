<?php

namespace Fkuhlmann\TrollhordeBundle\Entity;

/**
 * Redditpost
 */
class Redditpost
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $redditid;

    /**
     * @var string
     */
    private $subreddit;

    /**
     * @var string
     */
    private $selftext;

    /**
     * @var string
     */
    private $title;

    /**
     * @var bool
     */
    private $iscomment;

    /**
     * @var string
     */
    private $permalink;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set redditid
     *
     * @param string $redditid
     *
     * @return Redditpost
     */
    public function setRedditid($redditid)
    {
        $this->redditid = $redditid;

        return $this;
    }

    /**
     * Get redditid
     *
     * @return string
     */
    public function getRedditid()
    {
        return $this->redditid;
    }

    /**
     * Set subreddit
     *
     * @param string $subreddit
     *
     * @return Redditpost
     */
    public function setSubreddit($subreddit)
    {
        $this->subreddit = $subreddit;

        return $this;
    }

    /**
     * Get subreddit
     *
     * @return string
     */
    public function getSubreddit()
    {
        return $this->subreddit;
    }

    /**
     * Set selftext
     *
     * @param string $selftext
     *
     * @return Redditpost
     */
    public function setSelftext($selftext)
    {
        $this->selftext = $selftext;

        return $this;
    }

    /**
     * Get selftext
     *
     * @return string
     */
    public function getSelftext()
    {
        return $this->selftext;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Redditpost
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set iscomment
     *
     * @param boolean $iscomment
     *
     * @return Redditpost
     */
    public function setIscomment($iscomment)
    {
        $this->iscomment = $iscomment;

        return $this;
    }

    /**
     * Get iscomment
     *
     * @return bool
     */
    public function getIscomment()
    {
        return $this->iscomment;
    }

    /**
     * Set permalink
     *
     * @param string $permalink
     *
     * @return Redditpost
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;

        return $this;
    }

    /**
     * Get permalink
     *
     * @return string
     */
    public function getPermalink()
    {
        return $this->permalink;
    }
}

