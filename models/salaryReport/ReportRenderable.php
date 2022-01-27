<?php

namespace models\salaryReport;

interface ReportRenderable
{
    public function report(): array;
}