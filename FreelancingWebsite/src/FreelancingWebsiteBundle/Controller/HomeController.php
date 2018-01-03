<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\JobPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // ToDo: Check if client or freelancer
        $jobPosts = $this->getDoctrine()->getRepository(JobPost::class)->findBy(['isActive' => true]);

        return $this->render('default/index.html.twig', ['jobPosts' => $jobPosts]);
    }
}
