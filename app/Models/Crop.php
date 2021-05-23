<?php

namespace App\Models;

use App\Models\Plant;
use App\Transformers\CropTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crop extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    public $transformer = CropTransformer::class;

	protected $fillable = [
    	'plant_id',
        'care',
    	'quantity'
    ];

    public function plant(){
    	return $this->belongsTo(Plant::class);
    }
}
