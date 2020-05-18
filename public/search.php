<?php

require '../vendor/autoload.php';
$searchTerm = $_GET['q'] ?? null;

?>

<html>
<header>
    <title>GH Archive Search</title>
</header>
<body>
<form>
    <input type="text" name="q" value="<?php echo $searchTerm; ?>"/>
    <button type="submit">Search</button>
</form>

<?php

if (null !== $searchTerm) {

$mongoDB = new MongoDB\Client("mongodb://root:rootpassword@mongo:27017");

$db = $mongoDB->test;
$collection = $db->gharchive;

$result = $collection->find(['$text' => ['$search' => $searchTerm ]]);
$count = $collection->countDocuments([ '$text' => ['$search' => $searchTerm ]]);
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
                    <th>created_at</th>
                    <th>pull_request_id</th>
                    <th>message</th>
                    <th>title</th>
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
                echo '<td>' . $entry['message_type'] . '</td>';
                echo '<td>' . $entry['created_at'] . '</td>';
                echo '<td>' . ($entry['pull_request_id'] ?? null). '</td>';
                echo '<td><pre>' . $entry['body'] . '</pre></td>';
                echo '<td><pre>' . ($entry['title'] ?? null). '</pre></td>';
                echo '</tr>';
            }
            ?>

            </tbody>
        </table>

<?php } ?>

    </body>
</html>

