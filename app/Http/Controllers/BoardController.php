<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\BoardServiceInterface;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Board service.
     *
     * @var BoardServiceInterface
     */
    private $service;

    /**
     * BoardController constructor.
     *
     * @param BoardServiceInterface $service
     */
    public function __construct(BoardServiceInterface $service)
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
        return view('board.index');
    }

    /**
     * Return listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $user = \Auth::user();
        $boards = $this->service->index($user);

        return response($boards);
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
        return response($this->service->show($id));
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
