<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subsection()
    {
        return $this->belongsTo(Subsection::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contacts::class);
    }

}
