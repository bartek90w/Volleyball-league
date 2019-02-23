<?php
/**
 * Created by PhpStorm.
 * User: Bartek
 * Date: 14.02.2019
 * Time: 13:35
 */

namespace App\Controller;


use App\Entity\Team;
use App\Entity\League;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class TeamController extends AbstractController
{
    /**
     * @Route("/add_team", name="add_team")
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request)
    {
        $team = new Team();
        $team->setCaptain($this->getUser());
        $league = $this->getDoctrine()->getRepository(League::class)->findOneBy(['owner' => $this->getUser()]);
        if($league) $team->setLeague($league);
        $form = $this->createFormBuilder($team)
            ->add('name', TextType::class, ['label' => 'Nazwa'])
            ->add('city', TextType::class, ['label' => 'Miasto'])
            ->add('save', SubmitType::class, ['label' => 'Utwórz drużynę'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $team = $form->getData();
            $user = $this->getUser();
            $user->setTeam($team);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($team);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('team');
        }

        return $this->render('team/team.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/team", name="team")
     * @IsGranted("ROLE_USER")
     */
    public function show()
    {
        $team_u = $this->getUser()->getTeam();
        $team = null;
        if($team_u)
        $team = $this->getDoctrine()->getRepository(Team::class)->findOneBy(['id' => $team_u->getId()]);
        if(!$team_u)
        {
            return $this->render('team/no_team.html.twig');
        }
        else if($team) return $this->render('team/team_show.html.twig', ['team' => $team
        ]);
    }

    /**
     * @Route("/choose_team", name="choose_team")
     * @IsGranted("ROLE_USER")
     */
    public function choose()
    {
        $teams = $this->getDoctrine()->getRepository(Team::class)->findAll();
        return $this->render('team/team_choose.html.twig', [
            'teams' => $teams
        ]);
    }
    /**
     * @Route("/delete_team", name="delete_team")
     * @IsGranted("ROLE_USER")
     */
    public function delete()
    {
        $team = $this->getUser()->getTeam();
        $entityManager = $this->getDoctrine()->getManager();
        if($team)
            $entityManager->remove($team);
            $entityManager->flush();
        return $this->redirectToRoute('team');
    }

    /**
     * @Route("/quit_team", name="quit_team")
     * @IsGranted("ROLE_USER")
     */
    public function quit()
    {
        $user = $this->getUser()->setTeam(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('team');
    }

    /**
     * @Route("/join_team/{team_id}", name="join_team")
     * @IsGranted("ROLE_USER")
     */
    public function join($team_id)
    {
        $user = $this->getUser();
        $team = $this->getDoctrine()->getRepository(Team::class)->findOneBy(['id' => $team_id]);
        $user->setTeam($team);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('team');
    }
}