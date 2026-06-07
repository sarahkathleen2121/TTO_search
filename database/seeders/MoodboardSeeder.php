<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Moodboard;

class MoodboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing moodboards to avoid duplication on re-seed
        Moodboard::truncate();

        // Check if storage directory exists
        $targetDir = storage_path('app/public/moodboards');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // Default 10 slides
        $slides = [
            [
                'title' => 'Native Light Chair',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'furniture.png'
            ],
            [
                'title' => 'Moss Upholstery Fabric',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'writable.png'
            ],
            [
                'title' => 'Moss Upholstery Fabric',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'fabrics.png'
            ],
            [
                'title' => 'Moss Upholstery Fabric',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'acoustic.png'
            ],
            [
                'title' => 'Moss Upholstery Fabric',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'greenwalls.png'
            ],
            [
                'title' => 'Sophistication Retro',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'banner_img.png'
            ],
            [
                'title' => 'The Orange Blossom',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'bespoke_sec.png'
            ],
            [
                'title' => 'The Beauty of Olea',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'bespoke_solutions.png'
            ],
            [
                'title' => 'Road to October',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'ideal_work.png'
            ],
            [
                'title' => 'Purple, The Space Thief',
                'description' => 'Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.',
                'image_filename' => 'impression.png'
            ]
        ];

        foreach ($slides as $slide) {
            $srcPath = public_path('frontend_assets/images/' . $slide['image_filename']);
            $destFilename = 'moodboards/' . $slide['image_filename'];
            $destPath = storage_path('app/public/' . $destFilename);

            if (File::exists($srcPath)) {
                File::copy($srcPath, $destPath);
            }

            Moodboard::create([
                'title' => $slide['title'],
                'description' => $slide['description'],
                'image' => $destFilename,
                'status' => 1
            ]);
        }
    }
}
