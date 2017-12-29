<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\Category;
use FreelancingWebsiteBundle\Entity\Contract;
use FreelancingWebsiteBundle\Entity\JobPost;
use FreelancingWebsiteBundle\Entity\Skill;
use FreelancingWebsiteBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Route("/admin/job_posts", name="admin_all_job_posts")
     */
    public function allJobPostsAction(Request $request)
    {
        $jobPosts = $this->getDoctrine()->getRepository(JobPost::class)->findAll();

        return $this->render('admin/all_job_posts.html.twig', ['jobPosts' => $jobPosts]);
    }

    /**
     * @Route("/admin/clients", name="admin_all_clients_view")
     * @param Request $request
     * @return Response
     */
    public function allClientsAction()
    {
        $clients = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/all_clients.html.twig', ['clients' => $clients]);
    }

    /**
     * @Route("/admin/contracts", name="admin_all_contracts_view")
     * @param Request $request
     * @return Response
     */
    public function allContractsAction()
    {
        $contracts = $this->getDoctrine()->getRepository(Contract::class)->findAll();

        return $this->render('admin/all_contracts.html.twig', ['contracts' => $contracts]);
    }

    /**
     * @Route("/admin/categories", name="admin_all_categories_view")
     * @param Request $request
     * @return Response
     */
    public function allCategoriesAction()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render('admin/all_categories.html.twig', ['categories' => $categories]);
    }

    /**
     * @Route("/admin/skills", name="admin_all_skills_view")
     * @param Request $request
     * @return Response
     */
    public function allSkillsAction()
    {
        $skills = $this->getDoctrine()->getRepository(Skill::class)->findAll();

        return $this->render('admin/all_skills.html.twig', ['skills' => $skills]);
    }
}
