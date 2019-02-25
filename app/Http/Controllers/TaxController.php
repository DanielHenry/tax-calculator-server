<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;
use Validator;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $payload = $request->isJson() ? $request->json()->all() : [];
            $rules = [
                'name' => 'required|string|max:254',
                'taxCode' => 'required|integer|max:1',
                'price' => 'required|integer|max:11',
            ];
            $validator = Validator::make($payload, $rules);
            if ($validator->fails()) {
                return response()->json([
                    'msg' => 'Invalid parameter!',
                ]);
            } else {
                $tax = new Tax;
                $tax->name = $payload['name'];
                $tax->tax_code = $payload['taxCode'];
                $tax->price = $payload['price'];
                $tax->save();
                return response()->json([
                    'msg' => 'Success create a tax!',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Error appears!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        //
    }
}
