<?php

namespace Neo\NasaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Neo\NasaBundle\Document\Neo;
use Neo\NasaBundle\Repository\NeoRepository;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function helloAction()
    {
      return new JsonResponse(array('hello' => 'world'));
    }

    /**
     * @Route("/neo/hazardous")
     */
    public function renderHazardousView()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $neoArray = $dm->getRepository('NasaBundle:Neo')->findBy(
            array('is_potentially_hazardous_asteroid' => true)
        );
        $NeoFetchService = $this->container->get('neo.fetchData');
        return new JsonResponse($NeoFetchService->neoCollectionAdapter($neoArray));
    }

    /**
     * @Route("/neo/fastest")
     */
    public function renderFastestView()
    {
        $FastFacts = $this->container->get('neo.fastFacts');
        $NeoFetchService = $this->container->get('neo.fetchData');
        return new JsonResponse($NeoFetchService->neoCollectionAdapter($FastFacts->fetchFastest()));
    }
}
