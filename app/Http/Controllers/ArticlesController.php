<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticlesRequest;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticlesServiceAdapter;
use Illuminate\Http\JsonResponse;

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
     * @return ArticleResource
     */
    public function store(ArticlesRequest $request) : ArticleResource
    {
        $collection = $request->safe()->collect();

        return $this->adapter->create($collection);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ArticleResource
     */
    public function show(int $id) : ArticleResource
    {
        return $this->adapter->byId($id);
    }
}
