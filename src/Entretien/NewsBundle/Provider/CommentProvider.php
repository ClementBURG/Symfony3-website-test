<?php

namespace Entretien\NewsBundle\Provider;

use Doctrine\ORM\EntityManager;
use Entretien\NewsBundle\Model\CommentInterface;

class CommentProvider
{
	protected $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function incrementNbComment(int $nb)
	{
		return $nb + 1;
	}

	public function save(CommentInterface $comment)
	{
		$this->em->persist($comment);
		$this->em->flush();
	}

	public function updateNbCommentInAdvert(CommentInterface $comment)
	{
		$advert = $comment->getAdvert();

		$nb = $advert->getNbComment();
		$nb = $this->incrementNbComment($nb);

		$advert->setNbComment($nb);
	}
}