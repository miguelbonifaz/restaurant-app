<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(['email' => 'miguel@gmail.com']);

//        Paella - Un plato español tradicional de arroz, que se cocina en una paellera. Es un plato versátil, ya que se puede preparar con una variedad de ingredientes, pero normalmente se sirve con mariscos, pollo, verduras y especias. La paella es un plato muy aromático, con sabores intensos y ricos, que se debe disfrutar con una copa de vino blanco o rosado.
//
//    Tacos - Los tacos son un platillo mexicano que consiste en una tortilla de maíz rellena de carne, frijoles, queso, lechuga y salsa. Hay muchas variaciones de tacos, pero los más comunes son de carne asada, pollo, pescado o cerdo. Los tacos son un plato muy popular en México y en todo el mundo, debido a su sabor delicioso y a la facilidad de preparación.
//
//    Pad Thai - El Pad Thai es uno de los platos más famosos de la cocina tailandesa. Consiste en fideos de arroz salteados con camarones, tofu, cacahuetes y una salsa agridulce. Es un plato muy sabroso, con una mezcla de sabores dulces, picantes y ácidos. El Pad Thai se sirve con una variedad de guarniciones, como brotes de soja, cilantro y limón, que complementan perfectamente los sabores del plato.
//
//    Sushi - El sushi es un plato japonés que se compone de arroz cocido en vinagre y relleno de pescado crudo, aguacate y otros ingredientes. Hay muchas variedades de sushi, desde el tradicional nigiri hasta el moderno sushi enrollado (maki). El sushi es un plato muy popular en todo el mundo, debido a su sabor único y a la presentación artística de los rollos.
//
//    Moussaka - La moussaka es un platillo griego de capas de berenjena, carne picada, tomates y bechamel, gratinado en el horno. Es un plato muy sabroso y reconfortante, que se sirve caliente. La moussaka se acompaña con una ensalada griega y pan de pita, y es una excelente opción para una cena de invierno.
//
//    Chiles en Nogada - Los chiles en nogada son un platillo mexicano tradicional que se prepara durante la temporada de la Independencia de México. Consiste en chiles poblanos rellenos de picadillo de carne, bañados en una salsa de nueces y granada. Es un plato muy colorido y festivo, que representa los colores de la bandera mexicana. Los chiles en nogada se acompañan con arroz y frijoles, y son una excelente opción para celebrar las fiestas patrias.
//
//    Escargots - Los escargots son un plato francés de caracoles cocidos en mantequilla y ajo, servidos en sus conchas con pan tostado. Es un plato muy elegante y sofisticado, que se sirve como aperitivo en los restaurantes franceses más exclusivos. Los escargots son un plato muy sabroso
        Menu::factory()->createMany([
            [
                'name' => 'Paella', 'description' => 'Un plato español tradicional de arroz, que se cocina en una paellera. Es un plato versátil, ya que se puede preparar con una variedad de ingredientes, pero normalmente se sirve con mariscos, pollo, verduras y especias. La paella es un plato muy aromático, con sabores intensos y ricos, que se debe disfrutar con una copa de vino blanco o rosado', 'quantity' => rand(1, 3)
            ],
            [
                'name' => 'Tacos', 'description' => 'Los tacos son un platillo mexicano que consiste en una tortilla de maíz rellena de carne, frijoles, queso, lechuga y salsa. Hay muchas variaciones de tacos, pero los más comunes son de carne asada, pollo, pescado o cerdo. Los tacos son un plato muy popular en México y en todo el mundo, debido a su sabor delicioso y a la facilidad de preparación', 'quantity' => rand(1, 3)
            ],
            [
                'name' => 'Pad Thai', 'description' => 'El Pad Thai es uno de los platos más famosos de la cocina tailandesa. Consiste en fideos de arroz salteados con camarones, tofu, cacahuetes y una salsa agridulce. Es un plato muy sabroso, con una mezcla de sabores dulces, picantes y ácidos. El Pad Thai se sirve con una variedad de guarniciones, como brotes de soja, cilantro y limón, que complementan perfectamente los sabores del plato', 'quantity' => rand(1, 3)
            ],
            [
                'name' => 'Sushi', 'description' => 'El sushi es un plato japonés que se compone de arroz cocido en vinagre y relleno de pescado crudo, aguacate y otros ingredientes. Hay muchas variedades de sushi, desde el tradicional nigiri hasta el moderno sushi enrollado (maki). El sushi es un plato muy popular en todo el mundo, debido a su sabor único y a la presentación artística de los rollos', 'quantity' => rand(1, 3)
            ],
            [
                'name' => 'Moussaka', 'description' => 'La moussaka es un platillo griego de capas de berenjena, carne picada, tomates y bechamel, gratinado en el horno. Es un plato muy sabroso y reconfortante, que se sirve caliente. La moussaka se acompaña con una ensalada griega y pan de pita, y es una excelente opción para una cena de invierno', 'quantity' => rand(1, 3)
            ],
            [
                'name' => 'Chiles en Nogada', 'description' => 'Los chiles en nogada son un platillo mexicano tradicional que se prepara durante la temporada de la Independencia de México. Consiste en chiles poblanos rellenos de picadillo de carne, bañados en una salsa de nueces y granada. Es un plato muy colorido y festivo, que representa los colores de la bandera mexicana. Los chiles en nogada se acompañan con arroz y frijoles, y son una excelente opción para celebrar las fiestas patrias', 'quantity' => rand(1, 3)
            ],
            [
                'name' => 'Escargots', 'description' => 'Los escargots son un plato francés de caracoles cocidos en mantequilla y ajo, servidos en sus conchas con pan tostado. Es un plato muy elegante y sofisticado, que se sirve como aperitivo en los restaurantes franceses más exclusivos. Los escargots son un plato muy sabroso', 'quantity' => rand(1, 3)
            ],
        ]);
    }
}
