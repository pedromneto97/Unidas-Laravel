<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $estado = Estado::all();
            return response()->json($estado);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
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
                'estado' => 'required|string|min:3|unique:estados',
                'uf' => 'required|string|size:2|unique:estados',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);

            $estado = new Estado();
            $estado->fill($request->all());
            $estado->save();
            return response()->json($estado);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 419);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estado $estado
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        try {
            $estado = Estado::find($id);
            return response()->json($estado);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 419);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estado $estado
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Estado $estado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Estado $estado
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        try {
            $estado = Estado::find($id);
            $validator = Validator::make($request->all(), [
                'estado' => 'required|string|min:3|unique:estados',
                'uf' => 'required|string|size:2|unique:estados',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);
            $estado->update($request->all());
            return response()->json($estado);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 419);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estado $estado
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        try {

            if (Estado::destroy($id))
                return response("Estado deletado", 200);
            else
                return response("Nenhum estado deletado", 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 419);
        }
    }
}
