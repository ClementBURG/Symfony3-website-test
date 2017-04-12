<?php

namespace Tests\Listener;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;
use Entretien\NewsBundle\NewsEvents;
use Entretien\NewsBundle\Listener\CommentListener;
use Entretien\NewsBundle\Provider\CommentProvider;
use Entretien\NewsBundle\Model\CommentInterface;
use PHPUnit\Framework\TestCase;

class CommentListenerTest extends TestCase
{
    private $dispatcher;
    private $commentInterface;
    private $event;
    private $commentProvider;
    private $commentListener;

    protected function setUp()
    {
        $this->dispatcher = new EventDispatcher();
        $this->commentInterface = $this->createMock(CommentInterface::class);
        $this->event = $this->createMock(GenericEvent::class);
        $this->commentProvider = $this->createMock(CommentProvider::class);
        $this->commentListener = new CommentListener($this->commentProvider);
    }

    protected function tearDown()
    {
        $this->dispatcher = null;
        $this->event = null;
        $this->commentProvider = null;
        $this->commentListener = null;
    }

    public function testOnCommentCreatedShouldCallOnceUpdateNbCommentInAdvert()
    {
        $this->commentProvider->expects($this->once())
                                ->method('updateNbCommentInAdvert')
                                ->with($this->isInstanceOf(CommentInterface::class));
        $this->event->method('getSubject')
                    ->will($this->returnValue($this->commentInterface));
        $this->dispatcher->addListener(NewsEvents::PRE_CREATE_COMMENT, array($this->commentListener, 'onCommentCreated'), 1);
        $this->dispatcher->dispatch(NewsEvents::PRE_CREATE_COMMENT, $this->event);
    }
}