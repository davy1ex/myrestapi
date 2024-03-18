# How Setup

* ## 1. Create Database
* user: "root"
* pass: ""
* database name: "User"

## 2. Insert it data to `connect.php`

## 3. Create Tables or import from DataBaseExample

### User

- Fileds:

```mysql
id: int
- name: varchar
- balance: int```
```


# API

## user_create

// first API method of create user
// need args
// 'name': string
// (optional) balance: int (default: 0)
// return
// result of success or not success created

## quest_create

// second API: method of create quest
// need args
// 'name': string
// (optional) cost: int (default: 0)
// return
// result of success or not success created

## quest_add_to_user

// thirtd API method of success answering client to test and updating of solved quests of gived user
// need args
// 'user_id': int
// 'quest_id': int
// return
// result of solver quests
// balance

## get_all_user_quests

// fourth API method of getting all users quest and balance
// need args
// 'user_id': int
// return
// result of solver quests
// balance
