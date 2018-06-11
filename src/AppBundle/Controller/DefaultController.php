<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/sitio/{nombrePagina}/")
     */
    public function paginaAction($nombrePagina)
    {
        return $this->render('sitio/'.$nombrePagina.'.html.twig');
    }

    /**
     * @Route(
     *     "/{ciudad}",
     *     defaults = {"ciudad" = "%app.ciudad_por_defecto%" },
     *     name="portada"
     * )
     *  @Route("/")
     */
    public function portadaAction($ciudad)
    {
        if (null === $ciudad) {
            return new RedirectResponse(
                $this->generateUrl('portada', array('ciudad' => $this->getParameter('app.ciudad_por_defecto')))
            );
        }

        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('AppBundle:Oferta')->findOneBy(array(
            'ciudad' => $this->getParameter('app.ciudad_por_defecto'),
            'fechaPublicacion' => new \DateTime('today')
        ));

        if (!$oferta) {
            throw $this->createNotFoundException(
                'No se ha encontrado la oferta del día en la ciudad seleccionad
a'
            );
        }

        return $this->render('portada.html.twig', array(
            'oferta' => $oferta
        ));
    }


}