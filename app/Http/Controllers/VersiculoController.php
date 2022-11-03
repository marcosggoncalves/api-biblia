<?php

namespace App\Http\Controllers;

use App\Models\Versiculo;
use Exception;
use Illuminate\Http\Request;

class VersiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $versiculos = Versiculo::all();

            if (empty($versiculos)) {
                return Response()->json([
                    'status' => false,
                    'message' => 'Nenhum versiculo cadastrado!'
                ], 417);
            }

            return Response()->json([
                'status' => true,
                'versiculos' => $versiculos
            ]);
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => 'Não foi possivel carregar informações!',
                'error' => $e
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Versiculo::create($request->all());

            return Response()->json([
                'status' => true,
                'message' => 'Cadastro efetuado com sucesso!'
            ]);
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => 'Não foi possivel cadastrar versiculo!',
                'error' => $e
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $versiculo = Versiculo::findOrFail($id);

            return Response()->json([
                'status' => true,
                'versiculo' => $versiculo
            ]);
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => 'Não foi possivel encontrar versiculo!',
                'error' => $e
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $versiculo = Versiculo::findOrFail($id);
            $versiculo->update($request->all());

            return Response()->json([
                'status' => true,
                'message' => 'Cadastro alterado com sucesso!',
                'versiculo' => $versiculo
            ]);
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => 'Não foi possivel alterar cadastro!',
                'error' => $e
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $deletarVersiculo = Versiculo::destroy($id);

            if (!$deletarVersiculo) {
                return Response()->json([
                    'status' => false,
                    'message' => 'Não foi possivel excluir registro!'
                ], 417);
            }

            return Response()->json([
                'status' => true,
                'message' => 'Resgistro excluido com sucesso!'
            ]);
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => 'Não foi possivel excluir cadastro!',
                'error' => $e
            ], 500);
        }
    }
}
