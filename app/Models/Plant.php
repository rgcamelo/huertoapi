<?php

namespace App\Models;

use App\Models\Bed;
use App\Models\Care;
use App\Models\Crop;
use App\Models\Seed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plant extends Model
{
    use HasFactory,SoftDeletes;

    const PLANT_STATUS_PLANTED = 'plantada';

    protected $dates = ['deleted_at'];
	protected $fillable = [
    	'name',
        'seed_id',
        'bed_id',
    	'status',
    ];

    public function cares(){
    	return $this->hasMany(Care::class);
    }

    public function beds(){
    	return $this->belongsTo(Bed::class);
    }

    public function seed(){
    	return $this->belongsTo(Seed::class);
    }

    public function crop(){
    	return $this->hasOne(Crop::class);
    }

}
