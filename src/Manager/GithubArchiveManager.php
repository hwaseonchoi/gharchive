<?php

namespace App\Manager;

use App\Service\MongoDBService;

class GithubArchiveManager
{
    public $mongoDB;

    public function __construct(MongoDBService $mongoDB)
    {
        $this->mongoDB = $mongoDB;
    }

    public function countCommitAndCommentByText(string $text): array
    {
        $datas = [
            'commit' => 0,
            'comment' => 0,
            'pull_request' => 0,
        ];

        $data = $this->mongoDB->countGroupByTextType($text);
        foreach ($data as $v) {
            $datas[$v->_id] = $v->count;
        }

        return $datas;
    }

    public function findCommitsByTextAndDate(string $text, string $date = null): array
    {
        $results = [];
        $data = $this->mongoDB->findCommitsByTextAndDate($text, '2019-05-17');

        foreach($data as $v) {
            $result = [];
            $result['id'] = $v->_id;
            $result['repo_name'] = $v->repo_name;
            $result['body'] = $v->body;
            $results[] = $result;
        }

        return $results;
    }

    public function countTotalBy(string $text, string $date = null): int
    {
        return $this->mongoDB->countTotalBy($text);
    }
}
