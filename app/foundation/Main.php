<?php

require_once("FSkiFacility.php");
require_once("FSkiRun.php");
require_once("FLiftStructure.php");
require_once("FSkipassBooking.php");
require_once("FPersistentManager.php");
require_once("FPerson.php");
require_once(dirname(dirname(__FILE__)). "/entity/ESkiFacility.php");
require_once(dirname(dirname(__FILE__)). "/entity/ESkiRun.php");
require_once(dirname(dirname(__FILE__)). "/entity/ELiftStructure.php");
require_once(dirname(dirname(__FILE__)). "/entity/ESkipassBooking.php");
require_once(dirname(dirname(__FILE__)). "/entity/EUser.php");

//queste operazioni sono fatte dai controllori
//lettura da db
#$ski = FPersistentManager::getInstance()->retriveObj(FSkiFacility::getClass(), 1);

//scrittura su db
//$obj = new ESkiFacility("impianto2", "aperto", 10);
#$skiFacility2 = FPersistentManager::getInstance()->uploadObj($obj); funziona

//test
//$obj = new ESkiRun("pista1", "rossa", "aperta");
#$skiRun1 = FPersistentManager::getInstance()->uploadObj($obj); funziona

//$obj = new ELiftStructure("seggiovia1", "seggiovia", "aperta", 40);
#$liftStructure = FPersistentManager::getInstance()->uploadObj($obj); funziona

//$obj = new ESkipassBooking("l", "d", "2002-10-30", "t", "@", 3);
#$skipassBooking = FPersistentManager::getInstance()->uploadObj($obj); #funziona 


#$ski = FPersistentManager::getInstance()->retriveObj(FSkiFacility::getClass(), 2); funziona
#$ski = FPersistentManager::getInstance()->retriveObj(FSkiRun::getClass(), 1); funziona
#$ski = FPersistentManager::getInstance()->retriveObj(FLiftStructure::getClass(), 1); funziona
#$ski = FPersistentManager::getInstance()->retriveObj(FSkipassBooking::getClass(), 1); funziona



/* $eUser = new EUser("Lorenzo", "D\'Amico", "lor@g.com", "+39 123 456 7890", "30-10-2000", "lor20", "l20");
$user = FPersistentManager::getInstance()->uploadObj($eUser); */

/* $dbUser = FPersistentManager::getInstance()->retriveObj(FUser::getClass(), 6); 
print_r($dbUser); */

?>
