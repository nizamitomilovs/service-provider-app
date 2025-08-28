<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $short_description
 * @property string $logo
 * @property int $category_id
 *
 * @property DateTimeInterface|null $created_at
 * @property DateTimeInterface|null $updated_at
 *
 * @property-read Category $category
 */
final class Provider extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'short_description',
        'logo',
        'category_id',
    ];

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid7();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
