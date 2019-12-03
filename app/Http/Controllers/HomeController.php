<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Services\VisionService;

class HomeController extends Controller
{
    /**
     * Task service.
     *
     * @var TaskService
     */
    private $service;

    /**
     * Vision service.
     *
     * @var VisionService
     */
    private $visionService;

    /**
     * TaskController constructor.
     *
     * @param TaskService $service
     * @param VisionService $visionService
     */
    public function __construct(TaskService $service, VisionService $visionService)
    {
        $this->service = $service;
        $this->visionService = $visionService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['visions' => $this->visionService->defaults()]);
    }
}
