<?php

namespace App\Transformers;

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
            'quantity' => (double)$crop->quantity,
            'plant' => (int)$crop->plant_id,
            'care' => (int)$crop->care_id,
            'created_at' => (string)$crop->created_at,
            'updated_at' => (string)$crop->updated_at,
            'deleted_at' => isset($crop->deleted_at) ? (string)$crop->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('crops.show',$crop->id),
                ],
                [
                    'rel' => 'crop.garden',
                    'href' => route('crops.garden.index',$crop->id),
                ],
                [
                    'rel' => 'crop.ground',
                    'href' => route('crops.ground.index',$crop->id),
                ],
                [
                    'rel' => 'crop.plant',
                    'href' => route('crops.plant.index',$crop->id),
                ],
                [
                    'rel' => 'crop.seed',
                    'href' => route('crops.seed.index',$crop->id),
                ],
                [
                    'rel' => 'crop.cares',
                    'href' => route('crops.cares.index',$crop->id),
                ],
                [
                    'rel' => 'crop.bed',
                    'href' => route('crops.bed.index',$crop->id),
                ],
            ]
        ];
    }

    public static function originalAttributes($index){
        $attributes = [
            'id' => 'id',
            'quantity' => 'quantity',
            'plant' => 'plant_id',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttributes($index){
        $attributes = [
            'id' => 'id',
            'quantity' => 'quantity',
            'plant_id' => 'plant',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
