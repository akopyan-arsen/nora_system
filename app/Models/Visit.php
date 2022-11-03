<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use SoftDeletes;

    protected $table = 'visits';

    protected $fillable = [
        'start_time',
        'end_time',
        'uah_per_hour',
        'amount_paid',
        'label_name',
        'discount_amount',
        'discount_unit',
        'is_paid',
        'payment_method',
        'note',
    ];

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id', 'discount');
    }

    public function label(): BelongsTo
    {
        return $this->belongsTo(Label::class, 'label_id', 'id', 'label');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }

    public function getFormattedStartTimeAttribute(): string
    {
        return $this->formatDate($this->getAttribute('start_time'), 'H:i d-m-Y');
    }

    public function getFormattedEndTimeAttribute(): string
    {
        return $this->formatDate($this->getAttribute('end_time'), 'H:i d-m-Y');
    }

    public function formatDate($date, string $format = 'H:i d-m-Y'): string
    {
        return (new Carbon($date))->format($format);
    }
}
