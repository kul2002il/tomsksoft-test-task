<?php
namespace models;

abstract class BasePersonDecorator implements PersonInterface
{

    protected PersonInterface $person;

    public function __construct(PersonInterface $person)
    {
        $this->person = $person;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \models\PersonInterface::amI()
     */
    public function amI(string $className): bool
    {
        if (static::class === $className)
            return true;
        return $this->person->amI($className);
    }
    
    public function salaryCalc():float
    {
        return $this->person->salaryCalc();
    }

    public function __get($name)
    {
        return $this->person->$name;
    }

    public function __set($name, $value)
    {
        $this->person->$name = $value;
    }

    public function __call(string $name, array $arguments)
    {
        return $this->person->$name(...$arguments);
    }

    public abstract static function checkApplyDecorator(PersonInterface $before): bool;

    public final static function tryBeFrom(PersonInterface &$before): PersonInterface
    {
        if (static::checkApplyDecorator($before))
            $before = new static($before);
        return $before;
    }
}

