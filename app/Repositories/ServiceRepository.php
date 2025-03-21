<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;


class ServiceRepository implements ServiceRepositoryInterface
{
    protected $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $service = $this->find($id);
        $service->update($data);
        return $service;
    }

    public function delete($id)
    {
        $service = $this->find($id);
        $service->delete();
        return $service;
    }
}