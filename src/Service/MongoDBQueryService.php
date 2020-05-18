<?php

namespace App\Service;

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Driver\Cursor;

class MongoDBQueryService
{
    private const BASE_NAME = 'test';
    private const GHARCHIVE_COLLECTION = 'gharchive';

    public const PUSH_EVENT = 'PushEvent';

    private $database;

    public function __construct(string $connection)
    {
        $client = new Client($connection);
        $this->database = $client->{self::BASE_NAME};
    }

    public function getCollection($name): Collection
    {
        return $this->database->{$name};
    }

    public function findBy(string $param): Cursor
    {
        $ghArchiveCollection = $this->getCollection(self::GHARCHIVE_COLLECTION);

        return $ghArchiveCollection->find(['$text' => ['$search' => $param]]);
    }

    public function countTotalBy(string $param, string $date): int
    {
        $ghArchiveCollection = $this->getCollection(self::GHARCHIVE_COLLECTION);

        return $ghArchiveCollection->countDocuments(
            [
                '$text' => ['$search' => $param],
                'created_at' => [
                    '$regex' => '^'.$date
                ]
            ]
        );
    }

    public function countGroupByTextType(string $param, string $date): \Traversable
    {
        $ghArchiveCollection = $this->getCollection(self::GHARCHIVE_COLLECTION);

        return $ghArchiveCollection->aggregate([
            [
                '$match' => [
                    '$text' => ['$search' => $param],
                    'created_at' => [
                        '$regex' => '^'.$date
                    ]
                ]
            ],
            [
                '$group' => [
                    '_id' => '$message_type',
                    'count' => [ '$sum' => 1 ]
                ]
            ]
        ]);
    }

    public function findCommitsByTextAndDate(string $text, string $date): Cursor
    {
        $ghArchiveCollection = $this->getCollection(self::GHARCHIVE_COLLECTION);

        return $ghArchiveCollection->find(
            [
                '$text' => ['$search' => $text],
                'type'=> self::PUSH_EVENT,
                'created_at' => [
                    '$regex' => '^'.$date
                ]
            ],
            [
                'limit' => 5,
            ]
        );
    }
}
