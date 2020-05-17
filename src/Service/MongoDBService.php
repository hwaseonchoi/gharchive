<?php


namespace App\Service;


use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Driver\Cursor;

class MongoDBService
{
    private const BASE_NAME = 'test';
    private const GHARCHIVE_COLLECTION = 'gharchive';

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

    public function countBy(string $param): int
    {
        $ghArchiveCollection = $this->getCollection(self::GHARCHIVE_COLLECTION);

        return $ghArchiveCollection->countDocuments([ '$text' => ['$search' => $param]]);
    }
}