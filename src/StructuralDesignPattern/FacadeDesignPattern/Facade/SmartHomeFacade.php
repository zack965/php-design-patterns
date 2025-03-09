<?php
namespace Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\Facade;

use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems\LightSubSystem;
use Zack\LaravelDesignPatterns\StructuralDesignPattern\FacadeDesignPattern\SubSystems\WifiSubSystem;

class SmartHomeFacade
{
    private $lightSubSystem;
    private $wifiSubSystem;
    public function __construct(LightSubSystem $lightSubSystem, WifiSubSystem $wifiSubSystem)
    {
        $this->lightSubSystem = $lightSubSystem;
        $this->wifiSubSystem = $wifiSubSystem;
    }

    public function GetReadyToSleep(): array
    {
        return [
            'Turn off lights' => $this->lightSubSystem->TurnOff(),
            'Disconnect from network' => $this->wifiSubSystem->DisconnectFromNetwork(),
        ];
    }
}