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
            'name' => (string)$bed->name,
            'status' => (string)$bed->status,
            'type' => (string)$bed->type,
            'zona' => (string)$bed->ground_id,
            'created_at' => (string)$bed->created_at,
            'updated_at' => (string)$bed->updated_at,
            'deleted_at' => isset($bed->deleted_at) ? (string)$bed->deleted_at : null,
        ];
    }

    public static function originalAttributes($index){
        $attributes = [
            'id' => 'id',
            'name' => 'name',
            'status' => 'status',
            'type' => 'type',
            'zona' => 'ground_id',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
