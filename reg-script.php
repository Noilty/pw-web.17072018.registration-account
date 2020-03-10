<?php
require_once ('config.php');
include_once ('function.php');
require_once ('lang/script.php');

    if (isset($_POST['login']))
    {
        $err = [];
        
        $Login = mysql_entities_fix_string($_POST['login']);
        $Pass = mysql_entities_fix_string($_POST['passwd']);
        $Repass = mysql_entities_fix_string($_POST['repasswd']);
        $Email_one = mysql_entities_fix_string($_POST['email']);
        $Email_two = mysql_entities_fix_string($_POST['select_mail']);
        
        $Login = StrToLower(Trim($Login));
        $Pass = StrToLower(Trim($Pass));
        $Repass = StrToLower(Trim($Repass));
        $Email = Trim($Email_one.$Email_two);
        
        if (empty($Login) || empty($Pass) || empty($Repass) || empty($Email))
        {
            $err[] = $Lang['errors']['err0'];
            $message = "error";
        }
        elseif (ereg("[^0-9a-zA-Z_-]", $Login, $Txt))
        {
            $err[] = $Lang['errors']['err1'];
            $message = "error";
        }
        elseif (ereg("[^0-9a-zA-Z_-]", $Pass, $Txt))
        {
            $err[] = $Lang['errors']['err2']; 
            $message = "error";
        }
        elseif (ereg("[^0-9a-zA-Z_-]", $Repass, $Txt))
        {
            $err[] = $Lang['errors']['err3'];
            $message = "error";
        }
        elseif (StrPos('\'', $Email))
        {
            $err[] = $Lang['errors']['err4'];
            $message = "error";
        }
        elseif ((StrLen($Login) < $config['LoginMinLeng']) or (StrLen($Login) > $config['LoginMaxLeng']))
        {
            $err[] = $Lang['errors']['err5'];
            $message = "info";
        }
        else
        {
            $Result = MySQL_Query("SELECT name FROM users WHERE name='$Login'") or ("Не удается выполнить запрос!");
            
            if (MySQL_Num_Rows($Result))
            {
                $err[] = "{$Lang['errors']['err6']['err6-0']}$Login{$Lang['errors']['err6']['err6-1']}";
                $message = "error";
            }
            elseif ((StrLen($Pass) < $config['PassMinLeng']) or (StrLen($Pass) > $config['PassMaxLeng']))
            {
                $err[] = $Lang['errors']['err7'];
				$message = "info";
            }
            elseif ((StrLen($Repass) < $config['PassMinLeng']) or (StrLen($Repass) > $config['PassMaxLeng']))
            {
                $err[] = $Lang['errors']['err8'];
				$message = "info";
            }
            elseif ((StrLen($Email_one) < $config['EmailMinLeng']) or (StrLen($Email_one) > $config['EmailMaxLeng']))
            {
                $err[] = $Lang['errors']['err9'];
				$message = "info";
            }
            else
            {
				$Result = MySQL_Query("
				SELECT email FROM users WHERE email='$Email'") or ("Не удается выполнить запрос!");
                
                if (MySQL_Num_Rows($Result))
                {
                    $err[] = "{$Lang['errors']['err10']['err10-0']}$Email{$Lang['errors']['err10']['err10-1']}";
                    $message = "error";
                }
                elseif ($Pass != $Repass)
                {
                    $err[] = $Lang['errors']['err11'];
                    $message = "error";
                }
                //
                elseif ($_POST['capcha'] != $_SESSION['rand_code'])
                {
                    $err[] = $Lang['errors']['err12'];
                    $message = "error";
                }
                //
                else
                {
                    $Salt = base64_encode(md5($Login.$Pass, true));
                    MySQL_Query("call adduser('$Login', '$Salt', '0', '0', '0', '0', '$Email', '0', '0', '0', '0', '0', '0', '0', '', '', '$Salt')") or die ("Аккаунт не зарегистрирован");
                    
                    $mysqlresult=MySQL_Query("select * from `users` WHERE `name`='$Login'");
                    
                    $User_ID=MySQL_result($mysqlresult,0,'ID');
                    MySQL_Query("call usecash({$User_ID},1,0,1,0,".$config['gold'].",1,@error)") or die ("Голд не выдан");
                    
                    $err[] = "{$Lang['errors']['err13']['err13-0']}$Login{$Lang['errors']['err13']['err13-1']}$User_ID{$Lang['errors']['err13']['err13-2']}$Email{$Lang['errors']['err13']['err13-3']}{$config['gold']}{$Lang['errors']['err13']['err13-4']}";
                    $message = "success";
                }
            }
        }
    }
mysql_close($link);
?>