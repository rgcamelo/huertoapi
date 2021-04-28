<?php

namespace App\Transformers;

use App\Models\Bed;
use League\Fractal\TransformerAbstract;

class BedTransformer extends TransformerAbstract
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
    public function transform(Bed $bed)
    {
        return [
            'id' => (int)$bed->id,
            'number' => (int)$bed->number,
            'x' => (int)$bed->x,
            'y' => (int)$bed->y,
            'name' => (string)$bed->name,
            'status' => (string)$bed->status,
            'type' => (string)$bed->type,
            'zona' => (string)$bed->ground_id,
            'created_at' => (string)$bed->created_at,
            'updated_at' => (string)$bed->updated_at,
            'deleted_at' => isset($bed->deleted_at) ? (string)$bed->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('beds.show',$bed->id),
                ],
                [
                    'rel' => 'bed.garden',
                    'href' => route('beds.garden.index',$bed->id),
                ],
                [
                    'rel' => 'bed.ground',
                    'href' => route('beds.ground.index',$bed->id),
                ],
                [
                    'rel' => 'bed.plants',
                    'href' => route('beds.plants.index',$bed->id),
                ],
                [
                    'rel' => 'bed.seeds',
                    'href' => route('beds.seeds.index',$bed->id),
                ],
                [
                    'rel' => 'bed.crops',
                    'href' => route('beds.crops.index',$bed->id),
                ],
                [
                    'rel' => 'bed.cares',
                    'href' => route('beds.cares.index',$bed->id),
                ],
            ]
        ];
    }

    public static function originalAttributes($index){
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'number' => 'number',
            'x' => 'x',
            'y' => 'y',
            'status' => 'status',
            'type' => 'type',
            'zona' => 'ground_id',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttributes($index){
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'number' => 'number',
            'x' => 'x',
            'y' => 'y',
            'status' => 'status',
            'type' => 'type',
            'ground_id' => 'zona',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
