<?php

namespace App\Models;

use App\Models\Plant;
use App\Models\Ground;
use App\Transformers\BedTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{

	const BED_DISPONIBLE = 'disponible';
    const BED_VOID = 'vacio';
    const BED_NO_DISPONIBLE = 'no disponible';
    const BED_WATER = 'riego';
    const TYPE_BED = 'bed';
    const TYPE_FURROW = 'furrow';
    const TYPE_TERRACE = 'terrace';

    protected $dates = ['deleted_at'];
    public $transformer = BedTransformer::class;

	protected $fillable = [
    	'name',
        'number',
        'x',
        'y',
    	'type',
    	'status',
    	'ground_id'
    ];

    use HasFactory, SoftDeletes;

    public function isDisponible(){
    	return $this->status == Bed::BED_DISPONIBLE;
    }

    public function ground(){
    	return $this->belongsTo(Ground::class);
    }

    public function plants(){
    	return $this->hasMany(Plant::class);
    }


}
