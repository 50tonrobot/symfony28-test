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

        if(count($neoArray))
        {
          $NeoFetchService = $this->container->get('neo.fetchData');
          return new JsonResponse($NeoFetchService->neoCollectionAdapter($neoArray));
        }
        else
        {
          return new Response("No data loaded, please run: php /code/app/console app:fetch-neo-data");
        }
    }

    /**
     * @Route("/neo/fastest")
     */
    public function renderFastestView()
    {
        $FastFacts = $this->container->get('neo.fastFacts');
        $NeoFetchService = $this->container->get('neo.fetchData');
        $fastestNeos = $FastFacts->fetchFastest();
        if(count($fastestNeos))
        {
          return new JsonResponse($NeoFetchService->neoCollectionAdapter($fastestNeos));
        }
        else
        {
          return new Response("No data loaded, please run: php /code/app/console app:fetch-neo-data");
        }
    }
}
