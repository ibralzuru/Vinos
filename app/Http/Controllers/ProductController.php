<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        try {
            $newName = $request->input('name');
            $newDescription = $request->input('description');
            $newImages = $request->input('images');
            $newUnidades = $request->input('unidades');
            $newVolumen = $request->input('volumen');
            $newCategoria = $request->input('categoria');
            $newPrecio = $request->input('precio');


            $validator = Validator::make(
                $request->all(),
                [

                    'name' => 'required|string|max:25',
                    'description' => 'required|string|max:255',
                    'images' => 'required|array',
                    'unidades' => 'required|string',
                    'volumen' => 'required|string',
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
            $newProduct->unidades = $newUnidades;
            $newProduct->volumen = $newVolumen;
            $newProduct->categoria = $newCategoria;
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
                'images' => 'array',
                'unidades' => 'string',
                'volumen' => 'string',
                'categoria' => 'string',
                'precio' => 'string',
            ]);


            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->images = $request->input('images');
            $product->unidades = $request->input('unidades');
            $product->volumen = $request->input('volumen');
            $product->categoria = $request->input('categoria');
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
}
