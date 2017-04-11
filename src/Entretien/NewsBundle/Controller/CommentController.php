<?php

namespace Entretien\NewsBundle\Controller;

use Entretien\NewsBundle\Entity\Advert;
use Entretien\NewsBundle\Entity\Comment;
use Entretien\NewsBundle\NewsEvents;
use Entretien\NewsBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\GenericEvent;

class CommentController extends Controller
{
    public function addCommentAction(Request $req, $id)
    {
        $advert = $this->get('entretien_news.repository.advert')->find($id);

        if ($advert === null) {
            throw new NotFoundHttpException("Advert with id ".$id." does not exist.");
        }

        $comment = $this->get('entretien_news.repository.comment')->createNew();
        $comment->setAdvert($advert);
        $comment->setUser($this->getUser());

        $form = $this->get('entretien_news.form.comment');
        $form->setData($comment);

        if ($req->isMethod('POST') && $form->handleRequest($req)->isValid()) {
            $this->get('event_dispatcher')->dispatch(NewsEvents::PRE_CREATE_COMMENT, new GenericEvent($comment));

            return $this->redirectToRoute('entretien_news_view', array(
                'id' => $id,
            ));
        }

        return $this->render('EntretienNewsBundle:Comment:form.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
        ));
    }
}
