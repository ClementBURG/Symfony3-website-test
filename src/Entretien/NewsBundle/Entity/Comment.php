<?php

namespace Entretien\NewsBundle\Entity;

use Entretien\NewsBundle\Model\CommentInterface;
use Entretien\NewsBundle\Model\UserInterface;
use Entretien\NewsBundle\Model\AdvertInterface;

/**
 * Comment
 */
class Comment implements CommentInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var \Entretien\NewsBundle\Entity\User
     */
    private $user;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \Entretien\NewsBundle\Entity\Advert
     */
    private $advert;

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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Comment
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Comment
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set user
     *
     * @param \Entretien\NewsBundle\Entity\User $user
     *
     * @return Comment
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Entretien\NewsBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set advert
     *
     * @param \Entretien\NewsBundle\Entity\Advert $advert
     *
     * @return Comment
     */
    public function setAdvert(AdvertInterface $advert = null)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \Entretien\NewsBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }
}
