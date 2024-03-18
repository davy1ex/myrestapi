<?php
require 'connect.php';
require 'functions.php';
$username = $_POST['input_username'];

$userAnswers = $_POST['answer'];
$correctAnswers = 0;
$totalQuests = count($userAnswers);


if (!$username) {
    echo "u not input username";
    return 0;
}

$user = getUser($connection, $username);

if (!$user) {
    echo "ERROR! \ninputed username not in system!";
    return 0;
}


$quest_ids = implode(',', array_keys($userAnswers));

$sql = "SELECT id, answer, cost FROM Quest WHERE id IN ($quest_ids)";
$quests = $connection->query($sql);

echo "<hr>";
var_dump($userAnswers);

if ($quests) {
    while ($quest = $quests->fetch_assoc()) {
        $user_id = $user['id'];
        $quest_id = $quest['id'];
        $correctAnswer = $quest['answer'];

        if ($userAnswers[$quest_id] == $correctAnswer) {
            echo "tryed: " . "SELECT * FROM UserQuests WHERE `user_id`= $user_id AND  `quest_id`=$quest_id";
            $user_quests = $connection->query("SELECT * FROM UserQuests WHERE `user_id`= $user_id AND  `quest_id`=$quest_id")->fetch_assoc();
            echo "<hr>";
            var_dump($user_quests);
            if (!empty($user_quests)) {
                $connection->query("SELECT * FROM UserQuests WHERE `user_id`= $user_id AND  `quest_id`=$quest_id");
                
                echo "him answer on it previously time!: user_id: $user_id, quest_id:$quest_id";
                echo "<br>" . $quest['cost'];

                
            }

            else {
                echo "im finded new answer!";
                addQuestToUser($connection, $user_id, $quest_id);

            }
            $correctAnswers++;



        }
    }
}

echo "You answered $correctAnswers out of $totalQuests quests correctly.";

?>
