<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CiudadController extends Controller
{
    /**
     * @Route(
     * "/ciudad/cambiar-a-{ciudad}",
     * requirements={ "ciudad" = ".+" },
     * name="ciudad_cambiar"
     * )
     */
    public function cambiarAction($ciudad)
    {
    return $this->redirectToRoute('portada', array('ciudad' => $ciudad));
    }

    public function listaCiudadesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ciudades = $em->getRepository('AppBundle:Ciudad')->findAll();

        return $this->render('ciudad/_lista_ciudades.html.twig', array(
            'ciudadActual' => $ciudad,
            'ciudades' => $ciudades
        ));
    }
}