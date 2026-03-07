<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Mengambil data dari database berdasarkan model dan filter yang diberikan.')]
class GetDataTool extends Tool
{
    public function handle(Request $request): Response
    {
        $model = $request->get('model');
        $id    = $request->get('id');

        $modelClass = "App\\Models\\{$model}";

        if (!class_exists($modelClass)) {
            return Response::error("Model {$model} tidak ditemukan.");
        }

        $data = $id
            ? $modelClass::find($id)
            : $modelClass::all();

        return Response::structured($data);
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'model' => $schema->string()
                ->description('Nama model Laravel, contoh: User, Product')
                ->required(),
            'id' => $schema->integer()
                ->description('ID spesifik (opsional, kosongkan untuk ambil semua)'),
        ];
    }
}