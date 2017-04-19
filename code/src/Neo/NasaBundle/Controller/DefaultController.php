<?php

namespace Neo\NasaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Neo\NasaBundle\Document\Neo;
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
     * @Method("POST")
     */
     public function createAction()
     {
         $params = array();
         $content = $this->get("request")->getContent();
         if (!empty($content))
         {
             $params = json_decode($content, true);
         }

         if(isset($params["KilometersPerHour"]))
         {
           $neo = new Neo();
           $neo->setNeoReferenceId($params["NeoReferenceId"]);
           $neo->setDate($params["Date"]);
           $neo->setName($params["Name"]);
           $neo->setKilometersPerHour($params["KilometersPerHour"]);
           $neo->setIsPotentiallyHazardousAsteroid($params["IsPotentiallyHazardousAsteroid"]);

           $dm = $this->get('doctrine_mongodb')->getManager();
           $dm->persist($neo);
           $dm->flush();

           error_log("I am still here");
           error_log(print_r($dm,1));           

           return new Response('Created Neo id '.$neo->getId());
         }
     }

    /**
     * @Route("/neo")
     * @Method("GET")
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
