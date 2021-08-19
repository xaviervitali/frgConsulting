<?php 
namespace App\Service;

use App\Entity\HistoricQuestion;
use App\Repository\AnswerRepository;
use App\Repository\QuestionRepository;
use App\Repository\HistoricQuestionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DateTime;

class CSVExport
{
    public QuestionRepository $questionRepository;
    public AnswerRepository $answerRepository;
    public HistoricQuestionRepository $historicQuestionRepository;

    public function __construct(QuestionRepository $questionRepository, AnswerRepository $answerRepository, HistoricQuestionRepository $historicQuestionRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->historicQuestionRepository = $historicQuestionRepository;
    }
    public function QuestionsToCSV():Response

    {

        $questions = $this->questionRepository->findBy([], ["updatedAt" => "DESC"]);
        $myVariableCSV = "title; promoted; status;createdAt;updatedAt;\n";
      
        foreach ($questions as $question) {
      
            $title = $question->getTitle();
            $promoted = $question->getPromoted() ? "true" : "false";
            $status = $question->getStatus();
            $createdAt = $question->getCreatedAt()->format('Y-m-d H:i:s');
            $updatedAt = $question->getUpdatedAt()->format('Y-m-d H:i:s');
            $myVariableCSV .= "$title; $promoted; $status; $createdAt; $updatedAt;\n";
        };
        $date = new DateTime();
        $fileName = "QuestionList - " . $date->format('Y-m-d H:i:s') . " - .csv";
        return new Response(
            $myVariableCSV,
            200,
            [

                'Content-Type' => 'application/vnd.ms-excel',


                "Content-disposition" => "attachment; filename=$fileName"
            ]
            );

    }

    public function AnswersToCSV():Response
    {
       
        $answers = $this->answerRepository->findBy([], ["updatedAt" => "DESC"]);
        $myVariableCSV = "question; channel; body; createdAt; updatedAt;\n";
      
        foreach ($answers as $answer) {
      
            $question = $answer->getQuestion()->getTitle();
            $channel = $answer->getChannel();
            $body = str_replace("\n", " ", $answer->getBody());
            $createdAt = $answer->getCreatedAt()->format('Y-m-d H:i:s');
            $updatedAt = $answer->getUpdatedAt()->format('Y-m-d H:i:s');
            $myVariableCSV .= "$question; $channel; $body; $createdAt; $updatedAt;\n";
        };
        $date = new DateTime();
        $fileName = "AnswersList - " . $date->format('Y-m-d H:i:s') . " - .csv";
        return new Response(
            $myVariableCSV,
            200,
            [

                'Content-Type' => 'application/vnd.ms-excel',


                "Content-disposition" => "attachment; filename=$fileName"
            ]
            );

    }

    public function HistoricQuestionToCSV():Response
    {

        $historicQuestions = $this->historicQuestionRepository->findBy([], ["createdAt" => "DESC"]);
        $myVariableCSV = "question; old title; promoted; status;createdAt;createdAt;\n";
      
        foreach ($historicQuestions as $historicQuestion) {
      
            $question = $historicQuestion->getQuestion()->getTitle();
            $title = $historicQuestion->getTitle();
            $promoted = $historicQuestion->getPromoted() ? "true" : "false";
            $status = $historicQuestion->getStatus();
            $createdAt = $historicQuestion->getCreatedAt()->format('Y-m-d H:i:s');
            $myVariableCSV .= "$question; $title; $promoted; $status; $createdAt; ;\n";
        };
        $date = new DateTime();
        $fileName = "historicQuestionlist - " . $date->format('Y-m-d H:i:s') . " - .csv";
        return new Response(
            $myVariableCSV,
            200,
            [

                'Content-Type' => 'application/vnd.ms-excel',


                "Content-disposition" => "attachment; filename=$fileName"
            ]
            );

    }
}