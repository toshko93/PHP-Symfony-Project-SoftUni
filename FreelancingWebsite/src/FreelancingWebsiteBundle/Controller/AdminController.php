<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\Skill;
use FreelancingWebsiteBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Route("/admin/clients", name="all_clients_view")
     * @param Request $request
     * @return Response
     */
    public function viewAllClients()
    {
        $clients = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/all_clients.html.twig', ['clients' => $clients]);
    }

    /**
     * @Route("/admin/skills", name="all_skills_view")
     * @param Request $request
     * @return Response
     */
    public function viewAllSkills()
    {
        $skills = $this->getDoctrine()->getRepository(Skill::class)->findAll();

        return $this->render('admin/all_skills.html.twig', ['skills' => $skills]);
    }
}
