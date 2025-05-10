<?php

declare(strict_types=1);

namespace Modules\TherapySession\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class TherapySessionFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}
