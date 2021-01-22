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
            'huerto' => (int)$ground->garden_id,
            'created_at' => (string)$ground->created_at,
            'updated_at' => (string)$ground->updated_at,
            'deleted_at' => isset($ground->deleted_at) ? (string)$ground->deleted_at : null,
        ];
    }

    public static function originalAttributes($index){
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'status' => 'status',
            'type' => 'type',
            'huerto' => 'garden_id',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
