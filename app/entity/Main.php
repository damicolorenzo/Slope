<?php

require_once('EAdmin.php');
require_once('EAnnualSkipass.php');
require_once('ECreditCard.php');
require_once('EDailySkipass.php');
require_once('EInsurance.php');
require_once('ELiftStructur.php');
require_once('EMonthlySkipass.php');
require_once('EPayment.php');
require_once('EPerson.php');
require_once('ERegisteredUser.php');
require_once('ESkiFacility.php');
require_once('ESkipassBooking.php');
require_once('ESkiRun.php');
require_once('ESubscriptedUser.php');
require_once('EUser.php');
require_once('EWeeklySkipass.php');

$eAdmin = new EAdmin("l", "d", "@", 32049934, "30-10-2002", "lor", "pass"); 
$eAnnualSkipass = new EAnnualSkipass("l", "d", "30-10-2002", "t", "@", 34.2); 
$eCreditCard = new ECreditCard("l", "d", 3, "30-10-2002", 5); 
$eDailySkipasss = new EDailySkipass("l", "d", "30-10-2002", "t", "@", 34.2); 
$eInsurance = new EInsurance("s", 3, 3.4);
$eLiftStructur = new ELiftStructure("l", "t", "s", 3);
$eMonthlySkipass = new EMonthlySkipass("l", "d", "30-10-2002", "t", "@", 34.2);
$ePayment = new EPayment(33.2, "30-10-2002");
$ePerson = new EPerson("l", "d", "@", 33345, "30-10-2002", "lor", "pass");
$eRegisteredUser = new ERegisteredUser("l", "d", "@", 3424, "30-10-2002", "lor", "pass");
$eSkiFacility = new ESkiFacility("n", "s", 43);
$eSkipassBooking = new ESkipassBooking("l", "d", "30-10-2002", "t", "@", 3.2);
$eSkiRun = new ESkiRun("n", "t", "s");
$eSubscriptedUser = new ESubscriptedUser("l", "d", "@", 345, "30-10-2002", "lor", "pass", "20-10-2002");

$array[] = $eAdmin;
$array[] = $eAnnualSkipass;
$array[] = $eCreditCard;
$array[] = $eDailySkipasss;
$array[] = $eInsurance;
$array[] = $eLiftStructur;
$array[] = $eMonthlySkipass;
$array[] = $ePayment;
$array[] = $ePerson;
$array[] = $eRegisteredUser;
$array[] = $eSkiFacility;
$array[] = $eSkiRun;
$array[] = $eSubscriptedUser;
 
for ($i = 0; $i < 13; $i++) {
    print($i);
    print_r($array[$i]);
}