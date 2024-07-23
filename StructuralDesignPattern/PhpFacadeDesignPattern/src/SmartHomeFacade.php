<?php

namespace Zack\PhpFacadeDesignPattern;

use Zack\PhpFacadeDesignPattern\SubSystems\LightSubSystem;
use Zack\PhpFacadeDesignPattern\SubSystems\WifiSubSystem;

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
