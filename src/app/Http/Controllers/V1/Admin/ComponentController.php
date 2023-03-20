<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Requests\V1\Admin\Component\SaveComponentRequest;
use App\Http\Requests\V1\Admin\Component\ListComponentRequest;
use App\Http\Requests\V1\Admin\Component\UpdateComponentRequest;
use App\Http\Resources\V1\Admin\Component\ComponentResource;
use App\Http\Resources\V1\Admin\Component\DressComponentResource;
use App\Http\Resources\V1\Admin\Component\ComponentCollection;
use App\Models\V1\Component;
use App\Http\Services\V1\MultiKit;


class ComponentController
{

    /**
     * @param SaveComponentRequest $request
     * @return ComponentResource
     */
    public function save(SaveComponentRequest $request): ComponentResource
    {
        $component =
            MultiKit
                ::multiCreate(Component::class, $request->validated());

        return new ComponentResource($component);
    }


    /**
     * @param ListComponentRequest $request
     * @return ComponentCollection
     */
    public function list(ListComponentRequest $request): ComponentCollection
    {
        $requestData = $request->validated();

        $component =
            Component
                ::select()
                ->with('translation:component_id,title,description')
                ->paginate(perPage: $requestData['per_page'] ?? 10, page: $requestData['page'] ?? 1);

        return new ComponentCollection($component);
    }


    /**
     * @param UpdateComponentRequest $request
     * @return ComponentResource
     */
    public function update(UpdateComponentRequest $request): ComponentResource
    {
        $requestData = $request->validated();

        $component =
            MultiKit
                ::multiUpdate(Component::class, $requestData);

        return new ComponentResource($component);
    }
}














