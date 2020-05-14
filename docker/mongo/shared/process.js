// import des messages de commits dans la collection gharchive
db.gharchive_raw.aggregate(
    {
        "$unwind": "$payload.commits"
    },
    {
        "$project": {
            _id: 0,
            "type" : 1,
            "actor_login" : "$actor.login",
            "repo_name" : "$repo.name",
            "text" : "$payload.commits.message",
            "text_type" : "commit"
        }
    },
    {
        "$out": "gharchive"
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
//         $out: "gharchive"
//     }
// )

db.gharchive_raw.drop();