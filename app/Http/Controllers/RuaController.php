<?php

namespace App\Http\Controllers;

use App\Rua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $rua = Rua::with('bairro')
                ->with('bairro.cidade')
                ->with('bairro.cidade.estado')
                ->get();
            return response()->json($rua);
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
                'cep' => 'sometimes|required|integer|digits:8',
                'rua' => 'required|string',
                'id_bairro' => 'required|exists:estados,id'
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);
            $rua = new Rua();
            $rua->fill([
                'cep' => $request->cep,
                'rua' => $request->rua,
                'id_bairro' => $request->id_bairro
            ]);
            $rua->save();
            return response()->json($rua);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rua $rua
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $rua = Rua::with('bairro')
                ->with('bairro.cidade')
                ->with('bairro.cidade.estado')
                ->where('id', $id)
                ->first();
            return response()->json($rua);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rua $rua
     * @return \Illuminate\Http\Response
     */
    public function edit(Rua $rua)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Rua $rua
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $rua = Rua::find($id);
            $validator = Validator::make($request->all(), [
                'cep' => 'sometimes|required|integer|size:8',
                'rua' => 'required|string',
                'id_bairro' => 'required|exists:estados,id'
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);
            $rua->update($request->all());
            return response()->json($rua);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rua $rua
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Rua::destroy($id))
                return response("Rua deletada", 200);
            else
                return response("Nenhuma rua deletada", 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    //Encontra pelo CEP
    public function cep($id)
    {
        try {
            $rua = Rua::with('bairro')
                ->with('bairro.cidade')
                ->with('bairro.cidade.estado')
                ->where('cep', $id)
                ->get();
            if ($rua->count() > 0)
                return response()->json($rua);
            return response('Nenhum cep encontrado', 204);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

}
