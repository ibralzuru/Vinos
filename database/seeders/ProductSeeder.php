<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_data = [

            'name' => 'Paco & Lola',
            'description' => 'Vino blanco elaborado únicamente con uva de la variedad Albariño por la Bodega Paco & Lola bajo la D.O. Rías Baixas. Este vino elegante explota todos los matices de la varietal con una concepción muy moderna.',
            'images' => 'https://static.carrefour.es/hd_3200x_/img_pim_food/140865_00_1_Bodega.jpg',
            'capacidad' => 750,
            'precio' => 20

        ];

      

        $product_data2 = [

            'name' => 'Celeste',
            'description' => 'El proyecto de investigación más apasionante en el que estamos inmersos es la recuperación de variedades ancestrales. Lo inició Miguel A.',
            'images' => 'https://www.vinoseleccion.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/c/e/celeste-crianza-2016_1_1_1_1.jpg',
            'capacidad' => 750,
            'precio' => 20

        ];
        $product_data3 = [

            'name' => 'Emilio Moro',
            'description' => 'Vino crianza ribera de Duero elaborado con uva Tinta del País, seleccionada cuidadosamente de viñas situadas en diferentes terrenos para aportar mayor número de matices.',
            'images' => 'https://static.carrefour.es/hd_3200x_/img_pim_food/051380_00_1_Bodega.jpg',
            'capacidad' => 750,
            'precio' => 18

        ];

      

        $product_data4 = [

            'name' => 'Hito',
            'description' => 'Hito es un vino tinto monovarietal bien equilibrado, que establece el punto de partida de toda la gama de vinos de Bodegas Cepa 21, siendo el más amable de todos. Desde su fundación en 2007.',
            'images' => 'https://static.carrefour.es/hd_1600x_/img_pim_food/077047_00_2_Bodega.jpg',
            'capacidad' => 750,
            'precio' => 10

        ];
        $product_data5 = [

            'name' => 'Luis Cañas',
            'description' => 'Un vino que destaca por su excepcional relación entre calidad y precio, de una familia con 4 generaciones de experiencia en la creación de grandes vinos.',
            'images' => 'https://static.carrefour.es/hd_1600x_/img_pim_food/172961_00_2_Bodega.jpg',
            'capacidad' => 750,
            'precio' => 11

        ];

      

        $product_data6 = [

            'name' => 'Viña Ardanza',
            'description' => 'Un vino que destaca por su excepcional relación entre calidad y precio, de una familia con 4 generaciones de experiencia en la creación de grandes vinos.',
            'images' => 'https://static.carrefour.es/hd_3200x_/img_pim_food/290968_00_1_Bodega.jpg',
            'capacidad' => 750,
            'precio' => 23

        ];
        $product_data7 = [

            'name' => 'Negre De Negres',
            'description' => 'Vino de cultivo orgánico y carácter mineral propio de los suelos de Clos del Portal. Es un vino de crianza fresco y ligero que conquista por su gusto aterciopelado.',
            'images' => 'https://static.carrefour.es/hd_3200x_/img_pim_food/835873_00_1_Bodega.jpg',
            'capacidad' => 750,
            'precio' => 21

        ];

      

        $product_data8 = [

            'name' => 'Porrera',
            'description' => 'Complejo, equilibrado en nariz con aromas a hierbas de monte.Equilibrado en boca con buena acidez, taninos maduros y toques balsámicos.',
            'images' => 'https://static.carrefour.es/hd_3200x_/img_pim_food/603463_00_1_Bodega.jpg',
            'capacidad' => 750,
            'precio' => 16

        ];
        $product_data9 = [

            'name' => 'Lopez De Haro',
            'description' => 'Complejo, equilibrado en nariz con aromas a hierbas de monte.Equilibrado en boca con buena acidez, taninos maduros y toques balsámicos.',
            'images' => 'https://static.carrefour.es/hd_3200x_/img_pim_food/014838_00_1_Bodega.jpg',
            'capacidad' => 750,
            'precio' => 9

        ];
        $product_data10 = [

            'name' => 'Leda',
            'description' => 'Un vino tinto multiterroir elaborado a partir de uvas de Tempranillo de viñedos de entre 70 y 100 años, tendidos a lo largo del valle del Duero, con diferentes microclimas y fechas de maduración. Posee un envejecimiento de 18 meses en barricas nuevas.',
            'images' => 'https://static.carrefour.es/hd_3200x_/img_pim_food/395116_00_1_Bodega.jpg',
            'capacidad' => 750,
            'precio' => 29

        ];

        $product = new Product($product_data);
        $product->save();
        $product2 = new Product($product_data2 );
        $product2->save();
        $product3 = new Product($product_data3 );
        $product3->save();
        $product4 = new Product($product_data4 );
        $product4->save();
        $product5 = new Product($product_data5 );
        $product5->save();
        $product6 = new Product($product_data6 );
        $product6->save();
        $product7 = new Product($product_data7 );
        $product7->save();
        $product8 = new Product($product_data8 );
        $product8->save();
        $product9 = new Product($product_data9 ); 
        $product9->save();
        $product10 = new Product($product_data10 ); 
        $product10->save();

    }
}
