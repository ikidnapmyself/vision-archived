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
     * Authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private function user()
    {
        return \Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('friendship.index', [
            'user' => $this->user()->id,
        ]);
    }

    /**
     * Return listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function friend()
    {
        $models = $this->service->friends($this->user()->id);

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
        $models = $this->service->pending($this->user()->id);

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
        $models = $this->service->blocked($this->user()->id);

        return response($models);
    }
}
