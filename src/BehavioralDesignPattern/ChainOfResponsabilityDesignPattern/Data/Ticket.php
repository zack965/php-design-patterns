<?php
namespace Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Data;

use Zack\LaravelDesignPatterns\BehavioralDesignPattern\ChainOfResponsabilityDesignPattern\Enum\LevelEnum;

class Ticket
{

    private string $title;
    private string $content;
    private LevelEnum $level;

    public function __construct($title, $content, $level)
    {
        $this->title = $title;
        $this->content = $content;
        $this->level = $level;
    }
    public function getLevel()
    {
        return $this->level;
    }
    public function setLevel(LevelEnum $level)
    {
        return $this->level = $level;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function updateTitle($newTitle)
    {
        $this->title = $newTitle;
    }
    public function setTitle($newTitle)
    {
        $this->title = $newTitle;
    }
}