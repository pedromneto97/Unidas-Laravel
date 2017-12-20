<?php

namespace App\Http\Controllers;

use App\Tipo;
use DB;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tipo = DB::table('tipos')
                ->orderBy('tipo', 'ASC')
                ->get();
            return response()->json($tipo);

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
                'tipo' => 'required|string',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);

            $tipo = new Tipo();
            $tipo->fill($request->tipo);
            $tipo->save();
            return response()->json($tipo);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipo $tipo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $tipo = Tipo::find($id);
            return response()->json($tipo);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipo $tipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo $tipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Tipo $tipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $tipo = Tipo($id);
            $validator = Validator::make($request->all(), [
                'tipo' => 'required|string',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);
            $tipo->update($request->tipo);
            return response()->json($tipo);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipo $tipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Tipo::destroy($id);
            return response('Tipo deletado');

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }
}
