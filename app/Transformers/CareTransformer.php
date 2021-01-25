<?php

namespace App\Transformers;

use App\Models\Care;
use League\Fractal\TransformerAbstract;

class CareTransformer extends TransformerAbstract
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
    public function transform(Care $care)
    {
        return [
            'id' => (int)$care->id,
            'type' => (string)$care->type,
            'plant' => (int)$care->plant_id,
            'created_at' => (string)$care->created_at,
            'updated_at' => (string)$care->updated_at,
            'deleted_at' => isset($care->deleted_at) ? (string)$care->deleted_at : null,


            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('cares.show',$care->id),
                ],
                [
                    'rel' => 'care.garden',
                    'href' => route('cares.garden.index',$care->id),
                ],
                [
                    'rel' => 'care.ground',
                    'href' => route('cares.ground.index',$care->id),
                ],
                [
                    'rel' => 'care.plant',
                    'href' => route('cares.plant.index',$care->id),
                ],
                [
                    'rel' => 'care.seed',
                    'href' => route('cares.seed.index',$care->id),
                ],
                [
                    'rel' => 'care.crop',
                    'href' => route('cares.crop.index',$care->id),
                ],
                [
                    'rel' => 'care.bed',
                    'href' => route('cares.bed.index',$care->id),
                ],
            ]
        ];
    }

    public static function originalAttributes($index){
        $attributes = [
            'id' => 'id',
            'type' => 'type',
            'plant' => 'plant_id',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
