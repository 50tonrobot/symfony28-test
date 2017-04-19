<?php

namespace Neo\NasaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

//this shouldn't be here
use Guzzle\Http\Client;

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
     * @Route("/neo")
     */
    public function getNeoAction()
    {

      // Create a client and provide a base URL
      $client = new Client('https://api.nasa.gov/neo/rest/v1');

      $request = $client->get('feed?start_date=2017-03-01&end_date=2017-03-05&detailed=true&api_key=N7LkblDsc5aen05FJqBQ8wU4qSdmsftwJagVK7UD');

      $response = $request->send();

      $output = new Response($response->getBody());
      $output->headers->set('Content-Type', 'application/json');

      return $output;
    }
}
