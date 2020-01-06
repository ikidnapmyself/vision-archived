<?php

namespace App\Http\Controllers;

use App\Models\Assignee;
use App\Services\AssigneeService;
use Illuminate\Http\Request;

class AssigneeController extends Controller
{
    /**
     * Assignee service.
     *
     * @var AssigneeService
     */
    private $service;

    /**
     * AssigneeController constructor.
     *
     * @param AssigneeService $service
     */
    public function __construct(AssigneeService $service)
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return \Illuminate\Http\Response
     */
    public function show(Assignee $assignee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignee $assignee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return \Illuminate\Http\Response
     */
    public function update(string $assignee)
    {
        $update = $this->service->update($assignee);

        return response($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignee $assignee)
    {
        //
    }
}
