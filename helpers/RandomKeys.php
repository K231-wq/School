<?php 
namespace App\helpers;

class RandomKeys{
    public static function generate($length = 0){
        $chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKMNOPQRSTUVWXYZ1234567890";
        $randomKey = '';
        for($i = 0; $i < $length; $i++){
            $randomIndex = rand(0, strlen($chars) -1);
            $randomKey .= $chars[$randomIndex];
        }
        return $randomKey;
    }
}
?>