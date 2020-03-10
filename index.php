<?php require_once ('reg-script.php'); ?>
<?php require_once ('lang/script.php'); ?>
<!DOCTYPE HTML>

<html>

<head>
    <title>
        <?php echo $Lang['Title_browser']; ?>
    </title>
    <meta http-equiv="content-type" content="text/html" ; charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <center>
        <div style="margin: 10px;">
            <a href="index.php?lang=ru/main">RU</a> |
            <a href="index.php?lang=en/main">EN</a>
        </div>
        <div style="width: 346px;">
            <fieldset style="width: 300px;">
                <legend style="margin: 0px 58px 0px 57px;">
                </legend>
                <form id="register" action="?do=register" method=post>
                    <center>
                        <h2 style="text-transform: uppercase;">
                            <?php echo $Lang['Header']; ?>
                        </h2>
                        <fieldset style="margin: 10px 0px 10px 0px;">
                            <legend>
								<!-- контейнер -->
								<G class="block"> 
									<!-- видимый элемент -->
									<GG class="hover">*</GG> 
									<!-- скрытый элемент -->
									<GGG class="hidden"><?php echo $Lang['errors']['err5']; ?></GGG>
								</G>                                
                                <?php echo $Lang['Login']; ?>
                            </legend>
                            <input type=text name=login style="width: 90%; margin: 5px; padding: 5px;">
                        </fieldset>
                        <fieldset style="margin: 0px 0px 10px 0px;">
                            <legend>
								<!-- контейнер -->
								<G class="block"> 
									<!-- видимый элемент -->
									<GG class="hover">*</GG> 
									<!-- скрытый элемент -->
									<GGG class="hidden"><?php echo $Lang['errors']['err7']; ?></GGG>
								</G>                                
                                <?php echo $Lang['Pass']; ?>								
                            </legend>
                            <input type=password name=passwd style="width: 90%; margin: 5px; padding: 5px;">
                        </fieldset>
                        <fieldset style="margin: 0px 0px 10px 0px;">
                            <legend>
                                <?php echo $Lang['RePass']; ?>
                            </legend>
                            <input type=password name=repasswd style="width: 90%; margin: 5px; padding: 5px;">
                        </fieldset>
                        <fieldset style="margin: 0px 0px 10px 0px;">
                            <legend>
								<!-- контейнер -->
								<G class="block"> 
									<!-- видимый элемент -->
									<GG class="hover">*</GG> 
									<!-- скрытый элемент -->
									<GGG class="hidden"><?php echo $Lang['errors']['err9']; ?></GGG>
								</G>                                 
                                <?php echo $Lang['Email']; ?>
                            </legend>
                            <div>
                                <div style="float: left; width: 125px;">
                                    <input type=text name=email style="width: 150px; margin: 5px; padding: 5px;">
                                </div>
                                <div style="float: right; width: 120px;">
                                    <select name="select_mail" style="margin: 5px; padding: 5px; width: 104px;">
										<option disabled>Mail</option>
										<option value="@mail.ru">@mail.ru</option>
										<option value="@inbox.ru">@inbox.ru</option>
										<option value="@list.ru">@list.ru</option>
										<option value="@bk.ru">@bk.ru</option>
										<option disabled>GMail</option>
										<option value="@gmail.com">@gmail.com</option>
										<option disabled>Yandex</option>
										<option value="@yandex.ru">@yandex.ru</option>
                                	</select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset style="margin: 0px 0px 10px 0px;">
                            <legend>
                                <?php echo $Lang['Captcha']; ?>
                            </legend>
                            <div>
                                <div style="float: left; width: 164px;">
                                    <input name='capcha' type='text' placeholder='<?php echo $Lang['Captcha_text']; ?>' style="width: 90%; margin: 5px; padding: 5px;">
                                </div>
                                <div style="float: right; width: 112px;">
                                    <img src='captcha.php' style="margin: 5px 0px 0px 5px;">
                                </div>
                            </div>
                        </fieldset>
                        <input type=submit name=submit value="<?php echo $Lang['Button_reg']; ?>" style="width: 300px; margin: 10px 0px 10px 0px; padding: 5px;">
                    </center>
                </form>
                <?php $err_str = array_shift($err); ?>
                <?php
            if($err != 0)
            echo <<<_END
                        <fieldset>
                            <legend>{$Lang['Attention']}</legend>
                                <div id="$message" class="message">
                                    $err_str
                                </div>                            
                        </fieldset>            
_END;
            ?>
            </fieldset>
        </div>
    </center>
</body>

</html>
