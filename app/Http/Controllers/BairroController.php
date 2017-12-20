<?php

namespace App\Http\Controllers;

use App\Bairro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BairroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $bairro = Bairro::with('cidade')
                ->with('cidade.estado')
                ->get();
            return response()->json($bairro);
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
                'bairro' => 'required|string|min:3',
                'id_cidade' => 'required|exists:cidades,id',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);
            $bairro = new Bairro();
            $bairro->fill([
                'bairro' => $request->bairro,
                'id_cidade' => $request->id_cidade
            ]);
            $bairro->save();
            return response()->json($bairro);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bairro $bairro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $bairro = Bairro::with('cidade')
                ->with('cidade.estado')
                ->where('id', $id)
                ->first();
            return response()->json($bairro);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bairro $bairro
     * @return \Illuminate\Http\Response
     */
    public function edit(Bairro $bairro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Bairro $bairro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $bairro = Bairro::find($id);
            $validator = Validator::make($request->all(), [
                'bairro' => 'required|string|min:3',
                'id_cidades' => 'required|exist:cidades,id',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);
            $bairro->update($request->all());
            return response()->json($bairro);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bairro $bairro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Bairro::destroy($id))
                return response("Bairro deletado", 200);
            else
                return response("Nenhum bairro deletado", 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    //Busca bairro
    public function busca(Request $request)
    {
        try {
            $bairro = Bairro::where('bairro', 'like', $request->bairro)->get();
            if ($bairro->count() > 0)
                return response()->json($bairro);
            else
                return response('Nada encontrado', 204);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }
}
