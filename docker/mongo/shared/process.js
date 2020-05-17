// import des messages de commits dans la collection gharchive_increment
db.gharchive_raw.aggregate(
    {
        "$unwind": "$payload.commits"
    },
    {
        "$project": {
         //   _id: "$payload.commits.sha", // identifie l'élément
            _id: "$id",
            "type" : 1,
            "actor_login" : "$actor.login",
            "repo_name" : "$repo.name",
            "text" : "$payload.commits.message",
            "text_type" : "commit", // type de message
            "pull_request_id": 'NA',
            "created_at": "$created_at"
        }
    },
    {
        "$merge": { into: "gharchive", on: "_id", whenMatched: "keepExisting", whenNotMatched: "insert" }
    }
);

// import des commentaires des pull request dans la collection gharchive
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
            "text" : "$payload.comment.body",
            "text_type" : "comment",
            "pull_request_id": "$payload.pull_request.id",
            "created_at": "$created_at"
        }
    },
    {
        "$merge": { into: "gharchive", on: "_id", whenMatched: "keepExisting", whenNotMatched: "insert" }
    }
)

db.gharchive_raw.drop();