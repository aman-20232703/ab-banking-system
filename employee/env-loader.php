<?php
function loadEnv($path = __DIR__.'/email.env'){
    if(!file_exists($path)){
        throw new Exception('email.env file not found'.$path);
    }
    $lines = file($path,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line){
        if(strpos(trim($line),'#')===0)continue;
        list($name,$value) = explode('=',$line,2);
        $name = trim($name);
        $value = trim($value," \t\n\r\0\x0B\"'");

        $_ENV[$name] = $value;
        putenv("$name = $value");
    }
   
}

?>