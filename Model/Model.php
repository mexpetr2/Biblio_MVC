<?php 
abstract class Model{
    private static $pdo;
    
    private static function setBdd($pdo){
        $this->pdo = new PDO('mysql:host=localhost;dbname=biblio_MVC','root','root',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));;
    }

    protected function getBdd(){
        return $this->pdo;
    }
}
?>