<?php
require 'connect.php';


$sql = "SELECT id, name, cost FROM Quest";
$result = $connection->query($sql);

$quests = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $quests[] = $row;
    }
} else {
    echo "0 results found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quests</title>
</head>
<body>
    <h1>Quests</h1>
    <form action="submit_answers.php" method="post">
        <input type="text" name="input_username" placeholder="Your login">
        
        <?php foreach ($quests as $quest): ?>
            <div>
                <label><?php echo htmlspecialchars($quest['name']); ?> (Cost: <?php echo htmlspecialchars($quest['cost']); ?>)</label>
                <input type="text" name="answer[<?php echo $quest['id']; ?>]" placeholder="Your answer">
                <?php var_dump( $quest); ?>
            </div>
        <?php endforeach; ?>
        
        <button type="submit">Finish</button>
    </form>
</body>
</html>
