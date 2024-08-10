<?php
class Database{
    public static function query(){
        try{
            return new PDO("mysql:host=localhost;dbname=jobboard","root");
        }catch(PDOException $e){
            echo $e->getmessage();
        }
    }
}


