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
