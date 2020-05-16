<?php

namespace App\Controller;

use App\Document\GithubArchive;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GithubArchiveByODMController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @param DocumentManager $dm
     * @return Response
     */
    public function search(Request $request, DocumentManager $dm)
    {
        $query = $request->query->get('q');

        $repo = $dm->getRepository(GithubArchive::class);

        $results = count($repo->findBy(['message' => $query]));

        return new Response($results, 200);
    }
}
