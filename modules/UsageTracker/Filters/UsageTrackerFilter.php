<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class UsageTrackerFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}
