// import des messages de commits dans la collection gharchive_increment
db.gharchive_raw.aggregate(
    {
        "$unwind": "$payload.commits"
    },
    {
        "$project": {
            _id: "$payload.commits.sha", // identifie l'élément
            "type" : 1,
            "actor_login" : "$actor.login",
            "repo_name" : "$repo.name",
            "text" : "$payload.commits.message",
            "text_type" : "commit" // type de message
        }
    },
    {
        "$merge": { into: "gharchive", on: "_id", whenMatched: "keepExisting", whenNotMatched: "insert" }
    }
);



// import des messages de comments dans la collection gharchive
// db.gharchive_raw.aggregate(
//     {
//         $unwind: "$payload.commits"
//     },
//     {
//         $project: {
//             _id: 0,
//             "type" : 1,
//             "actor_login" : "$actor.login",
//             "repo_name" : "$repo.name",
//             "text" : "$payload.commits.message",
//             "text_type" : "commit"
//         }
//     },
//     {
//         $out: "gharchive_increment"
//     }
// )

db.gharchive_raw.drop();