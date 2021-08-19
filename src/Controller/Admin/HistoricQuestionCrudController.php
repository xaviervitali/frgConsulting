<?php

namespace App\Controller\Admin;

use App\Entity\HistoricQuestion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HistoricQuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HistoricQuestion::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
