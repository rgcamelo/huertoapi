<?php

namespace App\Models;

use App\Models\Bed;
use App\Models\Garden;
use App\Transformers\GroundTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ground extends Model
{
	use HasFactory,SoftDeletes;
	const GROUND_DISPONIBLE = 'disponible';
    const GROUND_NO_DISPONIBLE = 'no disponible';
    const GROUND_VACIO = 'vacio';
    const GROUND_DESPLANTE = 'desplante';
    const GROUND_RIEGO = 'riego';
    const TYPE_SEEDBED = 'seedbed';
    const TYPE_MODULE = 'module';

    protected $dates = ['deleted_at'];

    public $transformer = GroundTransformer::class;

	protected $fillable = [
    	'name',
    	'type',
    	'status',
        'number_bed',
        'number_furrow',
        'number_terrace',
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

    private function menosBed(){
        $this->number_bed=$this->number_bed-1;
    }

    private function menosFurrow(){
        $this->number_furrow=$this->number_furrow-1;
    }

    private function menosTerrace(){
        $this->number_terrace=$this->number_terrace-1;
    }


}
