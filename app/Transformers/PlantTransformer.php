<?php

namespace App\Transformers;

use App\Models\Plant;
use League\Fractal\TransformerAbstract;

class PlantTransformer extends TransformerAbstract
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
    public function transform(Plant $plant)
    {
        return [
            'id' => (int)$plant->id,
            'name' => (string)$plant->name,
            'status' => (string)$plant->status,
            'seed' => (int)$plant->seed_id,
            'bed' => (int)$plant->bed_id,
            'created_at' => (string)$plant->created_at,
            'updated_at' => (string)$plant->updated_at,
            'deleted_at' => isset($plant->deleted_at) ? (string)$plant->deleted_at : null,
        ];
    }

    public static function originalAttributes($index){
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'status' => 'status',
            'seed' => 'seed_id',
            'bed' => 'bed_id',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
