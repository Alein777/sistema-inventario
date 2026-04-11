<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Proveedor;
use App\Models\Producto;

class TomodachiSeeder extends Seeder
{
    public function run(): void
    {
        // Categorías del juego
        $categorias = [
            ['nombre' => 'Comida principal', 'estado' => 1],
            ['nombre' => 'Postres',          'estado' => 1],
            ['nombre' => 'Bebidas',          'estado' => 1],
            ['nombre' => 'Ropa',             'estado' => 1],
            ['nombre' => 'Sombreros',        'estado' => 1],
            ['nombre' => 'Interiores',       'estado' => 1],
            ['nombre' => 'Regalos',          'estado' => 1],
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }

        // Departamentos y municipios de la isla
        $sansimeon = Departamento::create(['nombre' => 'Isla San Simeón']);
        $central   = Municipio::create(['nombre' => 'Centro de la Isla', 'id_departamento' => $sansimeon->id]);
        $muelle    = Municipio::create(['nombre' => 'Muelle de la Isla', 'id_departamento' => $sansimeon->id]);

        // Proveedores
        $foodmart = Proveedor::create([
            'nombre'       => 'Food Mart',
            'contacto'     => 'Tom Nook Jr.',
            'telefono'     => '0000-0001',
            'email'        => 'foodmart@isla.com',
            'tipo'         => 'Nacional',
            'id_municipio' => $central->id,
            'estado'       => 1,
        ]);

        $tiendaropa = Proveedor::create([
            'nombre'       => 'Tienda de Ropa',
            'contacto'     => 'Isabelle',
            'telefono'     => '0000-0002',
            'email'        => 'ropa@isla.com',
            'tipo'         => 'Nacional',
            'id_municipio' => $central->id,
            'estado'       => 1,
        ]);

        $mercado = Proveedor::create([
            'nombre'       => 'Mercado del Muelle',
            'contacto'     => 'Brewster',
            'telefono'     => '0000-0003',
            'email'        => 'mercado@isla.com',
            'tipo'         => 'Nacional',
            'id_municipio' => $muelle->id,
            'estado'       => 1,
        ]);

        // Productos — Comida principal
        $comida = Categoria::where('nombre', 'Comida principal')->first();
        $postres = Categoria::where('nombre', 'Postres')->first();
        $bebidas = Categoria::where('nombre', 'Bebidas')->first();
        $ropa    = Categoria::where('nombre', 'Ropa')->first();
        $sombreros = Categoria::where('nombre', 'Sombreros')->first();
        $interiores = Categoria::where('nombre', 'Interiores')->first();
        $regalos = Categoria::where('nombre', 'Regalos')->first();

        $productos = [
            // Comida
            ['nombre' => 'Curry de arroz',       'detalle' => 'Comida favorita de muchos Miis. Nivel de picante medio.',         'precio_compra' => 2.50, 'precio_venta' => 5.00,  'stock' => 30, 'stock_minimo' => 5, 'id_categoria' => $comida->id,    'id_proveedor' => $foodmart->id],
            ['nombre' => 'Sándwich de atún',     'detalle' => 'Clásico sándwich. Ideal para Miis con personalidad tranquila.',   'precio_compra' => 1.50, 'precio_venta' => 3.00,  'stock' => 25, 'stock_minimo' => 5, 'id_categoria' => $comida->id,    'id_proveedor' => $foodmart->id],
            ['nombre' => 'Ramen',                'detalle' => 'Sopa de fideos caliente. Perfecta para días fríos en la isla.',   'precio_compra' => 2.00, 'precio_venta' => 4.00,  'stock' => 20, 'stock_minimo' => 5, 'id_categoria' => $comida->id,    'id_proveedor' => $foodmart->id],
            ['nombre' => 'Pizza',                'detalle' => 'Pizza clásica de la isla. Favorita de los Miis más sociables.',   'precio_compra' => 3.00, 'precio_venta' => 6.00,  'stock' => 15, 'stock_minimo' => 3, 'id_categoria' => $comida->id,    'id_proveedor' => $mercado->id],
            ['nombre' => 'Sushi',                'detalle' => 'Sushi fresco del muelle. Solo los Miis más refinados lo piden.',  'precio_compra' => 4.00, 'precio_venta' => 8.00,  'stock' => 10, 'stock_minimo' => 3, 'id_categoria' => $comida->id,    'id_proveedor' => $mercado->id],
            // Postres
            ['nombre' => 'Pastel de cumpleaños', 'detalle' => 'Pastel especial para celebrar. Los Miis lo adoran.',             'precio_compra' => 3.50, 'precio_venta' => 7.00,  'stock' => 12, 'stock_minimo' => 2, 'id_categoria' => $postres->id,   'id_proveedor' => $foodmart->id],
            ['nombre' => 'Helado de fresa',      'detalle' => 'Helado suave. Perfecta para el verano en la isla.',              'precio_compra' => 1.00, 'precio_venta' => 2.50,  'stock' => 40, 'stock_minimo' => 10,'id_categoria' => $postres->id,   'id_proveedor' => $foodmart->id],
            ['nombre' => 'Donut',                'detalle' => 'Donut esponjoso con glaseado. Snack favorito de la tarde.',      'precio_compra' => 0.75, 'precio_venta' => 1.50,  'stock' => 50, 'stock_minimo' => 10,'id_categoria' => $postres->id,   'id_proveedor' => $mercado->id],
            // Bebidas
            ['nombre' => 'Café',                 'detalle' => 'Café especial de Brewster. El mejor de toda la isla.',           'precio_compra' => 1.00, 'precio_venta' => 2.00,  'stock' => 60, 'stock_minimo' => 10,'id_categoria' => $bebidas->id,   'id_proveedor' => $mercado->id],
            ['nombre' => 'Jugo de naranja',      'detalle' => 'Jugo natural de la isla. Refrescante y saludable.',             'precio_compra' => 0.75, 'precio_venta' => 1.50,  'stock' => 45, 'stock_minimo' => 10,'id_categoria' => $bebidas->id,   'id_proveedor' => $foodmart->id],
            // Ropa
            ['nombre' => 'Vestido de lunares',   'detalle' => 'Vestido elegante con lunares. Muy popular entre los Miis.',      'precio_compra' => 5.00, 'precio_venta' => 12.00, 'stock' => 8,  'stock_minimo' => 2, 'id_categoria' => $ropa->id,      'id_proveedor' => $tiendaropa->id],
            ['nombre' => 'Traje formal',         'detalle' => 'Traje para ocasiones especiales. Hace ver muy elegante al Mii.', 'precio_compra' => 8.00, 'precio_venta' => 18.00, 'stock' => 5,  'stock_minimo' => 2, 'id_categoria' => $ropa->id,      'id_proveedor' => $tiendaropa->id],
            ['nombre' => 'Pijama de estrellas',  'detalle' => 'Pijama cómodo con estampado de estrellas.',                     'precio_compra' => 4.00, 'precio_venta' => 9.00,  'stock' => 10, 'stock_minimo' => 2, 'id_categoria' => $ropa->id,      'id_proveedor' => $tiendaropa->id],
            // Sombreros
            ['nombre' => 'Sombrero de paja',     'detalle' => 'Clásico sombrero de verano. Perfecto para la playa de la isla.', 'precio_compra' => 2.00, 'precio_venta' => 5.00,  'stock' => 15, 'stock_minimo' => 3, 'id_categoria' => $sombreros->id, 'id_proveedor' => $tiendaropa->id],
            ['nombre' => 'Corona de flores',     'detalle' => 'Corona hecha con flores de la isla. Muy especial.',             'precio_compra' => 3.00, 'precio_venta' => 7.00,  'stock' => 8,  'stock_minimo' => 2, 'id_categoria' => $sombreros->id, 'id_proveedor' => $tiendaropa->id],
            // Interiores
            ['nombre' => 'Sofá de terciopelo',   'detalle' => 'Sofá lujoso para la habitación del Mii.',                       'precio_compra' => 10.00,'precio_venta' => 22.00, 'stock' => 4,  'stock_minimo' => 1, 'id_categoria' => $interiores->id,'id_proveedor' => $mercado->id],
            ['nombre' => 'Cama con dosel',       'detalle' => 'Cama elegante con dosel. Los Miis duermen felices en ella.',    'precio_compra' => 12.00,'precio_venta' => 25.00, 'stock' => 3,  'stock_minimo' => 1, 'id_categoria' => $interiores->id,'id_proveedor' => $mercado->id],
            // Regalos
            ['nombre' => 'Pelota de fútbol',     'detalle' => 'Regalo especial para Miis activos.',                            'precio_compra' => 3.00, 'precio_venta' => 7.00,  'stock' => 10, 'stock_minimo' => 2, 'id_categoria' => $regalos->id,   'id_proveedor' => $mercado->id],
            ['nombre' => 'Kit de belleza',       'detalle' => 'Kit completo de belleza. Sube la felicidad del Mii.',           'precio_compra' => 5.00, 'precio_venta' => 11.00, 'stock' => 7,  'stock_minimo' => 2, 'id_categoria' => $regalos->id,   'id_proveedor' => $tiendaropa->id],
            ['nombre' => 'Boleto de viaje',      'detalle' => 'El regalo más raro de la isla. Muy difícil de conseguir.',      'precio_compra' => 20.00,'precio_venta' => 45.00, 'stock' => 2,  'stock_minimo' => 1, 'id_categoria' => $regalos->id,   'id_proveedor' => $mercado->id],
        ];

        foreach ($productos as $prod) {
            Producto::create(array_merge($prod, ['imagen' => 'default.jpg', 'estado' => 1]));
        }
    }
}