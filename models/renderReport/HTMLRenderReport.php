<?php

namespace models\renderReport;

use models\salaryReport\ReportRenderable;

class HTMLRenderReport
{
    public function __construct(
        private ReportRenderable $report
    ) {}

    public function render()
    {
        $this->renderList($this->report->report());
    }

    private function renderList($data)
    {
        echo '<ol>';
        foreach ($data as $pin) {
            echo "<li>{$pin['name']} — {$pin['salary']} <a href=\"?edit_person={$pin['id']}\">Изменить</a>";
            if ($pin['employees']) {
                $this->renderList($pin['employees']);
            }
            echo "</li>";
        }
        echo '</ol>';
    }
}