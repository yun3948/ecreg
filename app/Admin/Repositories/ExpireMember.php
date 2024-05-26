<?php

namespace App\Admin\Repositories;

use App\Models\ExpireMember as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ExpireMember extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
