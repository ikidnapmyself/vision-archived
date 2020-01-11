<?php

namespace App\Http\Controllers;

use App\Services\FriendshipService;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    /**
     * Friendship service.
     *
     * @var FriendshipService
     */
    private $service;

    /**
     * FriendshipController constructor.
     *
     * @param FriendshipService $service
     */
    public function __construct(FriendshipService $service)
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
        return view('friendship.index', [
            'friendships' => $this->service->index(),
        ]);
    }

    /**
     * Return listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $models = $this->service->index();

        return response($models);
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
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $collection = $this->service->show($id);

        return response($collection);
    }

    /**
     * Return related listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showList(string $user)
    {
        $models = $this->service->show($user);

        return response($models);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
