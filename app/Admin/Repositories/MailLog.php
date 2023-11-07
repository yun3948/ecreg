<?php

namespace App\Admin\Repositories;

use App\Models\MailLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MailLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
