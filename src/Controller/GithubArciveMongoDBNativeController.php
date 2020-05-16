<?php


namespace App\Controller;

use App\Service\MongoDBService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GithubArciveMongoDBNativeController
{
    /**
     * @Route("/find", name="find")
     * @param Request $request
     * @param MongoDBService $mongoDB
     * @return Response
     */
    public function find(Request $request, MongoDBService $mongoDB)
    {
        $query = $request->query->get('q');

        $lists = $mongoDB->findBy($query);
        $count = $mongoDB->countBy($query);

        return new Response('total count : '. $count, 200);
    }
}