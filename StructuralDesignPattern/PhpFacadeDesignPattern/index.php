<?php

use Zack\PhpFacadeDesignPattern\SmartHomeFacade;
use Zack\PhpFacadeDesignPattern\SubSystems\LightSubSystem;
use Zack\PhpFacadeDesignPattern\SubSystems\WifiSubSystem;

require 'vendor/autoload.php';



$lightSubSystem = new LightSubSystem();

$wifiSubSystem = new WifiSubSystem();

$smartHomeFacade = new SmartHomeFacade($lightSubSystem, $wifiSubSystem);

print_r($smartHomeFacade->GetReadyToSleep());
