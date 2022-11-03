<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Exception;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $livros = Livro::all();

            if (empty($livros)) {
                return Response()->json([
                    'status' => false,
                    'message' => 'Nenhum livro cadastrado!'
                ], 417);
            }

            return Response()->json([
                'status' => true,
                'livros' => $livros
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
            Livro::create($request->all());

            return Response()->json([
                'status' => true,
                'message' => 'Cadastro efetuado com sucesso!'
            ]);
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => 'Não foi possivel cadastrar livro!',
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
            $livro = Livro::findOrFail($id);

            return Response()->json([
                'status' => true,
                'livro' => $livro,
                'testamento' => $livro->testamento,
                'versiculos' => $livro->versiculos
            ]);
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => 'Não foi possivel encontrar livro!',
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
            $livro = Livro::findOrFail($id);
            $livro->update($request->all());

            return Response()->json([
                'status' => true,
                'message' => 'Cadastro alterado com sucesso!',
                'livro' => $livro
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
            $deletarLivro = Livro::destroy($id);

            if (!$deletarLivro) {
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
