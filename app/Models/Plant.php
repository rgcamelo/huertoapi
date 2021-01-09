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
    protected $dates = ['deleted_at'];
	protected $fillable = [
    	'name',
    	'bed_id',
    	'seed_id',
    	'status',
    ];

    public function cares(){
    	return $this->hasMany(Care::class);
    }

    public function bed(){
    	return $this->belongsTo(Bed::class);
    }

    public function seed(){
    	return $this->belongsTo(Seed::class);
    }

    public function crop(){
    	return $this->hasOne(Crop::class);
    }

}
