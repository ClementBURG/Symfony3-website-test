<?php

namespace Entretien\NewsBundle\Listener;

use Entretien\NewsBundle\Model\CommentInterface;
use Entretien\NewsBundle\Provider\CommentProvider;
use Symfony\Component\EventDispatcher\GenericEvent;

class CommentListener
{
    protected $commentProvider;

    public function __construct(CommentProvider $commentProvider)
    {
        $this->commentProvider = $commentProvider;
    }

    public function onCommentCreated(GenericEvent $event)
    {
        if ($event->getSubject() instanceof CommentInterface) {
            $comment = $event->getSubject();

            $this->commentProvider->updateNbCommentInAdvert($comment);
            $this->commentProvider->save($comment);
        }
    }
}
