<?php

namespace App\Http\Repositories;

use App\Http\Models\Site;

class SiteRepository extends BaseRepository
{

    public function __construct(Site $site)
    {
        $this->model = $site;
    }
}