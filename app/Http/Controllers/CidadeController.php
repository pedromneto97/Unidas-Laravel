<?php

namespace App\Http\Controllers;

use App\Cidade;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cidade = Cidade::find();
            return response()->json($cidade);
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
                'cidade' => 'required|string|min:3',
                'id_estado' => 'required|exist:estados,id',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);

            $cidade = new Cidade();
            $cidade->fill($request->all());
            $cidade->save();
            return response()->json($cidade);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cidade $cidade
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $cidade = Cidade::find($id);
            return response()->json($cidade);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cidade $cidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Cidade $cidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Cidade $cidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $cidade = Cidade::find($id);
            $validator = Validator::make($request->all(), [
                'cidade' => 'required|string|min:3',
                'id_estado' => 'required|exist:estados,id',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);
            $cidade->update($request->all());
            return response()->json($cidade);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cidade $cidade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Cidade::destroy($id))
                return response("Cidade deletada", 200);
            else
                return response("Nenhuma cidade deletada", 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    //Busca cidade e estado
    public function busca(Request $request)
    {
        try {
            $estado = $request->estado;
            $cidade = $request->cidade;
            $uf = $request->uf;
            $resultado =
                Cidade::with('estado')
                    ->whereHas('estado', function ($query) use ($estado, $uf) {
                        $query->where('estado', $estado)
                            ->orWhere('uf', $uf);
                    })
                    ->where('cidades.cidade', $cidade)
                    ->get();
            return response()->json($resultado);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }
}
