 <?php 

//Если форма была отправленна, то выводим ее содержимое на экран
if (isset($_POST["name"])) { 
    //Данные отправляются в кодировке utf-8, поэтому конвертим в cp1251
    // echo "Ваше имя: " . iconv("utf-8", "cp1251", $_POST["name"]) . "<br/>"; 
    echo "Ваш телефон: " . $_POST["phone"] . "<br/>";
    // echo "Ваш сайт: " . $_POST["site"] . "<br/>";
}

















 
include 'connect.php'; // подключаемся к БД
 
$sql_update_dost = "UPDATE dostijeniya
                  SET 
                  Kod_podtverjdeniya = ?
                  WHERE Kod_dostijeniya = ?"; // строка запроса

$count = $pdo->prepare($sql_update_dost); // готовим запрос

$input = json_decode(file_get_contents("php://input"), true);

$tmp_index = (int)$_POST['res'];      // готовим данные
$tmp_kod_podver = (int)$_POST['val']; 
$count->execute(array($tmp_kod_podver,$tmp_index)); // делаем обновление
echo $input;
 
?>