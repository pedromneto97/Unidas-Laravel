<?php

namespace App\Http\Controllers;

use App\Finalidade;
use Illuminate\Http\Request;

class FinalidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $finalidade = Finalidade::all();
            return response()->json($finalidade);

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
                'finalidade' => 'required|string',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);

            $finalidade = new Finalidade();
            $finalidade->fill($request->finalidade);
            $finalidade->save();
            return response()->json($finalidade);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Finalidade $finalidade
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $finalidade = Finalidade::find($id);
            return response()->json($finalidade);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Finalidade $finalidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Finalidade $finalidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Finalidade $finalidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $finalidade = Finalidade::find($id);
            $validator = Validator::make($request->all(), [
                'finalidade' => 'required|string',
            ]);
            if ($validator->fails())
                return response($validator->errors(), 419);
            $finalidade->update($request->finalidade);
            $finalidade->save();
            return response()->json($finalidade);

        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finalidade $finalidade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Finalidade::destroy($id);
            return response("Finalidade deletada");
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }
}
