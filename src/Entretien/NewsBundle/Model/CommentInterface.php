<?php

namespace Entretien\NewsBundle\Model;

use Entretien\NewsBundle\Model\UserInterface;
use Entretien\NewsBundle\Model\AdvertInterface;

interface CommentInterface
{
    public function getId();
	public function setCreated($created);
	public function getCreated();
	public function setUpdated($updated);
	public function getUpdated();
    public function setUser(UserInterface $user);
	public function getUser();
    public function setContent($content);
    public function getContent();
    public function setAdvert(AdvertInterface $advert);
    public function getAdvert();
}