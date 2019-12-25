<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Services\VisionService;
use Illuminate\Http\Request;

class TaskController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('task.index', [
            'tasks'   => $this->service->index(),
        ]);
    }

    /**
     * Return listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $tasks = $this->service->index();

        return response($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = $this->service->create();

        return redirect(
            route('task.show', $store->id)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        return view('task.show', [
            'task'    => $this->service->show($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        return view('task.edit', [
            'task' => $this->service->show($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(string $id)
    {
        $update = $this->service->update($id);

        return response($update);
    }

    /**
     * Update status of a resource.
     *
     * @param  string  $task
     * @param  string  $status
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function status(string $task, string $status, Request $request)
    {
        $reason = $request->get('reason', null);
        $status = $this->service->status($task, $status, $reason);

        return response($status);
    }

    /**
     * Update flag of a resource.
     *
     * @param  string  $task
     * @return \Illuminate\Http\Response
     */
    public function flag(string $task)
    {
        $status = $this->service->flag($task);

        return response($status);
    }

    /**
     * Update star of a resource.
     *
     * @param  string  $task
     * @return \Illuminate\Http\Response
     */
    public function star(string $task)
    {
        $status = $this->service->star($task);

        return response($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $destroyed = $this->service->delete($id);

        return (true === $destroyed) ? redirect(
            route('task.index')
        ) : back();
    }
}
