- [How Setup](#how-setup)
  - [1. Create Database (next bd) and put params to `connect.php`:](#1-create-database-next-bd-and-put-params-to-connectphp)
  - [2. Create Tables or import from DataBaseExample](#2-create-tables-or-import-from-databaseexample)
    - [User](#user)
    - [Quest](#quest)
    - [UserQuests](#userquests)
  - [3. Run from Apache](#3-run-from-apache)
- [API](#api)
  - [user\_create](#user_create)
  - [quest\_create](#quest_create)
  - [quest\_add\_to\_user](#quest_add_to_user)
  - [get\_all\_user\_quests](#get_all_user_quests)




# How Setup

## 1. Create Database (next bd) and put params to `connect.php`:
```php
$servername: {your address to sql server}
$username: {your username from sql server account}
$password: {your password from sql server account}
$db: {your bd name}
```


## 2. Create Tables or import from DataBaseExample

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

## 3. Run from Apache



# API

## user_create
<pre>
// first API method of create user
// need args
    // 'name': string
    // (optional) balance: int (default: 0)
// return 
    // result of success or not success created
</pre>

## quest_create
<pre>
// second API: method of create quest
// need args
    // 'name': string
    // (optional) cost: int (default: 0)
// return 
    // result of success or not success created
</pre>

## quest_add_to_user
<pre>
// thirtd API method of success answering client to test and updating of solved quests of gived user quest
// need args quest
    // 'user_id': int quest
    // 'quest_id': int quest
// return quest
    // result of solver quests quest
    // balance quest
</pre>

## get_all_user_quests
<pre>
// fourth API method of getting all users quest and balance quest
// need args quest
    // 'user_id': int quest
// return quest
    // result of solver quests quest
    // balance quest
</pre>