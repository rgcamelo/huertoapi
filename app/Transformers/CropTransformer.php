<?php

namespace App\Transformers;

use App\Models\Care;
use App\Models\Crop;
use League\Fractal\TransformerAbstract;

class CropTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Crop $crop)
    {
        return [
            'id' => (int)$crop->id,
            'name' => (string)$crop->name,
            'quantity' => (int)$crop->quantity,
            'plant' => (int)$crop->plant_id,
            'created_at' => (string)$crop->created_at,
            'updated_at' => (string)$crop->updated_at,
            'deleted_at' => isset($crop->deleted_at) ? (string)$crop->deleted_at : null,
        ];
    }

    public static function originalAttributes($index){
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'quantity' => 'quantity',
            'plant' => 'plant_id',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
