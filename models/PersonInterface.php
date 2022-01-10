<?php
namespace models;

/**
 *
 * @property string $name
 * @property int $phone
 * @property string $telegram
 * @property int $id_manager
 * @property int $id_salary_method
 * @property int $id_position
 */
interface PersonInterface
{

    public function amI(string $className): bool;
    public function salaryCalc():float;
}