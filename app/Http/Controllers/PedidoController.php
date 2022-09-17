<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class PedidoController extends Controller
{
    public function createPedido(Request $request){
        try {
           $user = auth()->user();
           $newPedido = new Pedido();
           $newPedido->direccion = $request->input('direccion');
           $newPedido->pedidos = $request->input('pedidos');
           $newPedido->monto_total = $request->input('monto_total');
           $newPedido->estado = $request->input('estado');
           $newPedido->precio = $request->input('precio');
           $newPedido->user_id= auth()->user()->id;
           $newPedido->pago_id= auth()->user()->id;
           $newPedido->save();
           
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
