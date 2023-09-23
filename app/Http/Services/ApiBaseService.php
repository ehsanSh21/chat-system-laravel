<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;

class ApiBaseService
{

    public function store(Model $model,array $payback):  Model
    {
       return $model::create($payback);
    }


    public function update(Model $model,array $payback):  Model
    {
     $model->update($payback);
     return $model;
    }

    public function delete(Model $model):  Model
    {
        $model->delete();
        return $model;
    }

}
