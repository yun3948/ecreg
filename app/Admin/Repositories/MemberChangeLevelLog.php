<?php

namespace App\Admin\Repositories;

use App\Models\MemberChangeLevelLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MemberChangeLevelLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
