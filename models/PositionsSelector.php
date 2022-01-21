<?php

namespace models;

class PositionsSelector extends ClassSelector
{
    /**
     * @inheritDoc
     */
    protected function code2classDictionary(): array
    {
        return [
            'employee' => Person::class,
            'manager' => Manager::class
        ];
    }

    /**
     * @return SelectorRecord
     */
    public function recordDeclare(): SelectorRecord
    {
        return new Positions();
    }

    public function factoryPeople(string $findCondition = '')
    {
        $people = Person::find($findCondition);
        $out = [];
        foreach ($people as $person)
        {
            $out[] = $this->id2class($person->id_position)::findById($person->getId());
        }
        return $out;
    }
}