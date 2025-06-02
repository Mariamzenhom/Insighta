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
//use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


//use BasePackage\Shared\Traits\HasTranslations;

class Therapist extends Model implements HasMedia
{
    use HasFactory;
    use UuidTrait;
    use BaseFilterable;
    use InteractsWithMedia;
    //use HasTranslations;
    //use SoftDeletes;

    //public array $translatable = [];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'specialty',
        'rating',
        'price',
        'name',
        'phone',
        'email',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): TherapistFactory
    {
        return TherapistFactory::new();
    }

    public function sessions() {
        return $this->hasMany(TherapySession::class);
    }
}
