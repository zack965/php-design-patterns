<?php

use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Facade\SmartHomeFacade;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems\LightSubSystem;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems\WifiSubSystem;

require "vendor/autoload.php";




$lightSubSystem = new LightSubSystem();

$wifiSubSystem = new WifiSubSystem();

$smartHomeFacade = new SmartHomeFacade($lightSubSystem, $wifiSubSystem);

print_r($smartHomeFacade->GetReadyToSleep());