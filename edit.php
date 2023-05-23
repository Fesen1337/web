<?php 
session_start();

if (!empty($_SESSION['id'])) { //id достаем из сессии
  // если он не пустой, отобразим весь html код ниже, 
  // если же id пустое, то отравим на страницу авторизации
       
// unset($_POST['submit']);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Портфолио студента</title>
  
	<!-- подключение bootstrap (бутстрап)-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
		
	<!-- подключение  стилей панеля управления-->
	   <link rel="stylesheet" href="css/lk.css">
      <link rel="stylesheet" type="text/css" href="css/main.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
  <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">

        
        function AjaxFormRequest(result_id,url) {
            jQuery.ajax({
                url:     url, //Адрес подгружаемой страницы
                type:     "POST", //Тип запроса
                dataType: "html", //Тип данных
                data: { res: result_id}, 
                success: function(response) { //Если все нормально

                // document.getElementById(result_id).innerHTML = response;
            },
            error: function(response) { //Если ошибка
            // document.getElementById(result_id).innerHTML = "Ошибка при отправке формы";
            }
          });
    }

   </script>
</head>
<body class>
<div class="container">
        <header class="f_header"> 
        <div class="f_users">

			<p>Пользователь:  
			      <?php 
				  echo nl2br("\n");
				  if (!empty($_SESSION['id'])) 
			      // тут понятно и просто
			      // если авторизован выводим ФИО пользователя
			      {
			      echo $_SESSION['Familiya'];
			      echo nl2br("\n");
			      echo $_SESSION['Name'];
			      echo nl2br("\n");
			      echo $_SESSION['Otchestvo'];
                    }
                    else
                    	// если же нет, то выводим как гость
                    	echo "Гость";
			      ?>
			</p>
		</div>
                <h1>Портфолио – это не только дань моде
			   </h1>
			   
                 <nav style="bottom: 0">
	                 <li><a  href="index.php">Главная</a></li> 
	                 <li><a  href="users.php">Регистрация</a> </li>
                 <?php if (!empty($_SESSION['id'])) // здесь происходит следующее
                 // если пользователь авторизован направляем его в личный кабинет
			      {?>
                      <li><a  href="lk.php">Личный кабинет</a> </li>
			     <?php }
			     // если же не автоизован направляем его на 
			     // страницу входа в систему
                       else
			      {?>
			     
	                 <li><a  href="chek.php">Личный кабинет</a> </li>
                 <?php }?>
                  <!-- <li><a  href="admin.php">Администратор</a> </li> -->
                  <li>
			<form action="" method="post">
			<button class="f_exit" type="submit" name="exit" value="999">Выход </button>
				<?php 
				if (isset($_POST['exit'])&&($_POST['exit']==999)) {
					$_SESSION = array(); // или $_SESSION = array() для очистки всех данных сессии
					session_destroy();

					?>	<script> window.setTimeout(function() { window.location = '../index.php'; }, 0) </script><?php
					header('Location: index.php');
					}
				?>
			</form>
                  </li>
                </nav>
        </header>
    </div> <!-- container -->
	 <div class="container-fluid">
	  <div class="row">
	      <div class="col-xs-3 col-md-2"><!-- левый сайдбар информативного поля -->
	      	<ul class="nav nav-sidebar">
            <li>

            <form action="" method="post">
        <?php 
        if (isset($_POST['exit2'])&&($_POST['exit2']==999)) {
          $_SESSION = array(); // или $_SESSION = array() для очистки всех данных сессии
          session_destroy();
          header('Location: index.php');
          }
        ?>
      </form>

            </li>
            </ul>
            <hr>
            <h1 class="page-header">Профиль</h1>
          <ul class="nav nav-sidebar">
          <?php
          if ($_SESSION['Tip_user']=="Администратор") {?>
          <input type="button" onclick="location.href='admin.php';" class="btn btn-default" data-dismiss="modal" style="width: 200px;" value="Админ панель" />
          <?php
            }?>
          <li><a href="">Редактировать</a></li>
          <?php
          if ($_SESSION['Tip_user']!="Администратор") {?>
            <li>
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Удалить" style="width: 200px; background-color: red;"onclick="AjaxFormRequest('<? echo $_SESSION['id']; ?>', 'rm_profile.php'); window.setTimeout(function() { window.location = '../index.php'; }, 100);" />
            </li>
            <?php
            }?>
          </ul>
          <hr>
          

	      </div>
	      <div class="col-xs-15 col-sm-6 col-md-10" style="width: 1160px;"> <!-- основное информативное поле -->

	       <h1 class="page-header">Личный кабинет</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="images/avatar.png" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
             
            </div>
             <h2 class="sub-header">Отредактируйте данные</h2>
             <br>
             <div class="col-xs-3 col-sm-5" >
    <?php include 'connect.php';

$sql_select = "SELECT * FROM `user` LIMIT 0, 50 "; // выполним запрос к бд
$stmt = $pdo->query($sql_select); // достанем данные во временный массив $stmt
while ($row = $stmt->fetch())
{
   // перебор массива $stmt в цикле
   if ($_SESSION['id']==$row['Kod_user']) 
           { // отобразим данные конкретного пользователя по id
           
 ?>            
 <div class="container">
  <div class="row">    
    <div class="f_user">

               <form action="controllers/change.php" method="post">
                    <div class="container">
                      <div class="row">  


                 <div class="col-md-10">
            	  <div class="f_label_1">
                        <p>Логин</p>
                        <p>Фамилия</p>
                        <p>Имя</p>
                        <p>Отчество</p>
                        <p>Телефон</p>
                        <p>Учебное подразделение</p>
                        <p>Направление подготовки</p>
                        <p>Квалификация</p>
                        <p>Курс</p>
                        <p>Группа</p>
                        <p>Статус обучения</p>
                        <p>Форма обучения</p>
                        <p>Дата рождения</p>
                        <p>Пол</p>
                        <p>Электронный адрес</p>	

                  </div>
                  <div class="f_input_1">

                        <p><input readonly value=<?php echo $row['Login']; ?> !required="" name="Login" type="text" size="30"> </p>
                    	 <p><input value=<?php echo $row['Familiya']; ?> !required="" name="Familiya" type="text" size="30"> </p>
                         <p><input value=<?php echo $row['Name']; ?> !required="" name="Name" type="text" size="30"></p>
                         <p><input value=<?php echo $row['Otchestvo']; ?> !required="" name="Otchestvo" type="text" size="30"> </p>
                         <p><input value=<?php echo $row['Telefon']; ?> !required="" name="Telefon" type="tel" size="30"> </p>
                         <p><input value=<?php echo $row['Ychebnoe_podrazdel']; ?> !required="" name="Ychebnoe_podrazdel" type="text" size="30"> </p>
                         <p><input value=<?php echo $row['Napravl_podgotovki']; ?> !required="" name="Napravl_podgotovki" type="text" size="30"> </p> 
                         <p>
                    <select class="pol" name="Kvalifikaciya">
                        <option value="Бакалавриат" >Бакалавриат</option>
                        <option value="Специалитет" >Специалитет</option>
                        <option value="Магистратура" >Магистратура</option>

                     </select>
                 </p>



                 <p><input value=<?php echo $row['Kurs']; ?> class="pol" placeholder="Курс" !required="" name="Kurs" type="number" min="1" max="6" size="30">	 </p>
                <p> <input value=<?php echo $row['Gruppa']; ?> !required="" name="Gruppa" type="text"  size="30"> </p>
                 <p><input value=<?php echo $row['Status_obucheniya']; ?> !required="" name="Status_obucheniya" type="text" size="30"> </p>
                 <p>
                      <select class="pol" name="Forma_obucheniya" >
                        <option value="Очная" >Очная</option>
                        <option value="Очно-заочная" >Очно-заочная</option>
                        <option value="Заочная" >Заочная</option>
                     </select>

                 </p>
                 <p><input value=<?php echo $row['Data_rojdeniya']; ?> !required="" name="Data_rojdeniya" type="date" min="1920-01-01" max="1999-01-01" size="30" class="pol"></p>
                 <p>
                     <select class="pol" name="Pol" >
                        <option value="Мужской" >Мужской</option>
                        <option value="Женский" >Женский</option>
                     </select>
                 </p>

                 <p> <input value=<?php echo $row['Gmail']; ?> required="" name="Gmail" type="email"> </p>
                 <br>
                 <br>
                 <br>
                 <br>
                  </div>


             </div>
<button class="f_submit" type="submit">Обновить</button>
               </div>
             </div>
           </form><!-- form -->
   </div><!-- f_user -->
   </div>
</div><!-- container-->
            
<?php } //if

} //while
     ?> 
        
          </div>

          
      </div>
    </div>
  </div>
</div>              
<!-- завершение всплывашек -->
 
                 
                
                
              </tbody>
            </table>
          </div>
        </div>
  
      </div>
     
    </div>
	      
	      </div>
	    </div>
	</div>
  <div class="container">
  <br>
  <br>
      <div class ="f_footer">
        <p> © Все права защищены 2023г. разработчиками</p>
      </div>
  </div> 
	 <!-- подключение JQuery -->
	 <script src="js/jquery-3.2.1.min.js"></script>
   <!-- подключение bootstrap.js-->
	 <script src="js/bootstrap.js"></script>
</body>
</html>
<?php
}
else {
echo "Вам необходимо пройти авторизацию";
?>
<p>Через 5 секунд будет произведено перенаправление на страницу авторизации</p>
  <!--  <script> window.setTimeout(function() { window.location = '../chek.php'; }, 5000) </script> -->
<?php
header('Location: ../chek.php'); exit();
}
?>
