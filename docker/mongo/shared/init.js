// Creation of github archives related collections
db.createCollection("gharchive_raw")
db.createCollection("gharchive")

// Indexation text of field body and title
db.gharchive.createIndex(
    {
        body: "text",
        title: "text"
    }
)