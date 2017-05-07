## About

This is an exercise from developers' bootcamp. No frameworks, nor design patterns used. The twitting app offers basic functionality: 
- adding tweets
- adding comments to tweets
- sending messages to other users

## Database loading

``mysql -u user -p db_name < data/db.sql``

## Variable setting

In the config/db.php file please set the database access credentials + absolute path to the index.php file.

``$DB_USER ;``

``$DB_PASS ;``  
  
``$DB_NAME = 'twittapp'; ``

``$DB_HOST = 'localhost'; ``
 
``$ABS_PATH ; absolute path to index.php``