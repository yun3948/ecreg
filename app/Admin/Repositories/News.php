<?php

namespace App\Admin\Repositories;

use App\Models\News as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class News extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
