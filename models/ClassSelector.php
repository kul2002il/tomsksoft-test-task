<?php

namespace models;

/**
 * Base class for record class in DB.
 */
abstract class ClassSelector
{
    /**
     * Special class ActiveRecord for save list classes from dictionary.
     */
    private $selectorRecord;

    /**
     * @var array
     */
    protected array $id2classDictionary;

    /**
     * Dictionary: code in DB — classname php.
     * Example:['admin' => AdminUser::class].
     * @return array
     */
    protected abstract function code2classDictionary(): array;

    public function __construct()
    {
        $this->selectorRecord = $this->recordDeclare();
        $tobe = $this->code2classDictionary();
        $saved = $this->selectorRecord::find();
        $this->id2classDictionary = [];
        foreach ($saved as $record)
        {
            if(!isset($tobe[$record->code]))
            {
                throw new \Exception(
                    "Класс с кодом {$record->code} отсутствует " .
                    "в словаре, но определён в БД."
                );
            }
            $this->id2classDictionary += [
                $record->getId() => $tobe[$record->code]
            ];
            unset($tobe[$record->code]);
        }
    }

    /**
     * Declare class-heir of SelectorRecord.
     *
     * @return SelectorRecord
     */
    public abstract function recordDeclare(): SelectorRecord;

    public function id2class(int $id)
    {
        return new $this->id2classDictionary[$id];
    }

    public function code2class(string $code)
    {
        $code2classDictionary = $this->code2classDictionary();
        return new $code2classDictionary[$code];
    }
}