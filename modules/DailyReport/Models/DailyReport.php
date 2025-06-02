<?php

declare(strict_types=1);

namespace Modules\DailyReport\Models;

use App\Models\User;
use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\DailyReport\Database\factories\DailyReportFactory;
use BasePackage\Shared\Traits\BaseFilterable;
//use BasePackage\Shared\Traits\HasTranslations;

class DailyReport extends Model
{
    use HasFactory;
    use UuidTrait;
    use BaseFilterable;
    //use HasTranslations;
    //use SoftDeletes;

    //public array $translatable = [];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'report',
        'status',
        'type'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): DailyReportFactory
    {
        return DailyReportFactory::new();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
