<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        try {
            Log::info('Getting all products');
            $products = DB::table('products')->select('name')->get()->toArray();

            return response()->json([
                'success' => true,
                'message' => "Products retrieved successfull",
                'data' => $products,
            ]);
        } catch (\Exception $exception) {
            Log::info('Error getting products' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => "Error getting products"

                ],
                500
            );
        }
    }
    public function create(Request $request)
    {
        try {
            $newName = $request->input('name');
            $newDescription = $request->input('description');
            $newImages = $request->input('images');
            $newCapacidad = $request->input('capacidad');
            $newPrecio = $request->input('precio');


            $validator = Validator::make(
                $request->all(),
                [

                    'name' => 'required|string|max:25',
                    'description' => 'required|string|max:255',
                    'images' => 'required|string',
                    'capacidad' => 'required|string',
                    'categoria' => 'required|string',
                    'precio' => 'required|string',

                ]
            );

            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => $validator->errors()
                    ],
                    400
                );
            }
            $newProduct = new Product();
            $newProduct->name = $newName;
            $newProduct->description = $newDescription;
            $newProduct->images = $newImages;
            $newProduct->capacidad = $newCapacidad;
            $newProduct->precio = $newPrecio;
            $newProduct->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Product updated successfully',
                    'data' => $newProduct
                ],
                200
            );
        } catch (\Exception $exeption) {

            Log::error('Error to create a new product' . $exeption->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => 'error to create a new product'
                ],
                404
            );
        };
    }
    public function getProductId($id)
    {
        try {
            Log::info('Getting product by id');
            $product = Product::query()->find($id);

            if (!$product) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => "Product not found",
                    ],
                    404
                );
            }

            return response()->json([
                'success' => true,
                'message' => "Product retrieved successfull",
                'data' => $product,
            ]);
        } catch (\Exception $exception) {
            Log::info('Error getting product' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => "Error getting product"

                ],
                500
            );
        }
    }
    public function editProductById($id, Request $request)
    {
        try {
            Log::info('Uptading product');
            $product = Product::find($id);
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'description' => 'string',
                'images' => 'string',
                'capacidad' => 'string',
                'precio' => 'string',
            ]);


            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->images = $request->input('images');
            $product->unidades = $request->input('capacidad');
            $product->precio = $request->input('precio');
            $product->save();
            return response()->json(
                [
                    'success' => true,
                    'message' => "Product updated successfull",
                    'data' => $product
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::info('Error updating product' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => "Error updating product"

                ],
                500
            );
        }
    }
    public function deleteProductById($id)
    {
        try {
            Log::info('Deleting product');
            $product = Product::query()->find($id);
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => "Product deleted succesfull",
            ]);
        } catch (\Exception $exception) {
            Log::info('Error deleting product' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => "Error deleting product"

                ],
                500
            );
        }
    }
    public function updatePedidoStatus(Request $request, $pedidoId)
    {
        try {
            $pedido = Pedido::query()->find($pedidoId);
            $pedido->estado = $request->input('estado');
            $pedido->save();
            return response()->json(
                [
                    'success' => true,
                    'message' => "pedido updated"

                ],
                200
            );
        } catch (\Exception $exception) {
            Log::info('Error updating status' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => "Error updating status"

                ],
                500
            );
        }
    }




    public function pedidoStatus($estado)
    {
        try {

            $pedidosPending = Pedido::query()->where('estado', $estado)->get();
            return response()->json(
                [
                    'success' => true,
                    'message' => "pedido " . $estado,
                    'pedidos' => $pedidosPending

                ],
                200
            );
        } catch (\Exception $exception) {
            Log::info('Error pedidos ' . $estado . ' status' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error pedidos ' . $estado . ' status'

                ],
                500
            );
        }
    }
    public function pedidoByDate()
    {
        try {

            $pedidosByDate = Pedido::query()->orderBy('created_at', 'DESC')->get();
            return response()->json(
                [
                    'success' => true,
                    'message' => "pedido ordenados por fecha descendiente",
                    'pedidos' => $pedidosByDate

                ],
                200
            );
        } catch (\Exception $exception) {
            Log::info('Error pedidos por fecha ' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error pedidos por fecha'

                ],
                500
            );
        }
    }
}
