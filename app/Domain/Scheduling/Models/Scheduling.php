<?php

declare(strict_types=1);

namespace App\Domain\Scheduling\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scheduling extends Model
{
    use HasFactory;

    use SoftDeletes;

    public const TABLE_NAME = 'scheduling';

    public const PRIMARY_KEY = 'id';

    public const FILLABLE = [
        'name',
        'email',
        'animal_name',
        'animal_type',
        'age',
        'symptoms',
        'date',
        'period',
    ];

    public $fillable = self::FILLABLE;

    protected $primaryKey = self::PRIMARY_KEY;

    protected $table = self::TABLE_NAME;
}
