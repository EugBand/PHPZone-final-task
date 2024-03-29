<?php

namespace App\DataFixtures;

use Cocur\Slugify\Slugify;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;
    private $slug;
    public function __construct($slugify)
    {
        $this->faker = Factory::create();
        $this->slug = Slugify::create();
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

       $this->loadPosts($manager);
    }

    public function loadPosts(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; $i++) {
            $post = new Post();
            $post->setTitle($this->faker->text(100));
            $post->setSlug($this->slug->slugify($post->getTitle()));
            $post->setBody($this->faker->text(1000));
            $post->setCreatedAt($this->faker->dateTime);

            $manager->persist($post);
        }
        $manager->flush();
    }
}
