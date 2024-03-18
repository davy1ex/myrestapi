<?php 
require 'connect.php';
require 'functions.php';

// error_reporting(E_ALL);s

header('Content-type: json/application');

$method = $_SERVER['REQUEST_METHOD'];
$type = $_GET['q'];
$params = explode('/', $type);


if ($method == "POST" && count($params) > 0) {
    // first API method of create user
    // need args
        // 'name': string
        // (optional) balance: int (default: 0)
    // return 
        // result of success or not success created
    if ($params[0] === 'user_create') {
        header('Content-Type: application/json; charset=utf-8');
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data == "") {
            echo json_encode([
                "status" => false,
                "error" => "Need send json data",
            ]);
            return 0;
        }

        else {
            if (count($data) > 0) {
                if (!array_key_exists( "name", $data)) {

                    echo json_encode([
                        "status" => false,
                        "error" => "Incorrect Key or Keys. New user must have a name"
                    ]);
                    return 0;
                }
                
                else if (!array_key_exists("balance", $data)) {
                    $data["balance"] = 0;
                }

                // echo $json;

                echo addUser($connection, $data["name"], $data["balance"]);
            }

        }

        
        
        

    }

    // second API: method of create quest
    // need args
        // 'name': string
        // (optional) cost: int (default: 0)
    // return 
        // result of success or not success created
    else if ($params[0] === 'quest_create') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data == "") {
            echo json_encode([
                "status" => false,
                "error" => "Need send json data",
            ]);
            return 0;
        }

        else {

            if (!array_key_exists( "name", $data)) {
                $res = [
                    "status" => false,
                    "error" => "Incorrect Key or Keys. New quest must have a name",
                ];

                echo json_encode($res);
                return 0;
            }
            
            if (!array_key_exists("cost", $data)) {
                $data["cost"] = 0;
            }
            $res = addQuest($connection, $data["name"], $data["cost"]);

            echo json_encode( $res);

        }
    }

    // thirtd API method of success answering client to test and updating of solved quests of gived user
    // need args
        // 'user_id': int
        // 'quest_id': int
    // return 
        // result of solver quests
        // balance
    else if ($params[0] === 'quest_add_to_user') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data == "") {
            echo json_encode([
                "status" => false,
                "error" => "Need send json data",
            ]);
            return 0;
        }

        else {
            if (!array_key_exists( "user_id", $data)) {
                $res = [
                    "status" => false,
                    "error" => "Incorrect Key off user_id",
                ];

                echo json_encode($res);
                return 0;
            }

            else if (!array_key_exists( "quest_id", $data)) {
                $res =  [
                    "status" => false,
                    "error" => "Incorrect Key off quest_id",
                ];
                echo json_encode($res);
                return 0;
            }

            $user_id =  intval($data['user_id']);
            $quest_id = intval($data['quest_id']);

            $user = getUser($connection, $user_id);
            $quest = getQuest($connection, $quest_id);

            if ($user && $quest) {
                $user_quests = $connection->query("SELECT * FROM UserQuests WHERE `user_id`=$user_id AND  `quest_id`=$quest_id");

                if ($user_quests->num_rows <= 0) {
                    $user_quests = $user_quests->fetch_assoc();
                    

                    if (!empty($user_quests)) {
                        $res = [
                            "status" => false,
                            "error" => "Gived user already correct answering on it quest",
                        ];
        
                        echo json_encode($res);
                        return 0;
                    }
        
                    $quest = getQuest($connection, $data['quest_id']);
                    echo $quest;
                    
        
                    if (($quest) < 0) {
                        $res = [
                            "status" => false,
                            "error" => "Gived quest_id not exist",
                        ];
        
                        echo json_encode($res);
                        return 0;
                    }
        
                    // echo var
                    addQuestToUser($connection, $data['user_id'], $data['quest_id']);
                    userUpdateBalance($connection, $user_id, $quest['cost']);

                    $res = [
                        "status" => true,
                    ];
    
                    echo json_encode($res);
                    return 0;
                }   

                else {
                    $res = [
                        "status" => false,
                        "error" => "Gived quest_id or user_id not exist",
                    ];
    
                    echo json_encode($res);
                    return 0;
                }
            }
            
            else {
                $res = [
                    "status" => false,
                    "error" => "Gived quest_id or user_id not exist",
                ];

                echo json_encode($res);
                return 0;
            }
            
            
            
            
        }
    }

    // fourth API method of getting all users quest and balance
    // need args
        // 'user_id': int
    // return 
        // result of solver quests
        // balance
    else if ($params[0] === "get_all_user_quests") {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!array_key_exists( "user_id", $data)) {
            $res = [
                "status" => false,
                "error" => "Incorrect Key off user_id",
            ];

            echo json_encode($res);
            return 0;
        }
        $user_id = $data['user_id'];
       
        
        $res = [
            "status" => true,
            "result" =>  getUserQuests($connection, $user_id),
            "balance" => getUserBalance($connection, $user_id),
        ];

        echo json_encode($res);
    }

    else {
        return     http_response_code(404);

    }

    
}




?>