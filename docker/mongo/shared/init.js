// Création de la collection gharchive
db.createCollection("gharchive_raw")
db.createCollection("gharchive")

// Indexation texte du champ "text" de la collection gharchive
db.gharchive.createIndex(
    {
        body: "text",
        title: "text"
    }
)