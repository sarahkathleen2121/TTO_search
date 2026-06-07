<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Space;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\Color;
use App\Models\Material;
use App\Models\Industry;

class ConferenceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Copy generated images to storage/app/public/products/
        $storageDir = storage_path('app/public/products');
        if (!File::exists($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
        }

        $sourceImages = [
            'table_marble' => 'C:\Users\Nabil_Ahmad\.gemini\antigravity-ide\brain\b5d42b6b-5911-4216-9156-7128be5d6925\table_marble_1780661635422.png',
            'table_wood' => 'C:\Users\Nabil_Ahmad\.gemini\antigravity-ide\brain\b5d42b6b-5911-4216-9156-7128be5d6925\table_wood_1780661664472.png',
            'table_dark' => 'C:\Users\Nabil_Ahmad\.gemini\antigravity-ide\brain\b5d42b6b-5911-4216-9156-7128be5d6925\table_dark_1780661696335.png'
        ];

        $copiedImages = [];
        foreach ($sourceImages as $key => $srcPath) {
            if (File::exists($srcPath)) {
                $filename = $key . '.png';
                $destPath = $storageDir . '/' . $filename;
                File::copy($srcPath, $destPath);
                $copiedImages[] = 'products/' . $filename;
            }
        }

        // Fallback to copying public frontend assets if gemini cache paths are missing
        if (empty($copiedImages)) {
            $fallbackImages = [
                'conference_room.png' => public_path('frontend_assets/images/conference_room.png'),
                'offie_cabins.png' => public_path('frontend_assets/images/offie_cabins.png'),
                'work_space.png' => public_path('frontend_assets/images/work_space.png'),
                'cafe_space.png' => public_path('frontend_assets/images/cafe_space.png')
            ];
            foreach ($fallbackImages as $filename => $srcPath) {
                if (File::exists($srcPath)) {
                    $destPath = $storageDir . '/' . $filename;
                    File::copy($srcPath, $destPath);
                    $copiedImages[] = 'products/' . $filename;
                }
            }
        }

        // 2. Ensure basic Category records exist
        $ptData = [
            ['name' => 'Furniture', 'slug' => 'furniture'],
            ['name' => 'Acoustic Products', 'slug' => 'acustic-products'],
            ['name' => 'Writable Surfaces', 'slug' => 'writable-surfaces'],
            ['name' => 'Fabrics', 'slug' => 'fabrics'],
            ['name' => 'Greenwalls', 'slug' => 'greenwalls'],
        ];
        $productTypes = [];
        foreach ($ptData as $data) {
            $productTypes[] = ProductType::firstOrCreate(['slug' => $data['slug']], ['name' => $data['name']]);
        }

        $spaceData = [
            ['name' => 'Conference Rooms', 'slug' => 'conference-rooms'],
            ['name' => 'Meeting Spaces', 'slug' => 'meeting-spaces'],
            ['name' => 'Private Offices', 'slug' => 'private-offices'],
            ['name' => 'Open Workspaces', 'slug' => 'open-workspaces'],
            ['name' => 'Cafeteria & Lounge', 'slug' => 'cafeteria-lounge'],
            ['name' => 'Reception Areas', 'slug' => 'reception-areas'],
        ];
        $spaces = [];
        foreach ($spaceData as $data) {
            $spaces[] = Space::firstOrCreate(['slug' => $data['slug']], ['name' => $data['name']]);
        }

        $indData = [
            ['name' => 'Corporate', 'slug' => 'corporate'],
            ['name' => 'Hospitality', 'slug' => 'hospitality'],
            ['name' => 'Education', 'slug' => 'education'],
            ['name' => 'Healthcare', 'slug' => 'healthcare'],
            ['name' => 'Retail', 'slug' => 'retail'],
        ];
        $industries = [];
        foreach ($indData as $data) {
            $industries[] = Industry::firstOrCreate(['slug' => $data['slug']], ['name' => $data['name']]);
        }

        // Clear all old brands to keep only the requested 4 brands
        Brand::query()->delete();

        $brandData = [
            ['name' => 'Andreu World', 'slug' => 'andreu-world'],
            ['name' => 'Boss', 'slug' => 'boss'],
            ['name' => 'Studio TK', 'slug' => 'studio-tk'],
            ['name' => 'Peadrali', 'slug' => 'peadrali'],
        ];
        $brands = [];
        foreach ($brandData as $data) {
            $brands[] = Brand::firstOrCreate(['slug' => $data['slug']], ['name' => $data['name']]);
        }

        $colorData = [
            ['name' => 'Black', 'hex_code' => '#000000'],
            ['name' => 'White', 'hex_code' => '#ffffff'],
            ['name' => 'Grey', 'hex_code' => '#808080'],
            ['name' => 'Oak', 'hex_code' => '#b8860b'],
            ['name' => 'Walnut', 'hex_code' => '#5c4033'],
        ];
        $colors = [];
        foreach ($colorData as $data) {
            $colors[] = Color::firstOrCreate(['name' => $data['name']], ['hex_code' => $data['hex_code']]);
        }

        $matData = [
            ['name' => 'Wood', 'slug' => 'wood'],
            ['name' => 'Metal', 'slug' => 'metal'],
            ['name' => 'Marble', 'slug' => 'marble'],
            ['name' => 'Fabric', 'slug' => 'fabric'],
            ['name' => 'Glass', 'slug' => 'glass'],
        ];
        $materials = [];
        foreach ($matData as $data) {
            $materials[] = Material::firstOrCreate(['slug' => $data['slug']], ['name' => $data['name']]);
        }

        // 3. Clear existing products to enable clean re-seeding
        Product::query()->delete();

        // 4. Seed 100 products dynamically to satisfy at least 5 products per category condition
        $adjectives = ["Aero", "Sleek", "Apex", "Classic", "Summit", "Modena", "Integra", "Linear", "Spectra", "Metro", "Vector", "Horizon", "Zenith", "Forum", "Unity", "Element", "Nova", "Eclipse", "Legacy", "Alpine", "Vanguard", "Omni", "Solaris", "Helix", "Evolve"];
        $nouns = ["Desk", "Chair", "Table", "Panel", "Greenwall", "Acoustic Pod", "Surface", "Partition", "Cabinet", "Workstation"];

        for ($i = 0; $i < 100; $i++) {
            $name = $adjectives[$i % count($adjectives)] . " " . $nouns[$i % count($nouns)] . " " . ($i + 1);
            $pt = $productTypes[$i % count($productTypes)];
            $br = $brands[$i % count($brands)];

            $product = Product::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . rand(1000, 9999),
                'description' => "A premium contemporary collaborative workspace solution designed with ergonomic comfort and clean aesthetics.",
                'price' => rand(1500, 8500),
                'thumbnail' => !empty($copiedImages) ? $copiedImages[$i % count($copiedImages)] : null,
                'is_featured' => ($i < 10),
                'brand_id' => $br->id,
                'product_type_id' => $pt->id
            ]);

            // Attach 2 spaces sequentially to double representation and guarantee each space gets at least 5 products
            $sp1 = $spaces[$i % count($spaces)];
            $sp2 = $spaces[($i + 1) % count($spaces)];
            $product->spaces()->attach([$sp1->id, $sp2->id]);

            // Attach 2 industries sequentially
            $ind1 = $industries[$i % count($industries)];
            $ind2 = $industries[($i + 1) % count($industries)];
            $product->industries()->attach([$ind1->id, $ind2->id]);

            // Attach colors and materials
            $product->colors()->attach([$colors[$i % count($colors)]->id]);
            $product->materials()->attach([$materials[$i % count($materials)]->id]);
        }

        // 5. Update any existing products outside the seeder where brand_id is null to a random valid brand id
        $seededBrandIds = collect($brands)->pluck('id')->toArray();
        if (!empty($seededBrandIds)) {
            Product::whereNull('brand_id')->each(function($product) use ($seededBrandIds) {
                $product->update(['brand_id' => $seededBrandIds[array_rand($seededBrandIds)]]);
            });
        }
    }
}
