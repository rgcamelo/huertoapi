<?php

namespace App\Models;

use App\Models\Plant;
use App\Models\Ground;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{

	const BED_DISPONIBLE = 'disponible';
    const BED_NO_DISPONIBLE = 'no disponible';
    const TYPE_BED = 'bed';
    const TYPE_FURROW = 'furrow';
    const TYPE_TERRACE = 'terrace';

    protected $dates = ['deleted_at'];

	protected $fillable = [
    	'name',
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

    public function plant(){
    	return $this->hasOne(Plant::class);
    }
}
