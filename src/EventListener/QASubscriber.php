<?php

namespace App\EventListener;


use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;


use DateTime;
use App\Entity\User;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\HistoricQuestion;
use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping\PostUpdate;
use Doctrine\ORM\EntityManagerInterface;


class QASubscriber implements EventSubscriber
{

    private DateTime $date;
    private EntityManagerInterface $em;
    private Question $question;

    function __construct(EntityManagerInterface $em)
    {

        $this->date = new DateTime();
        $this->em = $em;
    }

    public function getSubscribedEvents()
    {
        return [
            "prePersist",
            "preUpdate",
            "postUpdate",
            "postPersist"
        ];
    }

    private function archivateQuestion(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Question) {
            
            $historicQuestion = new HistoricQuestion;
            $historicQuestion
                ->setCreatedAt($this->question->getUpdatedAt())
                ->setPromoted($this->question->getPromoted())
                ->setQuestion($this->question)
                ->setStatus($this->question->getStatus())
                ->setTitle($this->question->getTitle());

            $this->em->persist($historicQuestion);
            $this->em->flush();
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->archivateQuestion($args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->archivateQuestion($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Question || $entity instanceof Answer) {


            if ($entity instanceof Question) {

                $this->question = $entity;
            }
           
            $entity->setUpdatedAt(new DateTime());


            return;
        }
        return;
    }


    public function prePersist(LifecycleEventArgs $args)
    {

        $entity = $args->getObject();
        if ($entity instanceof Question || $entity instanceof Answer) {

        
            $entity->setCreatedAt($this->date);
            $entity->setUpdatedAt($this->date);
            
            if ($entity instanceof Question) {

                $this->question = $entity;
            }
        }
   
    }
}
