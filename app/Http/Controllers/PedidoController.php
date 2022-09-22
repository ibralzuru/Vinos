<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    public function createPedido(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [     // validaciones 

                    'direccion' => 'required|string|max:55',
                    'monto_total' => 'required|string|max:10',
                    'estado' => 'required|string',
                    'user_id' => 'required|string',
                    'pago_id' => 'required|string',

                ]
            );

       

            //crear pedido
            $user = auth()->user();
            $newPedido = new Pedido();
            $newPedido->direccion = $request->input('direccion');
            $newPedido->monto_total = $request->input('monto_total');
            $newPedido->estado = $request->input('estado');
            $newPedido->user_id = auth()->user()->id;
           // $newPedido->pago_id = auth()->estado()->id;
            $newPedido->save();

            //crear registros en la tabla carritos de cada uno de los productos que tiene mi pedido


            return response()->json(
                [
                    'success' => true,
                    'message' => 'Pedido creado correctamente',
                    'data' => $newPedido
                ]
            );
        } catch (\Exception $exception) {
            Log::info('Error al crear pedido' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => "Error al crear pedido"

                ],
                500
            );
        }
    }
}
