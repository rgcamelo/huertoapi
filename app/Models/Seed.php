<?php

namespace App\Models;

use App\Models\Plant;
use App\Transformers\SeedTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seed extends Model
{
    protected $dates = ['deleted_at'];
	const SEED_DISPONIBLE = 'disponible';
    const SEED_NO_DISPONIBLE = 'no disponible';

    public $transformer = SeedTransformer::class;

	protected $fillable = [
        'name',
        'status'
    ];
    use HasFactory,SoftDeletes;

    public function isDisponible(){
    	return $this->status == Seed::SEED_DISPONIBLE;
    }

    public function plants(){
    	return $this->hasMany(Plant::class);
    }
}
