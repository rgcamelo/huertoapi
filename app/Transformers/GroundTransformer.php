<?php

namespace App\Transformers;

use App\Models\Ground;
use League\Fractal\TransformerAbstract;

class GroundTransformer extends TransformerAbstract
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
    public function transform(Ground $ground)
    {
        return [
            'id' => (int)$ground->id,
            'name' => (string)$ground->name,
            'status' => (string)$ground->status,
            'type' => (string)$ground->type,
            'number_bed' => (int)$ground->number_bed,
            'number_furrow' => (int)$ground->number_furrow,
            'number_terrace' => (int)$ground->number_terrace,
            'huerto' => (int)$ground->garden_id,
            'created_at' => (string)$ground->created_at,
            'updated_at' => (string)$ground->updated_at,
            'deleted_at' => isset($ground->deleted_at) ? (string)$ground->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('grounds.show',$ground->id),
                ],
                [
                    'rel' => 'grounds.crops',
                    'href' => route('grounds.crops.index',$ground->id),
                ],
                [
                    'rel' => 'grounds.ground',
                    'href' => route('grounds.garden.index',$ground->id),
                ],
                [
                    'rel' => 'grounds.plant',
                    'href' => route('grounds.plants.index',$ground->id),
                ],
                [
                    'rel' => 'grounds.seed',
                    'href' => route('grounds.seeds.index',$ground->id),
                ],
                [
                    'rel' => 'grounds.cares',
                    'href' => route('grounds.cares.index',$ground->id),
                ],
                [
                    'rel' => 'grounds.bed',
                    'href' => route('grounds.beds.index',$ground->id),
                ],
        ]
            ];
    }

    public static function originalAttributes($index){
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'status' => 'status',
            'type' => 'type',
            'number_bed' => 'number_bed',
            'number_furrow' => 'number_furrow',
            'number_terrace' => 'number_terrace',
            'huerto' => 'garden_id',
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
            'status' => 'status',
            'type' => 'type',
            'number_bed' => 'number_bed',
            'number_furrow' => 'number_furrow',
            'number_terrace' => 'number_terrace',
            'huerto' => 'garden_id',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
