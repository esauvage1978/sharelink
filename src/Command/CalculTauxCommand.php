<?php

namespace App\Command;


use App\Repository\ActionRepository;
use App\Repository\AxeRepository;
use App\Repository\CategoryRepository;
use App\Repository\DeployementRepository;
use App\Repository\IndicatorRepository;
use App\Repository\IndicatorValueRepository;
use App\Repository\PoleRepository;
use App\Repository\ThematiqueRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculTauxCommand extends AbstractCommand implements CommandInterface
{
    protected static $defaultName = 'app:calcultaux';

    private $managerRegistry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->managerRegistry = $registry;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Calcul les taux de l\'application.')
            ->setHelp('Cette commande permet de lancer l\'ensemble des calculs pour les taux1 et taux 2.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->runTraitement();

        $this->showMessage($output);

        return 0;
    }

    public function runTraitement(): void
    {
        $debut = microtime(true);

        $this->addMessage('Calcul pour les valeurs des indicateurs');
        $indicatorRepo = new IndicatorValueRepository($this->managerRegistry);
        $indicatorRepo->propagationWeight();

        $this->addMessage('Calcul pour les indicateurs');
        $indicatorRepo = new IndicatorRepository($this->managerRegistry);
        $indicatorRepo->tauxRaz();
        $indicatorRepo->tauxCalcul();

        $this->addMessage('Calcul pour les déploiements');
        $deployementRepo = new DeployementRepository($this->managerRegistry);
        $deployementRepo->tauxRaz();
        $deployementRepo->tauxCalcul();

        $this->addMessage('Calcul pour les actions');
        $repo = new ActionRepository($this->managerRegistry);
        $repo->tauxRaz();
        $repo->tauxCalcul();

        $this->addMessage('Calcul pour les catégories');
        $repo = new CategoryRepository($this->managerRegistry);
        $repo->tauxRaz();
        $repo->tauxCalcul();

        $this->addMessage('Calcul pour les thématiques');
        $repo = new ThematiqueRepository($this->managerRegistry);
        $repo->tauxRaz();
        $repo->tauxCalcul();

        $this->addMessage('Calcul pour les pôles');
        $repo = new PoleRepository($this->managerRegistry);
        $repo->tauxRaz();
        $repo->tauxCalcul();

        $this->addMessage('Calcul pour les plans d\'actions');
        $repo = new AxeRepository($this->managerRegistry);
        $repo->tauxRaz();
        $repo->tauxCalcul();


        $fin = microtime(true);

        $this->addMessage('Traitement effectué en  '.$this->calculTime($fin, $debut).' millisecondes.');
    }

}
