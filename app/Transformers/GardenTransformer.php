<?php

namespace App\Transformers;

use App\Models\Garden;
use League\Fractal\TransformerAbstract;

class GardenTransformer extends TransformerAbstract
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
    public function transform(Garden $garden)
    {
        return [
            'id' => (int)$garden->id,
            'name' => (string)$garden->name,
            'status' => (string)$garden->status,
            'created_at' => (string)$garden->created_at,
            'updated_at' => (string)$garden->updated_at,
            'deleted_at' => isset($garden->deleted_at) ? (string)$garden->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('gardens.show',$garden->id),
                ],
                [
                    'rel' => 'garden.crops',
                    'href' => route('gardens.crops.index',$garden->id),
                ],
                [
                    'rel' => 'garden.ground',
                    'href' => route('gardens.grounds.index',$garden->id),
                ],
                [
                    'rel' => 'garden.plant',
                    'href' => route('gardens.plants.index',$garden->id),
                ],
                [
                    'rel' => 'garden.seed',
                    'href' => route('gardens.seeds.index',$garden->id),
                ],
                [
                    'rel' => 'garden.cares',
                    'href' => route('gardens.cares.index',$garden->id),
                ],
                [
                    'rel' => 'garden.bed',
                    'href' => route('gardens.beds.index',$garden->id),
                ],
            ]
        ];

    }

    public static function originalAttributes($index){
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'status' => 'status',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
