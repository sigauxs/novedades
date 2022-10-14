<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;



class IdentificationType extends Model
{
    use HasFactory;
    protected $table = "identification_types";
    protected $guarded = [''];


     public function notification()
    {
        return $this->belongsTo(Notification::class);
    }


}

