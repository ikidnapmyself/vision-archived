<?php

namespace App\Http\Controllers;

use App\Models\Assignee;
use App\Interfaces\AssigneeServiceInterface;

class AssigneeController extends Controller
{
    /**
     * Assignee service.
     *
     * @var AssigneeServiceInterface
     */
    private $service;

    /**
     * AssigneeController constructor.
     *
     * @param AssigneeServiceInterface $service
     */
    public function __construct(AssigneeServiceInterface $service)
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
        abort(404);
    }

    /**
     * Assign the specified resource in storage.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store()
    {
        $assign = $this->service->create();

        return response($assign);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return \Illuminate\Http\Response
     */
    public function show(Assignee $assignee)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignee $assignee)
    {
        abort(404);
    }

    /**
     * Complete the specified task.
     *
     * @param  string  $assignee
     * @return \Illuminate\Http\Response
     */
    public function complete(string $assignee)
    {
        $update = $this->service->complete($assignee);

        return response($update);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $assignee
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
     * @param  string $assignee
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $assignee)
    {
        $destroy = $this->service->show($assignee);

        $destroy->delete();

        return response($destroy);
    }
}
