<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Line;

class LineSeeder extends Seeder
{
    public function run()
    {

        $lines = [];

        $lines[] = Line::create([
            'name' => 'Bienestar humano',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt, justo sed ultrices iaculis, ex libero tempus magna, sit amet pharetra mi odio pharetra ipsum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut lacinia quis nisl pulvinar suscipit. Ut imperdiet a est ut semper. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi pulvinar ut metus at lacinia. Etiam eu hendrerit elit. Integer et metus vel velit tincidunt scelerisque. Sed eget eleifend velit, id pharetra mi. Fusce tempus sollicitudin sodales. Duis sollicitudin ac risus imperdiet laoreet.

            Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse potenti. Etiam facilisis massa erat, quis luctus turpis sollicitudin quis. Aenean diam velit, luctus sed augue sed, tincidunt blandit arcu. Nulla eu accumsan lectus, quis posuere libero. Curabitur efficitur pretium tortor, a facilisis lectus finibus vel. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vulputate justo ut augue eleifend porttitor. Proin vel ipsum et magna scelerisque imperdiet. Nullam lobortis eleifend augue rhoncus ultricies. Nulla malesuada leo id nibh commodo, viverra dignissim dolor dictum.
            
            Morbi imperdiet justo ac diam aliquet rutrum. Nam sit amet maximus tortor. Praesent varius diam mauris, id euismod quam dictum in. Suspendisse nunc dolor, elementum ut pellentesque vel, eleifend vel quam. Vivamus imperdiet lectus eget ornare euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum consequat lacus non lacinia cursus. Suspendisse facilisis fringilla dolor, sit amet viverra nisi porttitor quis. In sodales pellentesque aliquet.',
            'slug' => 'bienestar-humano',
            'status' => 2,
        ]);

        $lines[] = Line::create([
            'name' => 'Estudios económicos',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt, justo sed ultrices iaculis, ex libero tempus magna, sit amet pharetra mi odio pharetra ipsum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut lacinia quis nisl pulvinar suscipit. Ut imperdiet a est ut semper. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi pulvinar ut metus at lacinia. Etiam eu hendrerit elit. Integer et metus vel velit tincidunt scelerisque. Sed eget eleifend velit, id pharetra mi. Fusce tempus sollicitudin sodales. Duis sollicitudin ac risus imperdiet laoreet.

            Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse potenti. Etiam facilisis massa erat, quis luctus turpis sollicitudin quis. Aenean diam velit, luctus sed augue sed, tincidunt blandit arcu. Nulla eu accumsan lectus, quis posuere libero. Curabitur efficitur pretium tortor, a facilisis lectus finibus vel. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vulputate justo ut augue eleifend porttitor. Proin vel ipsum et magna scelerisque imperdiet. Nullam lobortis eleifend augue rhoncus ultricies. Nulla malesuada leo id nibh commodo, viverra dignissim dolor dictum.
            
            Morbi imperdiet justo ac diam aliquet rutrum. Nam sit amet maximus tortor. Praesent varius diam mauris, id euismod quam dictum in. Suspendisse nunc dolor, elementum ut pellentesque vel, eleifend vel quam. Vivamus imperdiet lectus eget ornare euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum consequat lacus non lacinia cursus. Suspendisse facilisis fringilla dolor, sit amet viverra nisi porttitor quis. In sodales pellentesque aliquet.',
            'slug' => 'estudios-economicos',
            'status' => 2,
        ]);
        $lines[] = Line::create([
            'name' => 'Derechos de los pueblos y comunidades indígenas',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt, justo sed ultrices iaculis, ex libero tempus magna, sit amet pharetra mi odio pharetra ipsum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut lacinia quis nisl pulvinar suscipit. Ut imperdiet a est ut semper. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi pulvinar ut metus at lacinia. Etiam eu hendrerit elit. Integer et metus vel velit tincidunt scelerisque. Sed eget eleifend velit, id pharetra mi. Fusce tempus sollicitudin sodales. Duis sollicitudin ac risus imperdiet laoreet.

            Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse potenti. Etiam facilisis massa erat, quis luctus turpis sollicitudin quis. Aenean diam velit, luctus sed augue sed, tincidunt blandit arcu. Nulla eu accumsan lectus, quis posuere libero. Curabitur efficitur pretium tortor, a facilisis lectus finibus vel. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vulputate justo ut augue eleifend porttitor. Proin vel ipsum et magna scelerisque imperdiet. Nullam lobortis eleifend augue rhoncus ultricies. Nulla malesuada leo id nibh commodo, viverra dignissim dolor dictum.
            
            Morbi imperdiet justo ac diam aliquet rutrum. Nam sit amet maximus tortor. Praesent varius diam mauris, id euismod quam dictum in. Suspendisse nunc dolor, elementum ut pellentesque vel, eleifend vel quam. Vivamus imperdiet lectus eget ornare euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum consequat lacus non lacinia cursus. Suspendisse facilisis fringilla dolor, sit amet viverra nisi porttitor quis. In sodales pellentesque aliquet.',
            'slug' => 'derechos-de-los-pueblos-y-comunidades-indigenas',
            'status' => 2,
        ]);
        $lines[] = Line::create([
            'name' => 'Minería regional',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt, justo sed ultrices iaculis, ex libero tempus magna, sit amet pharetra mi odio pharetra ipsum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut lacinia quis nisl pulvinar suscipit. Ut imperdiet a est ut semper. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi pulvinar ut metus at lacinia. Etiam eu hendrerit elit. Integer et metus vel velit tincidunt scelerisque. Sed eget eleifend velit, id pharetra mi. Fusce tempus sollicitudin sodales. Duis sollicitudin ac risus imperdiet laoreet.

            Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse potenti. Etiam facilisis massa erat, quis luctus turpis sollicitudin quis. Aenean diam velit, luctus sed augue sed, tincidunt blandit arcu. Nulla eu accumsan lectus, quis posuere libero. Curabitur efficitur pretium tortor, a facilisis lectus finibus vel. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vulputate justo ut augue eleifend porttitor. Proin vel ipsum et magna scelerisque imperdiet. Nullam lobortis eleifend augue rhoncus ultricies. Nulla malesuada leo id nibh commodo, viverra dignissim dolor dictum.
            
            Morbi imperdiet justo ac diam aliquet rutrum. Nam sit amet maximus tortor. Praesent varius diam mauris, id euismod quam dictum in. Suspendisse nunc dolor, elementum ut pellentesque vel, eleifend vel quam. Vivamus imperdiet lectus eget ornare euismod. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum consequat lacus non lacinia cursus. Suspendisse facilisis fringilla dolor, sit amet viverra nisi porttitor quis. In sodales pellentesque aliquet.',
            'slug' => 'mineria-regional',
            'status' => 2,
        ]);

        foreach ($lines as $lines)
        {
          Image::factory(1)->create([
            'imageable_id' => $lines->id,
            'imageable_type' => Line::class
          ]);
        }

    }
}
