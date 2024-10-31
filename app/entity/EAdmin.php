<?php
require_once('EPerson.php');

class EAdmin extends EPerson{

    private static string $entity = EAdmin::class;

    public static function getEntity(): string {
        return self::$entity;
    }
}


?>