<?php 

function addUser($connection, $name, $balance) {
    $sql = "INSERT INTO User (name, balance) VALUES ('$name', $balance)";
    
    if ($connection->query($sql)) {
        $res = [
            "status" => true,
        ];
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
        $res = [
            "status" => false,
            "error" => $connection->error,
        ];
    }

    echo json_encode($res);
}

function addQuest($connection, $name, $cost=1) {
    $sql = "INSERT INTO Quest (name, cost) VALUES ('$name', $cost)";
    
    if ($connection->query($sql)) {
        $res = [
            "status" => true,
        ];
    } else {
        // echo "Error: " . $sql . "<br>" . $connection->error;
        $res = [
            "status" => false,
            "error" => $connection->error,
        ];
    }

    return $res;
}


function userUpdateBalance($connection, $user_id, $cost) {
    $cost = intval($cost);
    $user_id = intval($user_id);

    $sql = "UPDATE `User` SET `balance` = $cost WHERE `id` = $user_id";

    if ($connection->query($sql)) {
        return $res = [
            "status" => true,
        ];
    } 

    else {
        return $res = [
            "status" => false,
        ];
    }
}

function getUser($connection, $user_id) {
    $sql = "SELECT * FROM User WHERE `id`='$user_id'";
    $user = $connection->query($sql)->fetch_assoc();

    return $user;
}

function getQuest($connection, $quest_id) {
    $sql = "SELECT * FROM Quest WHERE `id`='$quest_id'";
    $quest = $connection->query($sql)->fetch_assoc();

    return $quest;
}

function addQuestToUser($connection, $user_id, $quest_id) {
    $sql = "INSERT INTO UserQuests (user_id, quest_id) VALUES ($user_id, $quest_id)";
    
    if ($connection->query($sql)) {
        $res = [
            "status" => true,
        ];
    } else {
        // echo "Error: " . $sql . "<br>" . $connection->error;
        $res = [
            "status" => false,
            "error" => $connection->error,
        ];
    }

    return $res;
}


function getUserQuests($connection, $user_id) {
    $user_id = intval($user_id);
    $sql = "SELECT `quest_id` FROM `UserQuests` WHERE `user_id`=$user_id";
    $user_quests = $connection->query($sql);

    if ($connection->query($sql)) {
        $user_quests = $connection->query($sql);

        if ($user_quests->num_rows > 0) {
            while($row = $user_quests->fetch_assoc()) {
                $questsArray[] = $row;
            }

            return $questsArray;
        } else {
            return [];
        }
    } else {
        $res = [
            "status" => false,
            "error" => $connection->error,
        ];

        return json_encode($res);
    }

    

    
}


function getUserBalance($connection, $user_id) {
    $user_id = intval($user_id);
    
    $sql = "SELECT `balance` FROM `User` WHERE `id`=$user_id";
    $user_balance = $connection->query($sql)->fetch_assoc();

    return $user_balance;
}

?>