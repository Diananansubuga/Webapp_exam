<?php
$server='localhost'; // localhost
$user='root'; // mysql user name
$pass=''; // my sql user code

$db_name='book_store';

// object oriented version
$connect=new mysqli($server, $user, $pass, $db_name);

if ($connect -> error){
    print('Failed to connect');
}
// else {
//     echo('connected Successfuly!');
    
// }



 
