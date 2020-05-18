// Import commit messages in the collection gharchive_raw
db.gharchive_raw.aggregate(
    {
        "$unwind": "$payload.commits"
    },
    {
        "$project": {
            _id: "$payload.commits.sha",
            "type" : 1,
            "actor_login" : "$actor.login",
            "repo_name" : "$repo.name",
            "repo_url" : "$repo.url",
            "body" : "$payload.commits.message",
            "body_url" : "$payload.commits.url",
            "message_type" : "commit", // type de message
            "created_at": "$created_at"
        }
    },
    {
        "$merge": { into: "gharchive", on: "_id", whenMatched: "keepExisting", whenNotMatched: "insert" }
    }
);

// Import pull request comments in the collection gharchive
db.gharchive_raw.aggregate(
    {
        "$match": { "type": "PullRequestReviewCommentEvent"}
    },
    {
        "$project": {
            _id: "$payload.comment.id",
            "type" : 1,
            "actor_login" : "$actor.login",
            "repo_name" : "$repo.name",
            "body" : "$payload.comment.body",
            "message_type" : "comment",
            "pull_request_id": "$payload.pull_request.id",
            "created_at": "$created_at"
        }
    },
    {
        "$merge": { into: "gharchive", on: "_id", whenMatched: "keepExisting", whenNotMatched: "insert" }
    }
)

// Import pull request data
db.gharchive_raw.aggregate(
    {
        "$match": { "type": "PullRequestEvent"}
    },
    {
        "$project": {
            _id: "$payload.pull_request.id",
            "type" : 1,
            "actor_login" : "$actor.login",
            "repo_name" : "$repo.name",
            "title" : "$payload.pull_request.title",
            "body" : "$payload.pull_request.body",
            "message_type" : "pull_request",
            "pull_request_id": "$payload.pull_request.id",
            "created_at": "$created_at"
        }
    },
    {
        "$merge": { into: "gharchive", on: "_id", whenMatched: "keepExisting", whenNotMatched: "insert" }
    }
)

db.gharchive_raw.drop();