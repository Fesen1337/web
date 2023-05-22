<?php 
 
include 'connect.php'; // подключаемся к БД

// DELETE FROM Customers WHERE CustomerName='Alfreds Futterkiste'; 

$sql_update_dost = "DELETE FROM dostijeniya
                  WHERE
                  Kod_dostijeniya = ?";

$count = $pdo->prepare($sql_update_dost); // готовим запрос

$input = json_decode(file_get_contents("php://input"), true);

$tmp_index = (int)$_POST['res'];      // готовим данные
$count->execute(array($tmp_index)); // делаем обновление
echo $input;
 
?>