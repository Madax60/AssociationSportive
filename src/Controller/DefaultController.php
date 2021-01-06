<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route(path="/", name="accueil", methods={"GET"})
     */
    public function index(): Response
    {

        $message = 'Bienvenue sur le site Internet';

        $news = [
            [
                'titre' => 'Confinement : les commerces pourraient rouvrir le 27 novembre, selon Bruno Le Maire',
                'contenu' => '«La réouverture est plus une affaire de jours que de semaines», affirme Bruno Le Maire.',
                'lien' => 'https://www.lefigaro.fr/conso/confinement-les-commerces-pourraient-rouvrir-le-27-novembre-20201116',
            ],
            [
                'titre' => 'Restaurateurs, commerçants et extras de l\'événementiel ont manifesté leur colère ce lundi',
                'contenu' => 'Des professionnels contraints d\'arrêter leur activité ont manifesté à Lyon et des extras de l\'événementiel ont placardé des photos dans plusieurs villes pour attirer l\'attention sur leur situation financière.',
                'lien' => 'https://www.lefigaro.fr/societes/restaurateurs-et-commercants-en-colere-attendus-dans-les-rues-ce-lundi-20201116',
            ],
            [
                'titre' => 'Raymond Soubie: «Beaucoup de travailleurs indépendants ont un sentiment d\'injustice»',
                'contenu' => 'INTERVIEW - Pour le président de la société de conseil Alixio, spécialiste des politiques sociales, le mécontentement et le sentiment d\'injustice dans une période aussi incertaine peuvent être des facteurs spontanés très forts de déclenchement de crise.',
                'lien' => 'https://www.lefigaro.fr/politique/le-scan/raymond-soubie-beaucoup-de-travailleurs-independants-ont-un-sentiment-d-injustice-20201116',
            ],
        ];

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'message' => $message,
            'news' => $news,
        ]);
    }

}
