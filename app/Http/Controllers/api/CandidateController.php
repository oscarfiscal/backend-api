<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Resources\Candidate as CandidateResources;
use App\Http\Resources\CandidateCollection;

class CandidateController extends Controller
{

    protected $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if (auth()->user()->role == 'manager') {
            return new CandidateCollection($this->candidate->all());
        }
        
        if (auth()->user()->role == 'agent') {
            return new CandidateCollection($this->candidate->where('owner', auth()->user()->id)->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $candidate = $this->candidate->create($request->all());
      
        return response()->json(new CandidateResources($candidate),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = Candidate::find($id);  
        if (is_null($candidate)) {
            return response()->json(["meta"=>[
                "success"=>false,
                "errors"=>"lead not found"
            ]],404);
       
        }
     
        return new CandidateResources($candidate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
