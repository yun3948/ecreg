<?php

namespace App\Admin\Repositories;

use App\Models\MemberLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MemberLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
