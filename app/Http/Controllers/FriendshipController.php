<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\FriendshipServiceInterface;
use App\Services\FriendshipService;

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
     * @param FriendshipServiceInterface $service
     */
    public function __construct(FriendshipServiceInterface $service)
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
        $user = \Auth::user();

        return view('friendship.index', [
            'user' => $user->id,
        ]);
    }

    /**
     * Return overview of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overview()
    {
        $user = \Auth::user();
        $models = $this->service->overview($user->id);

        return response($models);
    }

    /**
     * Return listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function friend()
    {
        $user = \Auth::user();
        $models = $this->service->friends($user->id);

        return response($models);
    }

    /**
     * Return listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function pending()
    {
        $user = \Auth::user();
        $models = $this->service->pending($user->id);

        return response($models);
    }

    /**
     * Return listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function blocked()
    {
        $user = \Auth::user();
        $models = $this->service->blocked($user->id);

        return response($models);
    }
}
