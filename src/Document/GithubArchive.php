<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @Todo can map more fields based on process.js structure
 * @MongoDB\Document(db="test", collection="gharchive")
 */
class GithubArchive
{
    /**
     * @MongoDB\Id
     */
    public $id;

    /**
     * @MongoDB\Field(type="string", name="type")
     */
    public $eventType;

    /**
     * @MongoDB\Field(type="string", name="actor_login")
     */
    public $actorLogin;

    /**
     * @MongoDB\Field(type="string", name="repo_name")
     */
    public $repositoryName;

    /**
     * @MongoDB\Field(type="string", name="text")
     */
    public $message;

    /**
     * @MongoDB\Field(type="string", name="text_type")
     */
    public $messageType;

    /**
     * @MongoDB\Field(type="string", name="created_at")
     */
    public $createdAt;

    /**
     * @MongoDB\Field(type="string", name="pull_request_id")
     */
    public $pullRequestId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @param mixed $eventType
     */
    public function setEventType($eventType): void
    {
        $this->eventType = $eventType;
    }

    /**
     * @return mixed
     */
    public function getActorLogin()
    {
        return $this->actorLogin;
    }

    /**
     * @param mixed $actorLogin
     */
    public function setActorLogin($actorLogin): void
    {
        $this->actorLogin = $actorLogin;
    }

    /**
     * @return mixed
     */
    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @param mixed $repositoryName
     */
    public function setRepositoryName($repositoryName): void
    {
        $this->repositoryName = $repositoryName;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * @param mixed $messageType
     */
    public function setMessageType($messageType): void
    {
        $this->messageType = $messageType;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getPullRequestId()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $pullRequestId
     */
    public function setPullRequestId($pullRequestId): void
    {
        $this->pullRequestId = $pullRequestId;
    }
}
