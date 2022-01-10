<?php
namespace models;

class Person extends \core\ActiveRecord implements PersonInterface
{

    /**
     *
     * {@inheritdoc}
     * @see \core\ActiveRecord::tableName()
     */
    public static function tableName(): string
    {
        return "persons";
    }

    public $name;

    public $phone;

    public $telegram;

    public $id_position;

    public $id_salary_method;

    public $id_manager;

    public SalaryCalc $salaryMethod;

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

    public function amI($className): bool
    {
        return static::class === $className;
    }

    public function salaryCalc(): float
    {
        $method = SalaryMethodsStorage::findById($this->id_salary_method);
        $this->salaryMethod = $method->getMethod();
        return $this->salaryMethod->salaryCalc();
    }
}


