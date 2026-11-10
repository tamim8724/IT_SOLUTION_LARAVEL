<?php

namespace App\Models;

class Enquiry extends BaseModel
{
    // MongoDB collection name (same as the SQL table name)
    protected $table = 'enquiries';

    public const STATUSES = ['new' => 'New', 'replied' => 'Replied', 'won' => 'Won', 'lost' => 'Lost'];

    public const BUDGETS = [
        'Australia'  => ['Under $1,500', '$1,500 – $4,000', '$4,000 – $10,000', '$10,000+', 'Not sure yet'],
        'Bangladesh' => ['Under ৳30k', '৳30k – ৳80k', '৳80k – ৳2 lakh', '৳2 lakh+', 'Not sure yet'],
    ];

    public const COUNTRIES = ['Australia', 'Bangladesh', 'Other'];

    protected $fillable = ['name', 'email', 'phone', 'service', 'country', 'budget', 'message', 'status', 'notes', 'source_page', 'ip', 'verified_at'];

    // Default for new enquiries (MongoDB has no column defaults)
    protected $attributes = ['status' => 'new'];

    protected $casts = ['verified_at' => 'datetime'];

    public static function allBudgets(): array
    {
        return array_values(array_unique(array_merge(...array_values(self::BUDGETS))));
    }
}
