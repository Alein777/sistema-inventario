<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Proveedor;
use App\Models\Producto;

class TechStoreSeeder extends Seeder
{
    public function run(): void
    {
        // 14 Departamentos de El Salvador con sus municipios
        $deptos = [
            'Ahuachapán'    => ['Ahuachapán','Atiquizaya','El Refugio','San Lorenzo','Tacuba'],
            'Santa Ana'     => ['Santa Ana','Chalchuapa','Coatepeque','Metapán','Texistepeque'],
            'Sonsonate'     => ['Sonsonate','Acajutla','Izalco','Nahuizalco','San Antonio del Monte'],
            'Chalatenango'  => ['Chalatenango','La Palma','Nueva Concepción','San Francisco Morazán'],
            'La Libertad'   => ['Santa Tecla','Antiguo Cuscatlán','Ciudad Arce','Quezaltepeque','San Juan Opico'],
            'San Salvador'  => ['San Salvador','Apopa','Ilopango','Mejicanos','Soyapango','San Marcos'],
            'Cuscatlán'     => ['Cojutepeque','San Pedro Perulapán','Suchitoto'],
            'La Paz'        => ['Zacatecoluca','San Luis Talpa','San Pedro Masahuat','Olocuilta'],
            'Cabañas'       => ['Sensuntepeque','Ilobasco','San Isidro'],
            'San Vicente'   => ['San Vicente','Apastepeque','Guadalupe'],
            'Usulután'      => ['Usulután','Jiquilisco','Santiago de María','Santa Elena'],
            'San Miguel'    => ['San Miguel','Chinameca','Ciudad Barrios','Moncagua'],
            'Morazán'       => ['San Francisco Gotera','Corinto','Jocoaitique'],
            'La Unión'      => ['La Unión','Conchagua','El Carmen','Santa Rosa de Lima'],
        ];

        $deptoModels = [];
        foreach ($deptos as $nombre => $municipios) {
            $depto = Departamento::create(['nombre' => $nombre]);
            $deptoModels[$nombre] = $depto;
            foreach ($municipios as $mun) {
                Municipio::create([
                    'nombre'          => $mun,
                    'id_departamento' => $depto->id,
                ]);
            }
        }

        // Categorías de tienda de tecnología
        $cats = [
            'Computadoras y laptops',
            'Componentes y hardware',
            'Almacenamiento',
            'Periféricos',
            'Audio y video',
            'Redes y conectividad',
            'Telefonía',
            'Accesorios',
        ];

        $catModels = [];
        foreach ($cats as $cat) {
            $catModels[$cat] = Categoria::create(['nombre' => $cat, 'estado' => 1]);
        }

        // Proveedores salvadoreños de tecnología
        $sanSalvador = Municipio::where('nombre', 'San Salvador')->first();
        $santaTecla  = Municipio::where('nombre', 'Santa Tecla')->first();
        $soyapango   = Municipio::where('nombre', 'Soyapango')->first();
        $santaAna    = Municipio::where('nombre', 'Santa Ana')->first();

        $proveedores = [
            [
                'nombre'       => 'TechSolution SV',
                'contacto'     => 'Carlos Hernández',
                'telefono'     => '2222-1111',
                'email'        => 'ventas@techsolutionsv.com',
                'tipo'         => 'Nacional',
                'id_municipio' => $sanSalvador->id,
            ],
            [
                'nombre'       => 'Importadora DigitalPro',
                'contacto'     => 'María González',
                'telefono'     => '2233-4455',
                'email'        => 'info@digitalpro.com.sv',
                'tipo'         => 'Internacional',
                'id_municipio' => $santaTecla->id,
            ],
            [
                'nombre'       => 'Distribuidora CompuMax',
                'contacto'     => 'José Martínez',
                'telefono'     => '2244-5566',
                'email'        => 'compumax@gmail.com',
                'tipo'         => 'Nacional',
                'id_municipio' => $soyapango->id,
            ],
            [
                'nombre'       => 'ElectroShop Santa Ana',
                'contacto'     => 'Ana Flores',
                'telefono'     => '2278-9900',
                'email'        => 'electroshop@hotmail.com',
                'tipo'         => 'Nacional',
                'id_municipio' => $santaAna->id,
            ],
        ];

        $provModels = [];
        foreach ($proveedores as $prov) {
            $provModels[$prov['nombre']] = Proveedor::create(array_merge($prov, ['estado' => 1]));
        }

        $techsv   = $provModels['TechSolution SV'];
        $digital  = $provModels['Importadora DigitalPro'];
        $compumax = $provModels['Distribuidora CompuMax'];
        $electro  = $provModels['ElectroShop Santa Ana'];

        $computadoras  = $catModels['Computadoras y laptops'];
        $componentes   = $catModels['Componentes y hardware'];
        $almacenamiento = $catModels['Almacenamiento'];
        $perifericos   = $catModels['Periféricos'];
        $audio         = $catModels['Audio y video'];
        $redes         = $catModels['Redes y conectividad'];
        $telefonia     = $catModels['Telefonía'];
        $accesorios    = $catModels['Accesorios'];

        $productos = [
            // Computadoras
            ['nombre'=>'Laptop HP 15s',          'detalle'=>'Intel Core i5, 8GB RAM, 512GB SSD, pantalla 15.6"',         'precio_compra'=>550.00, 'precio_venta'=>749.99,  'stock'=>12, 'stock_minimo'=>3, 'id_categoria'=>$computadoras->id,  'id_proveedor'=>$digital->id],
            ['nombre'=>'Laptop Dell Inspiron 15', 'detalle'=>'Intel Core i7, 16GB RAM, 1TB SSD, pantalla 15.6" FHD',     'precio_compra'=>700.00, 'precio_venta'=>999.99,  'stock'=>8,  'stock_minimo'=>2, 'id_categoria'=>$computadoras->id,  'id_proveedor'=>$digital->id],
            ['nombre'=>'Laptop Lenovo IdeaPad',   'detalle'=>'AMD Ryzen 5, 8GB RAM, 256GB SSD, ideal para estudiantes',  'precio_compra'=>400.00, 'precio_venta'=>549.99,  'stock'=>15, 'stock_minimo'=>3, 'id_categoria'=>$computadoras->id,  'id_proveedor'=>$techsv->id],
            ['nombre'=>'PC de escritorio Asus',   'detalle'=>'Intel Core i5, 16GB RAM, 1TB HDD, torre completa',         'precio_compra'=>480.00, 'precio_venta'=>649.99,  'stock'=>6,  'stock_minimo'=>2, 'id_categoria'=>$computadoras->id,  'id_proveedor'=>$compumax->id],
            // Componentes
            ['nombre'=>'Memoria RAM DDR4 16GB',   'detalle'=>'Kingston 3200MHz, compatible con la mayoría de laptops',   'precio_compra'=>35.00,  'precio_venta'=>55.00,   'stock'=>30, 'stock_minimo'=>5, 'id_categoria'=>$componentes->id,   'id_proveedor'=>$compumax->id],
            ['nombre'=>'Procesador Intel i5-12',  'detalle'=>'12va generación, 6 núcleos, socket LGA1700',               'precio_compra'=>180.00, 'precio_venta'=>249.99,  'stock'=>10, 'stock_minimo'=>2, 'id_categoria'=>$componentes->id,   'id_proveedor'=>$digital->id],
            ['nombre'=>'Tarjeta madre Gigabyte',  'detalle'=>'Socket LGA1700, DDR4, HDMI, USB 3.0',                      'precio_compra'=>90.00,  'precio_venta'=>129.99,  'stock'=>8,  'stock_minimo'=>2, 'id_categoria'=>$componentes->id,   'id_proveedor'=>$compumax->id],
            // Almacenamiento
            ['nombre'=>'SSD Samsung 1TB',         'detalle'=>'NVMe M.2, velocidad lectura 3500MB/s, 5 años garantía',    'precio_compra'=>65.00,  'precio_venta'=>99.99,   'stock'=>25, 'stock_minimo'=>5, 'id_categoria'=>$almacenamiento->id,'id_proveedor'=>$digital->id],
            ['nombre'=>'Disco duro externo 2TB',  'detalle'=>'Seagate USB 3.0, portátil, compatible Win/Mac',            'precio_compra'=>55.00,  'precio_venta'=>79.99,   'stock'=>20, 'stock_minimo'=>4, 'id_categoria'=>$almacenamiento->id,'id_proveedor'=>$techsv->id],
            ['nombre'=>'USB Flash Drive 64GB',    'detalle'=>'SanDisk Ultra, USB 3.0, hasta 130MB/s lectura',            'precio_compra'=>8.00,   'precio_venta'=>14.99,   'stock'=>50, 'stock_minimo'=>10,'id_categoria'=>$almacenamiento->id,'id_proveedor'=>$electro->id],
            // Periféricos
            ['nombre'=>'Monitor Samsung 24"',     'detalle'=>'Full HD IPS, 75Hz, HDMI+VGA, eye care',                   'precio_compra'=>120.00, 'precio_venta'=>179.99,  'stock'=>10, 'stock_minimo'=>2, 'id_categoria'=>$perifericos->id,   'id_proveedor'=>$digital->id],
            ['nombre'=>'Teclado mecánico Redragon','detalle'=>'Switch Blue, retroiluminado RGB, español latino',         'precio_compra'=>25.00,  'precio_venta'=>44.99,   'stock'=>18, 'stock_minimo'=>4, 'id_categoria'=>$perifericos->id,   'id_proveedor'=>$compumax->id],
            ['nombre'=>'Mouse inalámbrico Logitech','detalle'=>'M185, 2.4GHz, 1000dpi, batería 12 meses',               'precio_compra'=>12.00,  'precio_venta'=>22.99,   'stock'=>22, 'stock_minimo'=>5, 'id_categoria'=>$perifericos->id,   'id_proveedor'=>$techsv->id],
            ['nombre'=>'Webcam Logitech C920',    'detalle'=>'Full HD 1080p, micrófono estéreo, ideal para videollamadas','precio_compra'=>55.00, 'precio_venta'=>84.99,   'stock'=>9,  'stock_minimo'=>2, 'id_categoria'=>$perifericos->id,   'id_proveedor'=>$techsv->id],
            // Audio y video
            ['nombre'=>'Audífonos Sony WH-1000XM4','detalle'=>'Cancelación de ruido, 30h batería, Bluetooth 5.0',       'precio_compra'=>130.00, 'precio_venta'=>199.99,  'stock'=>7,  'stock_minimo'=>2, 'id_categoria'=>$audio->id,         'id_proveedor'=>$digital->id],
            ['nombre'=>'Bocina Bluetooth JBL Go 3','detalle'=>'Resistente al agua IP67, 5h batería, sonido potente',    'precio_compra'=>22.00,  'precio_venta'=>39.99,   'stock'=>14, 'stock_minimo'=>3, 'id_categoria'=>$audio->id,         'id_proveedor'=>$electro->id],
            // Redes
            ['nombre'=>'Router TP-Link Archer',   'detalle'=>'WiFi 6, doble banda, hasta 1800Mbps, 4 antenas',          'precio_compra'=>40.00,  'precio_venta'=>64.99,   'stock'=>12, 'stock_minimo'=>3, 'id_categoria'=>$redes->id,         'id_proveedor'=>$compumax->id],
            ['nombre'=>'Switch 8 puertos TP-Link','detalle'=>'10/100Mbps, plug and play, ideal para oficinas',          'precio_compra'=>18.00,  'precio_venta'=>29.99,   'stock'=>10, 'stock_minimo'=>2, 'id_categoria'=>$redes->id,         'id_proveedor'=>$compumax->id],
            // Telefonía
            ['nombre'=>'Samsung Galaxy A54',      'detalle'=>'6.4", 128GB, 8GB RAM, cámara 50MP, Android 13',           'precio_compra'=>220.00, 'precio_venta'=>319.99,  'stock'=>8,  'stock_minimo'=>2, 'id_categoria'=>$telefonia->id,     'id_proveedor'=>$digital->id],
            ['nombre'=>'iPhone 14 128GB',         'detalle'=>'6.1", iOS 16, cámara 12MP, 5G, chip A15 Bionic',          'precio_compra'=>550.00, 'precio_venta'=>749.99,  'stock'=>4,  'stock_minimo'=>1, 'id_categoria'=>$telefonia->id,     'id_proveedor'=>$digital->id],
            // Accesorios
            ['nombre'=>'Mochila para laptop 15"', 'detalle'=>'Resistente al agua, múltiples compartimentos, USB lateral','precio_compra'=>18.00, 'precio_venta'=>32.99,   'stock'=>20, 'stock_minimo'=>4, 'id_categoria'=>$accesorios->id,    'id_proveedor'=>$electro->id],
            ['nombre'=>'Cable HDMI 2.0 2m',       'detalle'=>'4K@60Hz, trenzado nylon, compatible con todos los monitores','precio_compra'=>4.00, 'precio_venta'=>9.99,    'stock'=>40, 'stock_minimo'=>8, 'id_categoria'=>$accesorios->id,    'id_proveedor'=>$electro->id],
            ['nombre'=>'Hub USB-C 7 en 1',        'detalle'=>'HDMI 4K, USB 3.0 x3, SD, TF, PD 100W, compatible Mac/Win','precio_compra'=>20.00,'precio_venta'=>35.99,    'stock'=>15, 'stock_minimo'=>3, 'id_categoria'=>$accesorios->id,    'id_proveedor'=>$techsv->id],
        ];

        foreach ($productos as $prod) {
            Producto::create(array_merge($prod, ['imagen' => 'default.jpg', 'estado' => 1]));
        }
    }
}