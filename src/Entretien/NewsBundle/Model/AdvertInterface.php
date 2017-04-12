<?php

namespace Entretien\NewsBundle\Model;

interface AdvertInterface
{
    public function getId();

    public function setCreated($created);

    public function getCreated();

    public function setUpdated($updated);

    public function getUpdated();

    public function setUser(UserInterface $user);

    public function getUser();

    public function setTitle($title);

    public function getTitle();

    public function setContent($content);

    public function getContent();

    public function setNbComment($nbComment);

    public function getNbComment();
}
