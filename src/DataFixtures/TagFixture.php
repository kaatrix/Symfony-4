<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Tag;

class TagFixture extends BaseFixtures
{
    protected function loadData(ObjectManager $manager)
    {   
        $this->createMany(Tag::class,10,function(Tag $tag) {
            $tag->setName($this->faker->realText(20));
        });

        $manager->flush();
    }
}
