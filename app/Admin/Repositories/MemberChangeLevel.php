<?php

namespace App\Admin\Repositories;

use App\Models\MemberChangeLevel as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MemberChangeLevel extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
