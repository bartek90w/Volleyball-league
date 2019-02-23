<?php
// src/Controller/LeagueController.php
namespace App\Controller;

use App\Entity\League;
use App\Entity\User;
use App\Entity\Team;
use App\Entity\LeagueTable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class LeagueController extends AbstractController
{
    /**
     * @Route("/add_league", name="add_league")
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request)
    {
        $league = new League();
        $league->setOwner($this->getUser());
        $form = $this->createFormBuilder($league)
            ->add('name', TextType::class, ['label' => 'Nazwa'])
            ->add('teamsCount', TextType::class, ['label' => 'Liczba drużyn'])
            ->add('city', TextType::class, ['label' => 'Miasto'])
            ->add('save', SubmitType::class, ['label' => 'Utwórz ligę'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $league = $form->getData();
            $team = $this->getUser()->getTeam();
            $team->setLeague($league);
            $leagueTable = new LeagueTable();
            $leagueTable->setLeague($league);
            $leagueTable->setTeam($team);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($league);
            $entityManager->persist($team);
            $entityManager->persist($leagueTable);
            $entityManager->flush();

            return $this->redirectToRoute('league');
        }

        return $this->render('league/league.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/league", name="league")
     * @IsGranted("ROLE_USER")
     */
    public function show()
    {
        $team = $this->getUser()->getTeam();
        $league = null;
        if($team) {
            if ($team->getLeague())
                $league = $this->getDoctrine()->getRepository(League::class)->findOneBy(['id' => $team->getLeague()->getId()]);
        }
        if(!$team)
        {
            $league = $this->getDoctrine()->getRepository(League::class)->findOneBy(['owner' => $this->getUser()]);
            if(!$league)
            {
                return $this->render('team/no_team.html.twig');
            }

        }
        if($league)
        {
            $leagueTable = $this->getDoctrine()->getRepository(LeagueTable::class)->findBy(['league' => $league],['points' => 'ASC']);
            return $this->render('league/league_show.html.twig', ['league' => $league, 'leagueTable' => $leagueTable
            ]);
        }
        else return $this->render('league/no_league.html.twig');
    }

    /**
     * @Route("/choose_league", name="choose_league")
     * @IsGranted("ROLE_USER")
     */
    public function choose()
    {
        $leagues = $this->getDoctrine()->getRepository(League::class)->findAll();
        return $this->render('league/league_choose.html.twig', [
            'leagues' => $leagues
        ]);
    }

    /**
     * @Route("/delete_league", name="delete_league")
     * @IsGranted("ROLE_USER")
     */
    public function delete()
    {
        $league = $this->getDoctrine()->getRepository(League::class)->findOneBy(['owner' => $this->getUser()]);
        $leagueTable = $this->getDoctrine()->getRepository(LeagueTable::class)->findBy(['league' => $league]);
        $entityManager = $this->getDoctrine()->getManager();
        if($league) {
            $entityManager->remove($league);
            $entityManager->remove($leagueTable);
            $entityManager->flush();
        }
        return $this->redirectToRoute('league');
    }

    /**
     * @Route("/quit_league", name="quit_league")
     * @IsGranted("ROLE_USER")
     */
    public function quit()
    {
        $team = $this->getUser()->getTeam();
        if($team)
        {
            $team->setLeague(null);
            $leagueTable = $this->getDoctrine()->getRepository(LeagueTable::class)->findOneBy(['team' => $team]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($team);
            if($leagueTable)
            $entityManager->remove($leagueTable);
            $entityManager->flush();
        }
        return $this->redirectToRoute('league');
    }
    /**
     * @Route("/join_league/{league_id}", name="join_league")
     * @IsGranted("ROLE_USER")
     */
    public function join($league_id)
    {
        $team = $this->getUser()->getTeam();
        if($team)
        {
            $league = $this->getDoctrine()->getRepository(League::class)->findOneBy(['id' => $league_id]);
            $team->setLeague($league);
            $leagueTable = new LeagueTable();
            $leagueTable->setLeague($league);
            $leagueTable->setTeam($team);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($team);
            $entityManager->persist($leagueTable);
            $entityManager->flush();

        }
        return $this->redirectToRoute('league');
    }
}

