<?php

namespace App\Http\Controllers;

use App\Foto;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FotoController extends Controller
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
                'foto' => 'required|file',
                'id_imovel' => 'required|exists:imoveis,id'
            ]);
            if ($validator->fails())
                return response($validator->errors(), 401);
            $ext = $request->foto->extension();
            $nome = time();
            $nome = "{$nome}.{$ext}";
            $upload = $request->foto->storeAs('imagens', $nome, 'public');
            sleep(1);
            if (!$upload)
                return response('Erro ao realizar upload', 401);
            $foto = new Foto();
            $foto->fill([
                'id_imovel' => $request->id_imovel,
                'foto' => $nome
            ]);
            $foto->save();
            return response()->json($foto);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Foto $foto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $foto = Foto::find($id);
            return response()->json($foto);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Foto $foto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Foto $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $foto = Foto::find($id);
            $validator = Validator::make($request->all(), [
                'foto' => 'required|file',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 401);
            $ext = $request->foto->extension();
            $nome = time();
            $nome = "{$nome}.{$ext}";
            $upload = $request->foto->storeAs('imagens', $nome, 'public');
            if (!$upload)
                return response('Erro ao realizar upload', 401);
            Storage::disk('public')->delete("imagens/{$foto->foto}");
            $foto->update([
                'foto' => $nome
            ]);
            return response()->json($foto);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Foto $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $foto = Foto::find($id);
            $nome = $foto->foto;
            if ($foto->delete()) {
                Storage::disk('public')->delete("imagens/{$nome}");
                return response("Foto deletada", 200);
            } else
                return response("Nenhuma foto deletada", 204);
            return response()->json($foto);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    public function imovel($id)
    {
        try {
            $fotos = Foto::where('id_imovel', $id)->get();
            return response()->json($fotos);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }
}
