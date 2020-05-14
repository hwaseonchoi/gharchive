<html>
<header>
    <title>GH Archive Search</title>
</header>
<body>

<?php
require '../vendor/autoload.php';

$m = new MongoDB\Client("mongodb://root:rootpassword@mongo:27017");

$db = $m->test;
$coll = $db->gharchive;

$searchTerm = $_GET['q'];

$result = $coll->find( [ '$text' => ['$search' => $searchTerm ] ]);
$count = $coll->countDocuments( [ '$text' => ['$search' => $searchTerm ] ]);
?>
<p>Total number of results: <?php echo $count; ?></p>
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>type</th>
            <th>actor_login</th>
            <th>repo_name</th>
            <th>text_type</th>
            <th>text</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($result as $entry) {
        echo '<tr>';
        echo '<td>' . $entry['_id'] . '</td>';
        echo '<td>' . $entry['type'] . '</td>';
        echo '<td>' . $entry['actor_login'] . '</td>';
        echo '<td>' . $entry['repo_name'] . '</td>';
        echo '<td>' . $entry['text_type'] . '</td>';
        echo '<td><pre>' . $entry['text'] . '</pre></td>';
        echo '</tr>';
    }

    ?>
    </tbody>
</table>
</body>
</html>

