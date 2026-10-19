<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'full_name', 'profile_picture', 'email', 'contact_number', 'address',
        'about_me', 'education', 'skills', 'projects', 'work_experience',
        'links', 'template',
    ];

    protected function casts(): array
    {
        return [
            'education' => 'array',
            'skills' => 'array',
            'projects' => 'array',
            'work_experience' => 'array',
            'links' => 'array',
        ];
    }
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}
