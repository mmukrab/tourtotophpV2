<?php
abstract class utils
{
public static function writeToLogFile($logmsg)
{
    $dateTime = new DateTime("now");
    $dow = $dateTime->format('l');
    $w     = $dateTime->format('W');
    $fn     = Settings::$LOGPATH."log_".$dow.".txt";
    if (is_file($fn)&&$w == date('W',filemtime($fn)))
    {
        $file = fopen($fn,"a");
    }
    else
    {
        $file = fopen($fn,"w");
    }
    fprintf($file,"%s | %.50s | %s \n",  $dateTime->format("d-m-Y G:i:s"), self::sesVar('fullname',self::serverVar('REMOTE_ADDR')), $logmsg);
    fclose($file);
}
}
?>