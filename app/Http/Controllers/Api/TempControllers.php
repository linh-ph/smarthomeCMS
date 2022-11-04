<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\FeaturesRepository;
use Illuminate\Http\Request;

class TempControllers extends Controller
{
    protected $featureRepo;

    public function __construct(FeaturesRepository $featureRepo)
    {
        $this->featureRepo = $featureRepo;
    }

}
