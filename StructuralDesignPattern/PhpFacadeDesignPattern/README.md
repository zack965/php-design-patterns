# Facade Design Pattern
### Overview


This project demonstrates the implementation of the **Facade Design Pattern** in a smart home context. The Facade pattern provides a simplified interface to a complex subsystem, making it easier for users to interact with.

### Components
### Subsystems
-  LightSubSystem
    - Manages the home lighting system.
```php
<?php

namespace Zack\PhpFacadeDesignPattern\SubSystems;

class LightSubSystem
{
    public function turnOn(): string
    {
        return  "Light Subsystem: Turning on the light\n";
    }

    public function turnOff(): string
    {
        return  "Light Subsystem: Turning off the light\n";
    }

    public function changeColor(string $color): string
    {
        return  "Light Subsystem: Changing the light color to {$color}\n";
    }
    public function changePattern(string $pattern): string
    {
        return  "Light Subsystem: Changing the light pattern to {$pattern}\n";
    }
}

``` 

- WifiSubSystem
    - Manages WiFi connectivity.
```php
<?php

namespace Zack\PhpFacadeDesignPattern\SubSystems;

class WifiSubSystem
{
    public function TurnOff(): string
    {
        return "Wifi Subsystem: Turning off the WiFi\n";
    }
    public function ConnectToNetwork(string $networkName): string
    {
        return "Wifi Subsystem: Connecting to network '{$networkName}'\n";
    }
    public function ChangePassword(string $oldPassword, string $newPassword): string
    {
        return "Wifi Subsystem: Changing the password from '{$oldPassword}' to '{$newPassword}'\n";
    }
    public function DisconnectFromNetwork(): string
    {
        return "Wifi Subsystem: Disconnecting from the network\n";
    }
}

```

- Facade
    - SmartHomeFacade
    - Provides a simplified interface for common home automation tasks.
```php

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

```
- client code 
```php 
<?php

use Zack\PhpFacadeDesignPattern\SmartHomeFacade;
use Zack\PhpFacadeDesignPattern\SubSystems\LightSubSystem;
use Zack\PhpFacadeDesignPattern\SubSystems\WifiSubSystem;

require 'vendor/autoload.php';



$lightSubSystem = new LightSubSystem();

$wifiSubSystem = new WifiSubSystem();

$smartHomeFacade = new SmartHomeFacade($lightSubSystem, $wifiSubSystem);

print_r($smartHomeFacade->GetReadyToSleep());

```