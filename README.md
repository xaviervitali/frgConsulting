# frgConsulting
<div>Bonjour,

Voici mon projet.

A ce jour l'étape 1 est fonctionnelle :
<a href="{{'/api'}}" class="btn btn-success btn-sm">Visualiser l'api</a>  
</div>

<div class="text-sm font-italic"  style="font-size : .8rem;">

##### Step 1:

Create an API to validate a Q&A and store into a database with following extra fields : createdAt, updatedAt 

Constraints : 
Answers.channel value is restricted to "faq" or "bot"
Status value is restricted to "draft" or "published"
</div>
</div>
<div class="m-2">
L'étape 2 est finalisée aussi j'ai réutilisé le subscriber pour écrire chaque changement de question dans la table correspondante

<div class="text-sm font-italic"  style="font-size : .8rem;">

##### Step 2:

1. Update existing Q&A to change the value of the title and the status. 
2. Listen to changes on the question and populate a new entity HistoricQuestion with those changes.
</div>

</div>

<div class="m-2">
L'étape 3 est terminée <a href="{{'/export'}}" class="btn btn-success btn-sm">Exporter les données</a>. J'ai crée le service, est converti les données au format CSV.
<div class="text-sm font-italic"  style="font-size : .8rem;">

##### Step 3:

1. Create an exporter service which is be able to export any entity type content into CSV file
2. Use the previously created exporter in order to export HistoricQuestion datas
</div>
</div>
<div class="m-2">
Quant au bonus hélas je n'ai pas eu le temps de former sur docker
<div class="text-sm font-italic"  style="font-size : .8rem;">
##### Bonus:

1. Dockerize the project and provide related readme file 
2. Explain how you would do it if you've been asked to populate HistoricQuestion asynchronously
</div>
</div>
<div class="m-2">
J'ai crée une page <a href="{{'/admin'}}" class="btn btn-success btn-sm">admin</a> avec easy admin.
</div>

<div class="m-2">
pour résumé j'ai utilisé le package api-platform pour crée l'api dans laquelle j'ai utilisé des asserts (Symfony\Component\Validator\Constraints) pour restreindre le type de données. J'ai installé easy-admin pour créer la page admin.
J'ai crée un subscriber qui permet d'implémenter "createdAt, updatedAt" si l'entité est Question ou Answer et qui permet aussi d'historiser les questions lors de leurs changements.

J'ai crée un formulaire pour lister les données dans la page d'export. 
</div>

</div>
