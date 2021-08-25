<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticlesRequest;
use App\Interfaces\ArticlesServiceAdapter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{

    private $adapter;

    public function __construct(ArticlesServiceAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return response()->json($this->adapter->show());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticlesRequest $request
     * @return JsonResponse
     */
    public function store(ArticlesRequest $request) : JsonResponse
    {
        $collection = $request->safe()->collect();

        return response()->json($this->adapter->create($collection));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id) : JsonResponse
    {
        return response()->json($this->adapter->byId($id));
    }
}
