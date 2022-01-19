<?php
namespace models;

class Person extends \core\ActiveRecord
{

    /**
     * {@inheritdoc}
     *
     * @see \core\ActiveRecord::tableName()
     */
    public static function tableName(): string
    {
        return "persons";
    }

    /**
     *
     * {@inheritdoc}
     * @see \core\ActiveRecord::fielsdDB()
     */
    public static function fielsdDB(): array
    {
        return array_merge(parent::fielsdDB(), [
            'name',
            'phone',
            'telegram',
            'id_position',
            'id_salary_method',
            'id_manager'
        ]);
    }

    public $name;

    public $phone;

    public $telegram;

    public $id_position;

    public $id_salary_method;

    public $id_manager;

    public SalaryCalc $salaryMethod;

    public function employees(): array
    {
        if($this->getId())
        {
            return Person::find("id_manager = {$this->getId()}");
        }
        return [];
    }

    public function salaryCalc(): float
    {
        $method = SalaryMethodsStorage::findById($this->id_salary_method);
        $this->salaryMethod = $method->getMethod();
        return $this->salaryMethod->salaryCalc();
    }
}


