<?php

namespace App\Http\Controllers\Website\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $activity;

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function index()
    {
        return $this->activity->getActivity()['data'];
    }
}
