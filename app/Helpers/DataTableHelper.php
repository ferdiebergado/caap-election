<?php

namespace App\Helpers;

trait DataTableHelper
{
    protected function datatablePaginate(string $model, $with = [])
    {
        $request = app()->make('request');
        $this->validate($request, [
            'length' => [
                'integer',
                \Illuminate\Validation\Rule::in(config('app.perPageRange'))
            ],
            'sortBy' => 'string|nullable',
            'orderByMulti' => 'string|nullable'
        ]);
        $perPage = $this->getRequestLength($request);
        $model = $this->apply(app()->make($model), $request);
        $data['model'] = $model->with($with)->paginate($perPage);
        $data['draw'] = $request->draw;
        return $data;
    }
}
