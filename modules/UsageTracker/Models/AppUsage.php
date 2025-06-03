<?php

declare(strict_types=1);

namespace Modules\UsageTracker\Models;

use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use BasePackage\Shared\Traits\BaseFilterable;
// use BasePackage\Shared\Traits\HasTranslations;

class AppUsage extends Model
{
     protected $fillable = ['user_id', 'platform', 'duration_minutes', 'date'];

}
