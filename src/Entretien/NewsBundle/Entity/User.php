<?php

namespace Entretien\NewsBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Entretien\NewsBundle\Model\UserInterface;

/**
 * User
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @var integer
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
