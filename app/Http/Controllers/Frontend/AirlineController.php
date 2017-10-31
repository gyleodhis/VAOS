<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Airline;
use App\Repositories\AirlineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Prettus\Repository\Criteria\RequestCriteria;

class AirlineController extends Controller
{

    private $airlineRepo;

    public function __construct(AirlineRepository $airlinesRepo)
    {
        $this->airlineRepo = $airlinesRepo;
    }


    /**
     * Display a listing of airlines.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->airlineRepo->pushCriteria(new RequestCriteria($request));
        $airlines = $this->airlineRepo->all();

        //TODO: Add view to this function
        return view('airline.index', compact($airlines));
    }

    /**
     * Show the form for creating a new airline.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO: Add view to this function
        return view('airline.create');
    }

    /**
     * Store a newly created airline in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $airline = $this->airlineRepo->create($request->all());

        //TODO: Add view to this function
        return redirect()->route('airline.index')->with('success', 'Successfully created the new '.$airline->name.' airline to the database');
    }

    /**
     * Display the specified airline.
     *
     * @param  \App\Models\Airline  $airline
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Airline $airline)
    {
        //TODO: Add view to this function
        return redirect()->route('airline.index');
    }

    /**
     * Show the form for editing the specified airline.
     *
     * @param  \App\Models\Airline  $airline
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Airline $airline)
    {
        //TODO: Add view to this function
        return view('airline.edit', compact($airline));
    }

    /**
     * Update the specified airline in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Airline  $airline
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Airline $airline)
    {
        $airline = $this->airlineRepo->update($request->all(), $airline->id);

        //TODO: Add view to this function
        return redirect()->route('airline.index')->with('success', 'Successfully update the '.$airline->name.' airline in the database');
    }

    /**
     * Remove the specified airline from storage.
     *
     * @param  \App\Models\Airline  $airline
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Airline $airline)
    {
        $this->airlineRepo->delete($airline->id);

        //TODO: Add view to this function
        return redirect()->route('airline.index')->with('success', 'Successfully delete the '.$airline->name.' airline from the database');
    }
}
