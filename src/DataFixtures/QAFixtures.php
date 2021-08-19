<?php

namespace App\DataFixtures;

use App\Entity\HistoricQuestion;
use App\Entity\Question;
use App\Entity\Answer;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class QAFixtures extends AbstractFixture
{
   
   

    public function __construct()
    {
    
    }
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Question::class, 5, function (Question $question, $i) {
       

            $question
               ->setTitle($this->faker->catchPhrase())
               ->setPromoted($this->faker->boolean())
               ->setStatus($this->faker->randomElement($array = array ('draft','published')));

        });

        $this->createMany(Answer::class, random_int(0, 50), function (Answer $answer, $i) {
       

            $answer
                ->setQuestion($this->getRandomreference(Question::class))
    
                ->setChannel($this->faker->randomElement(['faq','bot']))
                
                ->setBody($this->faker->address() )
                ;
              

        });
        $manager->flush();
    }


}
