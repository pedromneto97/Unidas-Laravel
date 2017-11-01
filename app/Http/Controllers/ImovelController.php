<?php

namespace App\Http\Controllers;

use App\Imovel;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $imoveis = DB::table('imoveis')
                ->leftJoin('tipos', 'imoveis.id_tipo', '=', 'tipos.id')
                ->leftJoin('finalidades', 'imoveis.id_finalidade', '=', 'finalidades.id')
                ->leftJoin('ruas', 'imoveis.id_rua', '=', 'ruas.id')
                ->leftJoin('bairros', 'ruas.id_bairro', '=', 'bairros.id')
                ->leftJoin('cidades', 'bairros.id_cidade', '=', 'cidades.id')
                ->leftJoin('estados', 'cidades.id_estado', '=', 'estados.id')
                ->leftJoin('fotos', 'imoveis.id', '=', 'fotos.id_imovel')
                ->limit(8)
                ->get();
            return response()->json($imoveis);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 419);
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
                'numero' => 'numeric|nullable',
                'valor' => 'numeric|nullable',
                'dormitorio' => 'numeric|nullable',
                'suite' => 'numeric|nullable',
                'banheiros' => 'numeric|nullable',
                'garagem' => 'numeric|nullable',
                'mobilia' => 'boolean',
                'aservico' => 'boolean',
                'descricao' => 'required|string',
                'aterreno' => 'numeric|nullable',
                'aconstruida' => 'numeric|nullable',
                'id_rua' => 'exists:ruas,id',
                'id_tipo' => 'exists:tipos,id',
                'id_finalidade' => 'exists:finalidades,id'
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);

            $imovel = new Imovel();
            $imovel->fill($request->all());
            $imovel->save();
            return response()->json($imovel);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 419);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Imovel $imovel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $imovel = DB::table('imoveis')
                ->leftJoin('tipos', 'imoveis.id_tipo', '=', 'tipos.id')
                ->leftJoin('finalidades', 'imoveis.id_finalidade', '=', 'finalidades.id')
                ->leftJoin('ruas', 'imoveis.id_rua', '=', 'ruas.id')
                ->leftJoin('bairros', 'ruas.id_bairro', '=', 'bairros.id')
                ->leftJoin('cidades', 'bairros.id_cidade', '=', 'cidades.id')
                ->leftJoin('estados', 'cidades.id_estado', '=', 'estados.id')
                ->where('imoveis.id', $id)
                ->get();
//            $imovel = Imovel::find($id)->Rua()->get();
            $imovel = Imovel::with('rua')
                ->with('rua.bairro')
                ->with('rua.bairro.cidade')
                ->with('rua.bairro.cidade.estado')
                ->with('finalidade')
                ->with('tipo')
                ->where('id', $id)
                ->get();
            return response()->json($imovel);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 419);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Imovel $imovel
     * @return \Illuminate\Http\Response
     */
    public function edit(Imovel $imovel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Imovel $imovel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $imovel = Imovel::find($id);
            $validator = Validator::make($request->all(), [
                'numero' => 'numeric|nullable',
                'valor' => 'numeric|nullable',
                'dormitorio' => 'numeric|nullable',
                'suite' => 'numeric|nullable',
                'banheiros' => 'numeric|nullable',
                'garagens' => 'numeric|nullable',
                'mobilia' => 'boolean',
                'aservico' => 'boolean',
                'descricao' => 'string',
                'aterreno' => 'numeric|nullable',
                'aconstruida' => 'numeric|nullable',
                'id_rua' => 'exists:ruas,id',
                'id_tipo' => 'exists:tipos,id',
                'id_finalidade' => 'exists:finalidades,id'
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);
            $imovel->update($request->all());
            return response()->json($imovel);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 419);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Imovel $imovel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            if (Imovel::destroy($id))
                return response("Imovel deletado", 200);
            else
                return response("Nenhum imovel deletado", 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 419);
        }
    }
}
