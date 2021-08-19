<?php

namespace App\Controller;

use App\Form\EntitySelectType;
use App\Repository\QuestionRepository;
use App\Service\CSVExport;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SonataController extends AbstractController
{
    #[Route('/admin/export', name: 'export')]
    public function index(Request $request, CSVExport $csvExport ): Response
    // {
 
        // $questions = $questionRepository->findBy([], ["updatedAt" => "DESC"]);
        // $myVariableCSV = "title; promoted; status;createdAt;updatedAt;\n";
      
        // foreach ($questions as $question) {
      
        //     $title = $question->getTitle();
        //     $promoted = $question->getPromoted() ? "true" : "false";
        //     $status = $question->getStatus();
        //     $createdAt = $question->getCreatedAt()->format('Y-m-d H:i:s');
        //     $updatedAt = $question->getUpdatedAt()->format('Y-m-d H:i:s');
        //     $myVariableCSV .= "$title; $promoted; $status; $createdAt; $updatedAt;\n";
        // };
        // $date = new DateTime();
        // $fileName = "QuestionList - " . $date->format('Y-m-d H:i:s') . " - .csv";
        // return new Response(
        //     $myVariableCSV,
        //     200,
        //     [

        //         'Content-Type' => 'application/vnd.ms-excel',


        //         "Content-disposition" => "attachment; filename=$fileName"
        //     ]
        // );
    //     return $this->render(
    //         'base.html.twig'
    //     );
    // }
    {
        $form = $this->createForm(EntitySelectType::class);

        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $entityName = $data['Entity'];

          
            switch($entityName){
                case "Question":
                    return $csvExport->QuestionsToCSV();
                    break;
                    case "Answer":
                        return  $csvExport->AnswersToCSV();
                        break;
                    case "HistoricQuestion":
                        return  $csvExport->HistoricQuestionToCSV();
                        break;
                    default:
                        break;

            };
   
        //     $userList = array_filter($userRepository->findAll(), function (User $u) use ($data) {
        //         return in_array($data['user'], $u->getRoles()) && !in_array('ROLE_SCHOOL', $u->getRoles());
        //     });

        //     $subject = $data['subject'];

        //     foreach ($userList as $user) {
        //         $email = new Email();
        //         $email
        //             ->from("donotreply@apelstda.fr")
        //             ->subject($subject)
        //             ->to($user->getEmail())
        //             ->html($data["body"]);
        //         $mailer->send($email);
            }


        //     return $this->redirectToRoute("admin_mail_index");
        // }

        return  $this->render("sonata/index.html.twig", [ "form" => $form->createView()]);
    }
}
