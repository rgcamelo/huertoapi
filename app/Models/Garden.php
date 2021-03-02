<?php

namespace App\Models;

use App\Models\Ground;
use App\Transformers\GardenTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garden extends Model
{
    use HasFactory,SoftDeletes;
    const GARDEN_DISPONIBLE = 'disponible';
    const GARDEN_NO_DISPONIBLE = 'no disponible';

    protected $dates = ['deleted_at'];

    public $transformer = GardenTransformer::class;

    protected $fillable = [
    	'name',
    	'status',
        'image',
    ];



    public function isDisponible(){
    	return $this->status == Garden::GARDEN_DISPONIBLE;
    }

    public function grounds(){
    	return $this->hasMany(Ground::class);
    }
}
