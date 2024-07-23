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
