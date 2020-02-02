<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\TaskServiceInterface;

class HomeController extends Controller
{
    /**
     * Task service.
     *
     * @var TaskServiceInterface
     */
    private $service;

    /**
     * TaskController constructor.
     *
     * @param TaskServiceInterface $service
     */
    public function __construct(TaskServiceInterface $service)
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
