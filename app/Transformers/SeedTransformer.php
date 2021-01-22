<?php

namespace App\Transformers;

use App\Models\Seed;
use League\Fractal\TransformerAbstract;

class SeedTransformer extends TransformerAbstract
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
    public function transform(Seed $seed)
    {
        return [
            'id' => (int)$seed->id,
            'name' => (string)$seed->name,
            'status' => (string)$seed->status,
            'created_at' => (string)$seed->created_at,
            'updated_at' => (string)$seed->updated_at,
            'deleted_at' => isset($seed->deleted_at) ? (string)$seed->deleted_at : null,
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
