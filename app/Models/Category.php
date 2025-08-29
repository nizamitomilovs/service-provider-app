<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Ramsey\Uuid\Uuid;

/**
 * @property string $id
 * @property string $name
 *
 * @property DateTimeInterface|null $created_at
 * @property DateTimeInterface|null $updated_at
 *
 * @property-read Collection<Provider> $providers
 */
final class Category extends Model
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
    ];

    /**
     * {@inheritdoc}
     */
    public static function updated($callback): void
    {
        parent::updated($callback);

        Cache::forget('all');
    }

    /**
     * {@inheritdoc}
     */
    public static function deleted($callback): void
    {
        parent::deleted($callback);

        Cache::forget('categories:all');
    }

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid7();
    }

    public function providers(): HasMany
    {
        return $this->hasMany(Provider::class);
    }
}
