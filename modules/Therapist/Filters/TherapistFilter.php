<?php

declare(strict_types=1);

namespace Modules\Therapist\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class TherapistFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}
