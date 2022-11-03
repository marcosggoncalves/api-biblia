<?php

namespace App\Http\Controllers;

use App\Models\Testamento;
use Exception;
use Illuminate\Http\Request;

class TestamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $testamentos = Testamento::all();

            if (empty($testamentos)) {
                return Response()->json([
                    'status' => false,
                    'message' => 'Nenhum testamento cadastrado!'
                ], 417);
            }

            return Response()->json([
                'status' => true,
                'testamentos' => $testamentos
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
            Testamento::create($request->all());

            return Response()->json([
                'status' => true,
                'message' => 'Cadastro efetuado com sucesso!'
            ]);
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => 'Não foi possivel cadastrar testamento!',
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
            $testamento = Testamento::findOrFail($id);

            return Response()->json([
                'status' => true,
                'testamento' => $testamento,
                'livros' => $testamento->livros
            ]);
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => 'Não foi possivel encontrar testamento!',
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
            $testamento = Testamento::findOrFail($id);
            $testamento->update($request->all());

            return Response()->json([
                'status' => true,
                'message' => 'Cadastro alterado com sucesso!',
                'testamento' => $testamento
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
            $deletarTestamento = Testamento::destroy($id);

            if (!$deletarTestamento) {
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
