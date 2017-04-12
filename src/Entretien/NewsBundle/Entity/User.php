<?php

namespace Entretien\NewsBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Entretien\NewsBundle\Model\UserInterface;

/**
 * User.
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
