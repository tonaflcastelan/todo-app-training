<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Todo;

/**
 * En esta clase deben implementar los metodos vacios de acuerdo a lo
 * previamente estudiado acerca de RESTFul. Recuerda que DEBEN validar los datos
 * de entrada y de regresar lo que les pide el método correctamente.
 *
 * Class TodoController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * Este método del controlador regresa el listado del todos de la app
     * en un response del tipo json ordenados desde el más antiguo al más nuevo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $todo = Todo::orderBy('created_at', 'desc')->get();

        return $todo;
    }

    /**
     * Este método del controlador debe crear un nuevo registro todo
     * y al final regresa el registro creado en un response del tipo
     * json.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'text' => 'required',
            'done' => 'required|boolean'
        ];

        $messages = [
            'required'  => 'El campo :attribute es requerido',
            'boolean'   => 'El campo :attribute debe ser boolenao',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        }

        $data = Todo::create($request->all());

        return Response::json([
                'success' => true,
                'message' => "Data inserted {$data->text}"
            ], 200);
    }

    /**
     * Modifica el item todo con el $id correspondiente
     * y regresa el mismo item modificado.
     *
     * @param integer $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $rules = [
            'text' => 'required',
            'done' => 'required|boolean'
        ];

        $messages = [
            'required'  => 'El campo :attribute es requerido',
            'boolean'   => 'El campo :attribute debe ser boolenao',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ], 400);
        }

        $updated = Todo::find($id)->update($request->all());

        return Response::json([
                'success' => true,
                'message' => "Data updated"
            ], 200);
    }

    /**
     * Elimina el registro y devuelve un response 200 en caso de exito o un 400
     * en caso de fallo pero igual en tipo json.
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return Response::json([
                'success' => true,
                'message' => "Data deleted"
            ], 200);
    }
}
