<?php

declare(strict_types=1);

namespace Modules\DailyReport\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class DailyReportFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}
