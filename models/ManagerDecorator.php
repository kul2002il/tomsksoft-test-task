<?php
namespace models;

/**
 *
 * @author ilia
 *        
 */
class ManagerDecorator extends BasePersonDecorator
{

    public array $employees = [];

    public function __construct(PersonInterface $person)
    {
        $this->person = $person;
        $this->employees = Person::find("id_manager = {$this->getId()}");
    }

    public static function checkApplyDecorator(PersonInterface $before): bool
    {
        $idPositionManager = Positions::find('code = "manager"')[0]->getId();
        return $before->id_position == $idPositionManager;
    }
}

