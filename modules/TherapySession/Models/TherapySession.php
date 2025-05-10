<?php

declare(strict_types=1);

namespace Modules\TherapySession\Models;

use App\Models\User;
use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\TherapySession\Database\factories\TherapySessionFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use Modules\Therapist\Models\Therapist;

//use BasePackage\Shared\Traits\HasTranslations;

class TherapySession extends Model
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
        'therapist_id',
        'session_time',
        'notes',
        'is_paid'
    ];
    protected $with = [
        'user',
        'therapist'
    ];
    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): TherapySessionFactory
    {
        return TherapySessionFactory::new();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function therapist() {
        return $this->belongsTo(Therapist::class);
    }
}
