<?php

namespace Societe\Application\MonBundle\Controller;

use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Message\FutureResponse;
use GuzzleHttp\Ring\Future\BaseFutureTrait;
use GuzzleHttp\Ring\Future\FutureInterface;
use GuzzleHttp\Ring\Future\FutureValue;
use React\Promise\FulfilledPromise;
use Societe\Application\MonBundle\Service\FormationService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Class DefaultController
 * @package Societe\Application\MonBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     * @param $name
     * @return array
     */
    public function indexAction($name)
    {
        #return array('name' => $name);
        $client = new \GuzzleHttp\Client();
        $req = $client->createRequest('GET','https://ws-catapp-esup-prod.univ-rennes1.fr/domains/OUTCOM', ['future' => true]);
        $titles = array();
        $client
            ->send($req)
//            ->then(function($resp) use ($client) {
//                $apps = $resp->json()['applications'];
//                array_map(function($codeApp) use ($client) {
//                    $req = $client->createRequest('GET','https://ws-catapp-esup-prod.univ-rennes1.fr/applications/' . $codeApp,
//                        ['future' => true]);
//                    $client->send($req)->then(function($resp) {
//                        return $resp->json()['titles'];
//                    });
//                }, $apps);
//
//            })
            ->then(function($resp) { return $resp; })
            ->done(function($resp) use ($titles) { foreach ($resp as $title) array_push($titles, $title); });
        var_dump($titles);
        return array('titles'=> $titles);
    }

    /**
     * @Route("/soap")
     * @Template()
     * @param $name
     * @return array
     */
    public function soapAction()    {
        $client = $this->container->get('besimple.soap.client.harpege');
        var_dump($client);
        $structs = $client.getStructures();

//        return array('struct' => $structs[0]);
        return array();
    }

    /**
     * @return FormationService
     */
    private  function  getFormationService() {
        return $this->container->get("serviceFormation");
    }

    /**
     * @Route("/formation/{id}")
     * @Template()
     * @param $id
     * @return array
     */
    public function formationAction($id) {
        return array('formation' => $this->getFormationService()->getFormation($id));

    }

    /**
     * @Route("/check")
     * @Template()
     * @return array
     */
    public function checkAction() {
        return array();
    }
}
