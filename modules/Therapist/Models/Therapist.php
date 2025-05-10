<?php

declare(strict_types=1);

namespace Modules\Therapist\Models;

use App\Models\User;
use BasePackage\Shared\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Therapist\Database\factories\TherapistFactory;
use BasePackage\Shared\Traits\BaseFilterable;
use Modules\TherapySession\Models\TherapySession;

//use BasePackage\Shared\Traits\HasTranslations;

class Therapist extends Model
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
        'specialty',
        'rating',
        'price',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): TherapistFactory
    {
        return TherapistFactory::new();
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function sessions() {
        return $this->hasMany(TherapySession::class);
    }
}
