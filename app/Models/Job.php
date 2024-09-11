<?php

namespace App\Models;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class Job extends Model
{
    use HasFactory;
    protected $table = 'job_listings';
    protected $fillable = ['employer_id', 'title', 'salary'];

    public function employer()
    {
        return $this->belongsTo(\App\Models\Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id");
    }
}
