<?php
namespace models;

class Person extends \core\ActiveRecord implements Reportable
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
    public static function fieldsDB(): array
    {
        return array_merge(parent::fieldsDB(), [
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

    public SalaryCalculated $salaryMethod;

    public function getName(): string
    {
        return $this->name;
    }

    public function getSalary(): float
    {
        $selector = new SalaryMethodsSelector();
        $method = $selector->id2class($this->id_salary_method);
        return $method->salaryCalc();
    }

    public function getStaff(): array
    {
        return [];
    }
}


