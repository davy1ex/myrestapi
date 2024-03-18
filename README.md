- [How Setup](#how-setup)
  - [2. Insert it data to `connect.php`](#2-insert-it-data-to-connectphp)
  - [3. Create Tables or import from DataBaseExample](#3-create-tables-or-import-from-databaseexample)
    - [User](#user)
    - [Quest](#quest)
    - [UserQuests](#userquests)
  - [4. Run from Apache](#4-run-from-apache)
- [API](#api)
  - [user\_create](#user_create)
  - [quest\_create](#quest_create)
  - [quest\_add\_to\_user](#quest_add_to_user)
  - [get\_all\_user\_quests](#get_all_user_quests)



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
name: varchar
balance: int```
```


### Quest

- Fileds:

```mysql
id: int
name: varchar
cost: int```
```




### UserQuests

- Fileds:

```mysql
id: int
user_id: int
quest_id: int```
```

## 4. Run from Apache



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
