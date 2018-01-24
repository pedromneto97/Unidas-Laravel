<?php

namespace App\Http\Controllers;

use App\Interesse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InteresseController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'string|min:3|max:60',
                'telefone' => 'nullable|string',
                'email' => 'nullable|string|email',
                'id_imovel' => 'exists:imoveis,id'
            ]);
            if ($validator->fails())
                return response($validator->errors(), 401);

            $interesse = new Interesse();
            $interesse->fill($request->all());
            $interesse->atendido = false;
            $interesse->save();
            return response()->json($interesse);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interesse $interesse
     * @return \Illuminate\Http\Response
     */
    public function show(Interesse $interesse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interesse $interesse
     * @return \Illuminate\Http\Response
     */
    public function edit(Interesse $interesse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Interesse $interesse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interesse $interesse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interesse $interesse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interesse $interesse)
    {
        //
    }
}
