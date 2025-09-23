<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DigitalProduct;
use App\Models\Image;
use App\Models\Offer;
use App\Models\PhysicalProduct;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Vendor;
use App\Models\Video;
use Faker\Factory as Faker;
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
        $this->command->info('Creating categories...');

        //physical main categories
        $foods = new Category();
        $foods->name = 'Foods';
        $foods->type = 'physical';
        $foods->save();

        $liquids = new Category();
        $liquids->name = 'Liquids';
        $liquids->type = 'physical';
        $liquids->save();

        $desserts = new Category();
        $desserts->name = 'Desserts';
        $desserts->type = 'physical';
        $desserts->save();

        //physical child categories
        $special = new Category();
        $special->name = "Master's Specials";
        $special->parent_id = $foods->id;
        $special->save();

        $vegetables = new Category();
        $vegetables->name = "Vegetables";
        $vegetables->parent_id = $foods->id;
        $vegetables->save();

        $soups = new Category();
        $soups->name = "Soups";
        $soups->parent_id = $foods->id;
        $soups->save();

        $hotdrinks = new Category();
        $hotdrinks->name = "Hot Drinks";
        $hotdrinks->parent_id = $liquids->id;
        $hotdrinks->save();

        $colddrinks = new Category();
        $colddrinks->name = "Cold Drinks";
        $colddrinks->parent_id = $liquids->id;
        $colddrinks->save();

        $cakes = new Category();
        $cakes->name = "Cakes";
        $cakes->parent_id = $desserts->id;
        $cakes->save();

        $pies = new Category();
        $pies->name = "Pies";
        $pies->parent_id = $desserts->id;
        $pies->save();


        //digital main categories
        $softwares = new Category();
        $softwares->name = 'Softwares';
        $softwares->type = 'digital';
        $softwares->save();

        $accounts = new Category();
        $accounts->name = 'Accounts';
        $accounts->type = 'digital';
        $accounts->save();

        //digital child categories
        $os = new Category();
        $os->name = "Operating Systems";
        $os->parent_id = $softwares->id;
        $os->save();

        $app = new Category();
        $app->name = "Applications";
        $app->parent_id = $softwares->id;
        $app->save();

        $game = new Category();
        $game->name = "Game Accounts";
        $game->parent_id = $accounts->id;
        $game->save();

        $nextflix = new Category();
        $nextflix->name = "NextFlix";
        $nextflix->parent_id = $accounts->id;
        $nextflix->save();

        $this->addProducts();
    }

    public function addProducts()
    {
        $this->faker = Faker::create();

        //PIE
        $this->createProduct(
            'pies',
            'Delicious Pie On Sale',
            'piece',
            array("example/product/pies/pie.jpg", "example/product/pies/pie2.jpg", "example/product/pies/pie3.jpg"),
            "example/product/pies/pie-video.mp4"
        );
        //Cakes
        $this->createProduct(
            'cakes',
            'Cake with Chocolate and Peanut',
            'piece',
            array("example/product/cakes/cake1.jpg", "example/product/cakes/cake2.jpg", "example/product/cakes/cake3.jpg"),
        );
        //Salad
        $this->createProduct(
            'vegetables',
            'Caesar Salad with Avocado Pieces',
            'piece',
            array("example/product/vegetables/salad1.jpg", "example/product/vegetables/salad2.jpg", "example/product/vegetables/salad3.jpg"),
        );
        //Hamburger
        $this->createProduct(
            'master\'s specials',
            'XXXXL Hamburger maded with Bacon',
            'piece',
            array("example/product/specials/hamburg1.jpg", "example/product/specials/hamburg2.png", "example/product/specials/hamburg3.jpg"),
        );
        //Pizza
        $this->createProduct(
            'master\'s specials',
            'The Pizza Italiaonaoo Delicious',
            'piece',
            array("example/product/specials/pizza1.jpg", "example/product/specials/pizza2.jpg"),
        );
        //Gingerino
        $this->createProduct(
            'Cold Drinks',
            'Gingerino withOut Alcohol',
            'piece',
            array("example/product/colddrinks/gingerino2.png", "example/product/colddrinks/gingerino.jpg"),
        );
        //Coffee
        $this->createProduct(
            'Hot Drinks',
            'Tasteful Coffee with Thick Cream',
            'piece',
            array("example/product/hotdrinks/coffee.jpg", "example/product/hotdrinks/coffee1.jpg"),
        );
        //Cheap Cake
        $this->createProduct(
            'cakes',
            'A Cake for Soft Taste Lovers',
            'piece',
            array("example/product/cakes/cake4.jpg"),
        );
        //Cheap Cappuccino
        $this->createProduct(
            'Hot Drinks',
            'Fabulous Cappuccino for who knows the Taste',
            'piece',
            array("example/product/hotdrinks/cappu1.jpg"),
        );

        /// ------------- ///
        /// D I G I T A L ///
        /// ------------- ///

        //Cheap Malware Remover
        $this->createProduct(
            'Applications',
            'A Malware Remover with Affordable Price',
            'piece',
            array("example/product/applications/malwareremover1.png"),
        );
        //exclusiveOS
        $this->createProduct(
            'Operating Systems',
            'Modded Secure OS with hardened linux Kernel',
            'piece',
            array("example/product/os/exclusiveOS.jpg", "example/product/os/exclusiveOS1.png"),
        );
        //Apper
        $this->createProduct(
            'Applications',
            'Mobile App Maker - The Apper',
            'piece',
            array("example/product/applications/app3.jpg", "example/product/applications/app2.png", "example/product/applications/app1.png"),
        );
    }

    /// TIME TO CREATE PRODUCTS !!!

    private function createProduct(string $categoryName, string $productName, string $countType, array $pictures, ?string $video = null)
    {
        $category = Category::where('name', $categoryName)->first();

        $createProduct = new Product;
        $createProduct->user_id = Vendor::inRandomOrder()->first()->id;
        $createProduct->category_id = $category->id;
        $createProduct->name = $productName;
        $createProduct->description = $this->faker->paragraphs(3, true);
        $createProduct->rules = $this->faker->paragraphs(2, true);
        $createProduct->count_type = $countType;
        $createProduct->quantity = rand(1000, 10000);
        $createProduct->coins = 'xmr';
        $createProduct->save();

        $this->offerAdd(1, rand(1, 100), $createProduct->id);
        $this->offerAdd(1, rand(1, 100), $createProduct->id);


        foreach ($pictures as $index => $picture) {
            if ($index === array_key_first($pictures))
                $this->pictureAdd($picture, $createProduct->id, true);
            else
                $this->pictureAdd($picture, $createProduct->id, false);
        }

        if ($video != null)
            $this->videoAdd($video, $createProduct->id);

        if ($category->parent->type == "physical") {
//            $newPhysical = new PhysicalProduct();
//            $newPhysical->id = $createProduct->id;
//            $newPhysical->countries_option = 'all';
//            $newPhysical->countries = '';
//            $newPhysical->country_from = 'Prussia';
//            $newPhysical->save();

            PhysicalProduct::insert([
                'id' => $createProduct->id,
                //'countries_option' => 'all',
                'countries' => 'WorldWide',
                'country_from' => 'Prussia'
            ]);

            $this->shippingAdd($createProduct->id);
            $this->shippingAdd($createProduct->id);
        }

        if ($category->parent->type == "digital") {
//            $newDigital = new DigitalProduct();
//            $newDigital->id = $createProduct->id;
//            $newDigital->autodelivery = true;
//            $newDigital->content = 'autodelivery testing';
//            $newDigital->save();
            DigitalProduct::insert([
                'id' => $createProduct->id,
                'autodelivery' => true,
                'content' => 'autodelivery testing',
            ]);
        }
    }

    protected function offerAdd($offercount, $offerprice, $productId)
    {
        $createOffer = new Offer;
        $createOffer->product_id = $productId;
        $createOffer->min_quantity = $offercount;
        $createOffer->price = $offerprice;
        $createOffer->save();
    }

    protected function pictureAdd($picturePath, $productId, $main = false)
    {
        $createProductImage = new Image;
        $createProductImage->product_id = $productId;
        $createProductImage->first = $main;
        $createProductImage->image = $picturePath;
        $createProductImage->save();
    }

    protected function videoAdd($videoPath, $productId)
    {
        $createVideo = new Video;
        $createVideo->product_id = $productId;
        $createVideo->video = $videoPath;
        $createVideo->save();
    }

    protected function shippingAdd($productId, ?int $price = null)
    {
        $price ??= rand(1, 100);

        $this->faker = Faker::create();

        $createShipping = new Shipping;
        $createShipping->product_id = $productId;
        $createShipping->name = $this->faker->name;
        $createShipping->price = $price;
        $createShipping->duration = "1-2 weeks";
        $createShipping->from_quantity = 1;
        $createShipping->to_quantity = 100;
        $createShipping->save();
    }
}
