<!DOCTYPE html>

<html>

    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>Регистрация</title>
		<!-- <link rel="stylesheet" href="css/reg.css"> -->
         <!-- подключение boootstrap стилей и тем-->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
        
        <!-- подключение своих стилей-->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="css/lk.css">
        

    </head>
<body class="full_fon">

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
                    else{
                    	// если же нет, то выводим как гость
                    	echo "Гость";
						echo nl2br("\n\n\n");
					}
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
			     
	                 <li><a  href="index.php">Личный кабинет</a> </li>
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
  <div class="container">
  <div class="row">    
    <div class="f_user">
                 <div class="h1">
            	 <h2 style="margin-left: 20px;">Регистрация нового пользователя </h2>
               <br>
                 </div>

               <form action="controllers/basa.php" method="post">
                    <div class="container">
                      <div class="row">  

                 <div class="col-md-10">
            	  <div class="f_label_1">
                        <p>Логин</p>
                        <p>Пароль</p>            
                        <p>Электронный адрес</p>	 
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

                  </div>
                  <div class="f_input_1">
                    
                  <p><input placeholder="Логин" required="" name="Login" type="text"> </p>
                  <p> <input placeholder="Пароль" required="" name="password" type="password"> </p>
                      <p> <input placeholder="e-mail" required="" name="Gmail" type="email"> </p>
                    	 <p><input placeholder="Фамилия" !required="" name="Familiya" type="text" size="30"> </p>
                         <p><input placeholder="Имя" !required="" name="Name" type="text" size="30"></p>
                         <p><input placeholder="Отчество" !required="" name="Otchestvo" type="text" size="30"> </p>
                         <p><input placeholder="Телефон" !required="" name="Telefon" type="tel" size="30"> </p>
                         <p><input placeholder="Учебное подразделение" !required="" name="Ychebnoe_podrazdel" type="text" size="30"> </p>
                         <p><input placeholder="Направление подготовки" !required="" name="Napravl_podgotovki" type="text" size="30"> </p> 
                         <p>
                    <select class="pol" name="Kvalifikaciya" >
                        <option value="Бакалавриат" >Бакалавриат</option>
                        <option value="Специалитет" >Специалитет</option>
                        <option value="Магистратура" >Магистратура</option>
                     </select>
                 </p>



                 <p><input  class="pol" placeholder="Курс" !required="" name="Kurs" type="number" min="1" max="6" size="30">	 </p>
                <p> <input placeholder="Группа" !required="" name="Gruppa" type="text"  size="30"> </p>
                 <p><input placeholder="Статус обучения" !required="" name="Status_obucheniya" type="text" size="30"> </p>
                 <p>
                      <select class="pol" name="Forma_obucheniya" >
                        <option value="Очная" >Очная</option>
                        <option value="Очно-заочная" >Очно-заочная</option>
                        <option value="Заочная" >Заочная</option>
                     </select>

                 </p>
                 <p><input placeholder="Дата рождения" !required="" name="Data_rojdeniya" type="date" min="1920-01-01" max="1999-01-01" size="30" class="pol"></p>
                 <p>
                     <select class="pol" name="Pol" >
                        <option value="Мужской" >Мужской</option>
                        <option value="Женский" >Женский</option>
                     </select>
                 </p>
                  </div>

                    <div class="f_label_2">

                  </div>


            <div class="f_input_2">

                 



                   
               </div>
                 
             </div>
<button class="f_submit" type="submit">Зарегистрироваться</button>
<br>
<br>

               </div>
             </div>
           </form><!-- form -->
   </div><!-- f_user -->
   </div>
</div><!-- container-->
<div class="container">
      <div class ="f_footer">
        <p> © Все права защищены 2023г. разработчиками</p>
      </div>
  </div>
<script src="js/bootstrap.js"></script>
</body>
</html>