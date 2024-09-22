<?php

declare(strict_types=1);

namespace App\Domain\Doctor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;

    use SoftDeletes;

    public const TABLE_NAME = 'doctor';

    public const PRIMARY_KEY = 'id';

    public const FILLABLE = [
        'name',
        'specialty',
        'phone',
        'email',
    ];

    public $fillable = self::FILLABLE;

    protected $primaryKey = self::PRIMARY_KEY;

    protected $table = self::TABLE_NAME;
}
