<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Link;
use App\Repository\CategoryRepository;
use App\Validator\LinkValidator;
use App\Helper\FixturesImportData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class Step3_LinkFixtures extends Fixture implements FixtureGroupInterface
{
    private $data=[
        [
            'name'=>'ALIENORH',
            'content'=>'Application pour les demandes RH',
            'icon'=>'fa fa-user',
            'link'=>'http://alienorh.cnamts.fr/',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'Améli réseau',
            'content'=>'Intranet des collaborateurs de l\'Assurance Maladie',
            'icon'=>'fas fa-atlas',
            'link'=>'https://ameli-reseau.cnamts.fr',
            'is_enable'=>true,
            'category_id'=>1,
            'click'=>0,
            'is_secure'=>0
        ],
        [
            'name'=>'ASO',
            'content'=>'Atelier Simple d\'optimisation : Suivi & partage',
            'icon'=>'fab fa-amilia',
            'link'=>'http://aso-smi.cti-raa.cnamts.fr',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'CLOE',
            'content'=>'Gestion des impressions dématérialisées',
            'icon'=>'fas fa-print',
            'link'=>'http://cloeprod.cnamts.fr:14102/H0J/bin/accueil.jsp',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'ALINEA 2',
            'content'=>'Application de gestion des entretiens annuels d\'évaluation et d\'accompagnement (EAEA) et des entretiens professionnels (EP)',
            'icon'=>'fa fa-user',
            'link'=>'https://alinea.ramage/app.php',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'CSN',
            'content'=>'Centre de support national',
            'icon'=>'far fa-life-ring',
            'link'=>'http://www.support-national.cnamts.fr/',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'DECLI',
            'content'=>'Délcaration des incivilités',
            'icon'=>'fas fa-bullhorn',
            'link'=>'http://55.114.4.50/decli/',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'OSS PSSI',
            'content'=>'Suivi de la maturité des politiques PSSI PCA PCSAC',
            'icon'=>'fas fa-shield-at',
            'link'=>'http://oss-pssi.cnamts.fr/',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'SD-GDI',
            'content'=>'Service desk - Gestion des incidents',
            'icon'=>'far fa-life-ring',
            'link'=>'http://www.support-national.cnamts.fr/espacelocal',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'SPPR',
            'content'=>'Système de pilotage de la performance du réseau',
            'icon'=>'fas fa-chart-bar',
            'link'=>'http://sppr.cnamts.fr:3525/',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'IAP ANR',
            'content'=>'Annaire de publication AH2',
            'icon'=>'fas fa-id-card',
            'link'=>'http://iapanr.cnamts.fr:7290',
            'is_enable'=>true,
            'category_id'=>4,
            'click'=>0,
            'is_secure'=>0
        ],
        [
            'name'=>'ALIFORM',
            'content'=>'Gestion des demandes de formation',
            'icon'=>'fa fa-user',
            'link'=>'http://aliform.cti-npnp.cnamts.fr:8080/Portail',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'Control-D',
            'content'=>'Application de centralisation des états',
            'icon'=>'far fa-file-at',
            'link'=>'http://controld.cti-npnp.cnamts.fr:7110/wa/',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'Inventaire applications locales',
            'content'=>'',
            'icon'=>'fab fa-app-store',
            'link'=>'http://applications-locales.cnamts.fr/index.php',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'OSCARR',
            'content'=>'',
            'icon'=>'fab fa-app-store',
            'link'=>'http://oscarr-p60.ssig.cnamts.fr:7580/RH_J/',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'OWA',
            'content'=>'Outlook',
            'icon'=>'far fa-enveloppe',
            'link'=>'https://mail.cnamts.fr/owa/',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'Trompette',
            'content'=>'Intranet de la cpam des Flandres',
            'icon'=>'fa fa-globe',
            'link'=>'http://w11590401ali',
            'is_enable'=>true,
            'category_id'=>3,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'LIAM',
            'content'=>'Réseau social de l\'Assurance maladie',
            'icon'=>'fa fa-globe',
            'link'=>'https://liam.assurance-maladie.fr',
            'is_enable'=>true,
            'category_id'=>3,
            'click'=>0,
            'is_secure'=>1
        ],        
        [
            'name'=>'Refdoc',
            'content'=>'Référentiel documentaire de la CPAM des Flandres',
            'icon'=>'fa fa-globe',
            'link'=>'http://refdoc',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'DCGDR PAR',
            'content'=>'Gestion des plans d\'actions de la DCGDR des hauts de France',
            'icon'=>'fa fa-globe',
            'link'=>'http://par.dcgdr-hdf.com',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'DCGDR PAR - Formation',
            'content'=>'Gestion des plans d\'actions de la DCGDR des hauts de France - Environemment de formation',
            'icon'=>'fa fa-globe',
            'link'=>'http://par-formation.dcgdr-hdf.com',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'DCGDR Sharepoint',
            'content'=>'Sharepoint de la DCGDR des hauts de France',
            'icon'=>'fa fa-globe',
            'link'=>'http://sharepoint.dcgdr-hdf.com',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'DCGDR Sharepoint - Formation',
            'content'=>'Sharepoint de la DCGDR des hauts de France - Environemment de formation',
            'icon'=>'fa fa-globe',
            'link'=>'http://sharepoint-formation.dcgdr-hdf.com',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'ASR BOX : Box mutualisés',
            'content'=>'Partage des box de l\'accueil',
            'icon'=>'fa fa-globe',
            'link'=>'http://w11590401ali/asr_box/securite.aspx',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ],
        [
            'name'=>'Annais',
            'content'=>'Annomalie Nationales Iris',
            'icon'=>'fa fa-globe',
            'link'=>'http://w11590401ali/asr_box/securite.aspx',
            'is_enable'=>true,
            'category_id'=>2,
            'click'=>0,
            'is_secure'=>1
        ]
    ];
    /**
     * @var LinkValidator
     */
    private $validator;

    /**
     * @var \App\Entity\Category[]
     */
    private $Categorys;

    /**
     * @var EntityManagerInterface
     */
    private $entityManagerInterface;

    public function __construct(
        LinkValidator $validator,
        CategoryRepository $CategoryRepository,
        EntityManagerInterface $entityManagerI
    ) {
        $this->validator = $validator;
        $this->Categorys = $CategoryRepository->findAll();
        $this->entityManagerInterface = $entityManagerI;
    }

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < count($this->data); ++$i) {
            $instance = $this->initialise(new Link(), $this->data[$i]);

            $this->checkAndPersist($instance);
        }
        $this->entityManagerInterface->flush();
    }



    private function checkAndPersist(Link $instance)
    {
        if ($this->validator->isValid($instance)) {
            $this->entityManagerInterface->persist($instance);
        } else {
            var_dump('Validator : ' . $this->validator->getErrors($instance));
        }
    }

    public function getInstance(string $id, $entitys)
    {
        foreach ($entitys as $entity) {
            if ($entity->getId() == $id) {
                return $entity;
            }
        }
    }

    private function initialise(Link $instance, $data): Link
    {
        /** @var Category $Category */
        $Category = $this->getInstance($data['category_id'], $this->Categorys);
        $instance
            ->setName($data['name'])
            ->setIsEnable($data['is_enable'])
            ->setIcon($data['icon'])
            ->setLink($data['link'])
            ->setClick($data['click'])
            ->setContent($data['content'])
            ->setIsSecure($data['is_secure'])
            ->setCategory($Category);

            return $instance;
    }



    public static function getGroups(): array
    {
        return ['step3'];
    }
}
