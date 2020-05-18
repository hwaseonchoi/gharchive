<?php

namespace App\Controller;

use App\Manager\GithubArchiveManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GithubArciveMongoDBNativeController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     *
     * @param Request $request
     * @param GithubArchiveManager $githubArchiveManager
     *
     * @return Response
     */
    public function find(Request $request, GithubArchiveManager $githubArchiveManager): Response
    {
        $query = $request->query->get('q', '');
        $date = $request->query->get('date', '2019-04-01');

        $results = [
            'search' => [
                'text' => $query,
                'date' => $date
            ],
            'total' => $githubArchiveManager->countTotalBy($query),
            'message' => $githubArchiveManager->countCommitAndCommentByText($query),
            'commits' => $githubArchiveManager->findCommitsByTextAndDate($query, '2019-04-01'),
        ];

        return $this->render('index.html.twig', ['model' => $results]);
    }
}
