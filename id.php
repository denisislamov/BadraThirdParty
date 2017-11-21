<?php
    $my_host = "127.0.0.1"; // Your mySQL server host address
    $mydb    = "neolant";   // The name of the database to use
    $my_user = "neolant";   // Your mySQL username
    $my_pass = "neolant";   // Your mySQL password

    $link = mysqli_connect($my_host, $my_user , "neolant", $mydb);

    if (!$link) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    echo "Соединение с MySQL установлено!" . PHP_EOL;
    echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;

    function anti_injection_login_senha($sql, $formUse = true)
    {
        $sql = preg_replace("/(from |select |insert |delete |where |drop table|show tables|,|'|#|\*|--|\\\\)/i","",$sql);
        $sql = trim($sql);
        $sql = strip_tags($sql);

         if(!$formUse || !get_magic_quotes_gpc())
           $sql = addslashes($sql);
           $sql = md5(trim($sql));
             return $sql;
    }
 
    function anti_injection_login($sql, $formUse = true)
    {
        $sql = preg_replace("/(from |select |insert |delete |where |drop table|show tables|,|'|#|\*|--|\\\\)/i","",$sql);
        $sql = trim($sql);
        $sql = strip_tags($sql);
        if(!$formUse || !get_magic_quotes_gpc())
            $sql = addslashes($sql);
        return $sql;
    }
 
    $unityHash = anti_injection_login($_POST["myform_hash"]);
    $phpHash   = "myHash";
    $postuserid = anti_injection_login($_POST["myform_postuserid"]);
    
    echo "myform_hash: ".$unityHash.", phpHash: ".$phpHash.", myform_postuserid: ".$postuserid . PHP_EOL;

    if ((!$postuserid) || ($unityHash != $phpHash))
    {
        echo "Sorry, wrong data" . PHP_EOL;
    }
    else
    {
        $query  = "INSERT INTO id_table (id) VALUES ('$postuserid')";
        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_array($result))
        {
            echo $row;
        }
    }
    mysqli_close($link);
?>