<?php

namespace Plans\Http\Controllers;

use Illuminate\Http\Request;
use Plans\Http\Requests\CreateBuilding;
use Plans\Models\Building;

class BuildingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Building $building)
    {
        return view('buildings.index')
            ->withBuildings($building->all());
    }

    public function create()
    {
        return view('buildings.create')
            ->withBuilding(new Building);
    }

    public function store(CreateBuilding $request, Building $building)
    {
        $building->create($request->all());

        return back();
    }

    public function show(Building $building)
    {
        return view('buildings.show')
            ->withBuilding($building->with('plans', 'pictures', 'plans.floors', 'plans.types')->where('id', $building->id)->first());
    }


}
