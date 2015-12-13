<?php
namespace MegaMock;

class MegaMock{

    /** @var array ReturnManager */
    private $returnManagers = [];

    public function __construct(string $type)
    {
        $ref = new \ReflectionClass($type);

        if($ref->isInterface())
            $this->obj = $this->GenerateClassForInterface($ref);
        else
            $this->obj = $this->GenerateClassForClass($ref);
    }

    public function getObject(){
        return $this->obj;
    }



    /**
     * @param \ReflectionClass $reflection
     */
    private function GenerateClassForClass($reflection){
        return $this->GenerateCode($reflection, 'extends');
    }

    private function GenerateClassForInterface($reflection){
        return $this->GenerateCode($reflection, 'implements');
    }

    /**
     * @param \ReflectionClass $reflection
     * @param $relation
     * @return
     */
    private function GenerateCode($reflection, $relation){

        $methodsCode = "";
        foreach($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method)
        {
            $methodsCode .= "public function ".$method->getName()."(";
            foreach($method->getParameters() as $param)
            {
                $methodsCode .= "$".$param->getName();
            }
            $methodsCode .= '){
                return $this->mock->getReturnValueForCall
                    ("'.$method->getName().'", func_get_args());
            }';
        }

        $typeName = $reflection->getName(); // \MegaMock\Int1
        $typeNameRep = str_replace('\\', '_', $typeName);

        $name = "Impl_".$typeNameRep."_".md5(microtime());
        $code = "class $name $relation $typeName {".$methodsCode."}";
        eval($code);
        $instance = new $name;
        $instance->mock = $this;
        return $instance;

    }

    public function __call($name, array $args)
    {
        $rm = new ReturnManager($name, $args);
        $this->returnManagers[] = $rm;
        return $rm;
    }

    public function getReturnValueForCall($mName, array $args){

        /** @var ReturnManager $rm */
        foreach($this->returnManagers as $rm)
            if($rm->mName === $mName && $rm->args === $args)
                return $rm->getValue();


        throw new \Exception("No return value configured for
        invokation of $mName with ".var_export($args, true));
    }
}