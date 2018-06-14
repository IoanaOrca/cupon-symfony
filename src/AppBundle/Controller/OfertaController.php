<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OfertaController extends Controller
{
    /**
    * @Route("/{ciudad}/ofertas/{slug}", name="oferta")
    */
    public function ofertaAction($ciudad, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $oferta = $em->getRepository('AppBundle:Oferta')->findOferta($ciudad, $slug);
        $relacionadas = $em->getRepository('AppBundle:Oferta')->findRelacionadas($ciudad);

        return $this->render('oferta/detalle.html.twig', array(
            'oferta' => $oferta,
            'relacionadas' => $relacionadas
        ));
    }

}