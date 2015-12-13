<?php
namespace MegaMock;

class ReturnManager
{
    public $args;
    public $mName;
    private $value;

    public function __construct($mName, array $args)
    {
        $this->mName = $mName;
        $this->args = $args;
    }

    public function willReturn($value){
        $this->value = $value;
    }

    public function getValue(){
        return $this->value;
    }
}