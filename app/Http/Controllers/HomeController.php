<?php

namespace App\Http\Controllers;

use App\Services\TaskService;

class HomeController extends Controller
{
    /**
     * Task service.
     *
     * @var TaskService
     */
    private $service;

    /**
     * TaskController constructor.
     *
     * @param TaskService $service
     */
    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
