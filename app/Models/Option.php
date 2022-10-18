<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemOption;

class Option extends Model
{
    use HasFactory;

    public function itemoption()
    {
        return $this->hasOne(ItemOption::class);
    }
}
