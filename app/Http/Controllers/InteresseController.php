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
    public function show(Request $request, $id)
    {
        try {
            $interesse = Interesse::find($id);
            return response()->json($interesse);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
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
        try {
            $validator = Validator::make($request->all(), [
                'atendido' => 'required|boolean'
            ]);
            if ($validator->fails())
                return response($validator->errors(), 401);
            $interesse->update(['atendido' => $request->atendido]);
            return response()->json($interesse);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interesse $interesse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $interesse = Interesse::find($id);
            if ($interesse->delete())
                return response('Imóvel deletado', 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    public function atender(Request $request)
    {
        try {
            $interesse = Interesse::where('atendido', false)->get();
            return response()->json($interesse);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }
}
