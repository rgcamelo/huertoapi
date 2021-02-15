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
        //$seed= $plant->seed;
        return [
            'id' => (int)$plant->id,
            'name' => (string)$plant->name,
            'status' => (string)$plant->status,
            'seed' => (int)$plant->seed_id,
            //'seed_name' => (string)$seed->name,
            'bed' => (int)$plant->bed_id,
            'created_at' => (string)$plant->created_at,
            'updated_at' => (string)$plant->updated_at,
            'deleted_at' => isset($plant->deleted_at) ? (string)$plant->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('plants.show',$plant->id),
                ],
                [
                    'rel' => 'plants.crops',
                    'href' => route('plants.crop.index',$plant->id),
                ],
                [
                    'rel' => 'plants.garden',
                    'href' => route('plants.garden.index',$plant->id),
                ],
                [
                    'rel' => 'plants.ground',
                    'href' => route('plants.ground.index',$plant->id),
                ],
                [
                    'rel' => 'plants.seed',
                    'href' => route('plants.seed.index',$plant->id),
                ],
                [
                    'rel' => 'plants.cares',
                    'href' => route('plants.cares.index',$plant->id),
                ],
                [
                    'rel' => 'plants.bed',
                    'href' => route('plants.bed.index',$plant->id),
                ],
        ]
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
