<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Interfaces\Services\TaskServiceInterface;

class TaskController extends Controller
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
     * @param  TaskServiceInterface  $service
     */
    public function __construct(TaskServiceInterface $service)
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
        return view('task.index');
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
     * @param  TaskRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TaskRequest $request)
    {
        $store = $this->service->create($request);

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
     * Update the specified resource in storage.
     *
     * @param  TaskRequest  $request
     * @param  string  $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TaskRequest $request, string $id)
    {
        $update = $this->service->update($request, $id);

        return response($update);
    }

    /**
     * Update status of a resource.
     *
     * @param  TaskStatusRequest  $request
     * @param  string  $task
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function status(TaskStatusRequest $request, string $task)
    {
        $status = $this->service->status($request, $task);

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
