<meta charset=utf-8>
<?php

// // данные для доступа к базе данных
//     $host = 'localhost';
//     $db   = 'portfolio'; // нужно поменять на portfolio
//     $user = 'root';  // нужно поменять на root
//     $pass = '';      // нужно поменять! пароль отстутсвует

// // либо раскоментровать ниже, предварительно закоментровать верх

include 'connect.php';

 // так подключение есть, теперь проверим может уже есть пользователь
 // с таким логином 
 
$tmp_registr = false; // флаг регистрации
$sql_select = "SELECT * FROM `user` LIMIT 0, 50 ";
$stmt = $pdo->query($sql_select);


// регистрируем нового пользователя
$sql_insert = 'UPDATE `user`
                 SET
                  `Gmail` = "'.$_POST['Gmail'].'",
                  `Telefon` = "'.$_POST['Telefon'].'",
                  `Name` = "'.$_POST['Name'].'",
                  `Familiya` = "'.$_POST['Familiya'].'",
                  `Otchestvo`= "'.$_POST['Otchestvo'].'" ,
                  `Ychebnoe_podrazdel`= "'.$_POST['Ychebnoe_podrazdel'].'" ,
                  `Gruppa`= "'.$_POST['Gruppa'].'" ,
                  `Kurs` = "'.$_POST['Kurs'].'",
                  `Napravl_podgotovki`= "'.$_POST['Napravl_podgotovki'].'" ,
                  `Kvalifikaciya`= "'.$_POST['Kvalifikaciya'].'" ,
                  `Status_obucheniya` = "'.$_POST['Status_obucheniya'].'",
                  `Forma_obucheniya`= "'.$_POST['Forma_obucheniya'].'" ,
                  `Data_rojdeniya` = "'.$_POST['Data_rojdeniya'].'",
                  `Pol` = "'.$_POST['Pol'].'"
                 WHERE `Login` = "'.$_POST['Login'].'"';



$count = $pdo->exec($sql_insert); //запись в базу данных


?>
<script> window.setTimeout(function() { window.location = '../lk.php'; }, 0) </script>