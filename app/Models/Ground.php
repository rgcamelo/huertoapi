<?php

namespace App\Models;

use App\Models\Bed;
use App\Models\Garden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ground extends Model
{
	use HasFactory,SoftDeletes;
	const GROUND_DISPONIBLE = 'disponible';
    const GROUND_NO_DISPONIBLE = 'no disponible';
    const TYPE_SEEDBED = 'seedbed';
    const TYPE_MODULE = 'module';

    protected $dates = ['deleted_at'];

	protected $fillable = [
    	'name',
    	'type',
    	'status',
    	'garden_id',
    ];

    public function isDisponible(){
    	return $this->status == Ground::GROUND_DISPONIBLE;
    }

    public function garden(){
    	return $this->belongsTo(Garden::class);
    }

    public function beds(){
    	return $this->hasMany(Bed::class);
    }


}
