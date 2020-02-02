<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\StatusServiceInterface;

class StatusController extends Controller
{
    /**
     * Status service.
     *
     * @var StatusServiceInterface
     */
    private $service;

    /**
     * StatusController constructor.
     *
     * @param StatusServiceInterface $service
     */
    public function __construct(StatusServiceInterface $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response($this->service->index());
    }
}
