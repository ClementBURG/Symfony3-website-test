<?php

namespace Entretien\NewsBundle\Controller;

use Entretien\NewsBundle\Entity\Advert;
use Entretien\NewsBundle\Entity\Comment;
use Entretien\NewsBundle\Form\AdvertType;
use Entretien\NewsBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    const MENU_ADVERT_LIMIT = 3;

    public function indexAction(Request $req)
    {
        $listAdverts = $this->get('entretien_news.repository.advert')->findOrderByDate();

        return $this->render('EntretienNewsBundle:Advert:index.html.twig', array(
          'listAdverts' => $listAdverts
        ));
    }

    public function viewAction(Request $req, $id)
    {
        $advert = $this->get('entretien_news.repository.advert')->find($id);

        if ($advert === null) {
            throw new NotFoundHttpException("Advert with id ".$id." does not exist.");
        }

        //List of comment
        $listComments = $this->get('entretien_news.repository.comment')->findBy(array('advert' => $advert));

        return $this->render('EntretienNewsBundle:Advert:view.html.twig', array(
            'advert' => $advert,
            'listComments' => $listComments
        ));
    }

    public function addAction(Request $req)
    {
        $advert = $this->get('entretien_news.repository.advert')->createNew();
        $form = $this->get('entretien_news.form.advert');
        $form->setData($advert);

        if ($req->isMethod('POST') && $form->handleRequest($req)->isValid()) {
            $advert->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();
      
            return $this->redirectToRoute('entretien_news_view', array(
                'id' => $advert->getId()
            ));
        }
        return $this->render('EntretienNewsBundle:Advert:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $req, $id)
    {
        $advert = $this->get('entretien_news.repository.advert')->find($id);

        if ($advert === null) {
            throw new NotFoundHttpException("Advert with id ".$id." does not exist.");
        }

        $form = $this->get('entretien_news.form.advert');
        $form->setData($advert);

        if ($req->isMethod('POST') && $form->handleRequest($req)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('entretien_news_view', array(
                'id' => $advert->getId()
            ));
        }

        return $this->render('EntretienNewsBundle:Advert:edit.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView(),
        ));
    }

    public function deleteAction(Request $req, $id)
    {
        $advert = $this->get('entretien_news.repository.advert')->find($id);

        if ($advert === null) {
            throw new NotFoundHttpException("Advert with id ".$id." does not exist.");
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($advert);
        $em->flush();

        return $this->render('EntretienNewsBundle:Advert:delete.html.twig');
    }

    public function menuAction(Request $req)
    {
        $listAdverts = $this->get('entretien_news.repository.advert')->findOrderByDate(self::MENU_ADVERT_LIMIT);

        return $this->render('EntretienNewsBundle:Advert:menu.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }
}
