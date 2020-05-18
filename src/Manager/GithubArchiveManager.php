<?php

namespace App\Manager;

use App\Service\MongoDBQueryService;

class GithubArchiveManager
{
    public $mongoDB;

    public function __construct(MongoDBQueryService $mongoDB)
    {
        $this->mongoDB = $mongoDB;
    }

    public function countCommitAndCommentByText(string $text, string $date): array
    {
        $datas = [
            'commit' => 0,
            'comment' => 0,
            'pull_request' => 0,
        ];

        $data = $this->mongoDB->countGroupByTextType($text, $date);
        foreach ($data as $v) {
            $datas[$v->_id] = $v->count;
        }

        return $datas;
    }

    public function findCommitsByTextAndDate(string $text, string $date): array
    {
        $results = [];
        $data = $this->mongoDB->findCommitsByTextAndDate($text, $date);

        foreach($data as $v) {
            $result = [];
            $result['id'] = $v->_id;
            $result['repo_name'] = $v->repo_name;
            $result['body'] = $v->body;
            $result['body_url'] = $v->body_url;
            $result['repo_url'] = $v->repo_url;
            $results[] = $result;
        }

        return $results;
    }

    public function countTotalBy(string $text, string $date): int
    {
        return $this->mongoDB->countTotalBy($text, $date);
    }
}
