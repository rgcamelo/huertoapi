<?php

namespace App\Models;

use App\Models\Plant;
use App\Transformers\CareTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Care extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    public $transformer = CareTransformer::class;

    const TYPE_WATER = 'water';
    const TYPE_MANURE = 'manuere';
    const TYPE_PLAGUE = 'plague';
    const TYPE_EYE = 'eye';


	protected $fillable = [
    	'plant_id',
        'type',
        'description'
    ];

    public function plant(){
    	return $this->belongsTo(Plant::class);
    }

}
