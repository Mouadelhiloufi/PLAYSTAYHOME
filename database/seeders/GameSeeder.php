<?php

namespace Database\Seeders;

use App\Models\Console;
use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            ['title' => 'The Last of Us Part II', 'genre' => 'Action-Adventure', 'image' => 'https://image.api.playstation.com/vulcan/ap/rnd/202010/0114/ERNPc4gFqeRDG1tYQIfOKQtM.png'],
            ['title' => 'God of War Ragnarök', 'genre' => 'Action-Adventure', 'image' => 'https://image.api.playstation.com/vulcan/ap/rnd/202207/1210/4xJ8XB3bi888QTLZYdl7Oi0s.png'],
            ['title' => 'Spider-Man: Miles Morales', 'genre' => 'Action', 'image' => 'https://image.api.playstation.com/vulcan/ap/rnd/202008/1020/T45iRN1bhiWcJUzST6UFGBvO.png'],
            ['title' => 'Halo Infinite', 'genre' => 'FPS', 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1240440/header.jpg'],
            ['title' => 'Forza Horizon 5', 'genre' => 'Racing', 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1551360/header.jpg'],
            ['title' => 'Gears 5', 'genre' => 'Action', 'image' => 'https://cdn.cloudflare.steamstatic.com/steam/apps/1097840/header.jpg'],
            ['title' => 'Mario Kart 8 Deluxe', 'genre' => 'Racing', 'image' => 'https://assets.nintendo.com/image/upload/ar_16:9,c_lpad,w_1240/b_white/f_auto/q_auto/ncom/software/switch/70010000000153/de697f487a36d802dd9a5ff0341f717c8486221f7b2d1f09d99f0c59a6b91e87'],
            ['title' => 'Zelda: Breath of the Wild', 'genre' => 'Adventure', 'image' => 'https://assets.nintendo.com/image/upload/ar_16:9,c_lpad,w_1240/b_white/f_auto/q_auto/ncom/software/switch/70010000000025/7137262b5a64d921e193653f8aa0b722925abc5680380ca0e18a5cfd91697f58'],
            ['title' => 'Super Mario Odyssey', 'genre' => 'Platformer', 'image' => 'https://assets.nintendo.com/image/upload/ar_16:9,c_lpad,w_1240/b_white/f_auto/q_auto/ncom/software/switch/70010000001130/c42553b4fd0312c31e70bc7468c6c9d6475c7f0c'],
            ['title' => 'FIFA 24', 'genre' => 'Sport', 'image' => 'https://image.api.playstation.com/vulcan/ap/rnd/202307/1407/1c7b75d8ed9271516546560d219ad0b22ee0a263b4537bd8.png'],
        ];

        foreach ($games as $gameData) {
            Game::firstOrCreate(
                ['title' => $gameData['title']],
                $gameData
            );
        }

        $gameIds = Game::whereIn('title', [
            'The Last of Us Part II',
            'God of War Ragnarök',
            'Spider-Man: Miles Morales',
            'Halo Infinite',
            'Forza Horizon 5',
            'Gears 5',
            'Mario Kart 8 Deluxe',
            'Zelda: Breath of the Wild',
            'Super Mario Odyssey',
            'FIFA 24',
        ])->pluck('id', 'title');

        // Associer des jeux aux consoles sans dupliquer le pivot
        $ps5 = Console::where('name', 'PlayStation 5')->first();
        $xbox = Console::where('name', 'Xbox Series X')->first();
        $switch = Console::where('name', 'Nintendo Switch')->first();

        if ($ps5) {
            $ps5->games()->sync([
                $gameIds['The Last of Us Part II'],
                $gameIds['God of War Ragnarök'],
                $gameIds['Spider-Man: Miles Morales'],
                $gameIds['FIFA 24'],
            ]);
        }

        if ($xbox) {
            $xbox->games()->sync([
                $gameIds['Halo Infinite'],
                $gameIds['Forza Horizon 5'],
                $gameIds['Gears 5'],
                $gameIds['FIFA 24'],
            ]);
        }

        if ($switch) {
            $switch->games()->sync([
                $gameIds['Mario Kart 8 Deluxe'],
                $gameIds['Zelda: Breath of the Wild'],
                $gameIds['Super Mario Odyssey'],
            ]);
        }
    }
}
