<?php

namespace Neo\NasaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/nasa")
     */
    public function indexAction()
    {
        return $this->render('NasaBundle:Default:index.html.twig');
    }
}
