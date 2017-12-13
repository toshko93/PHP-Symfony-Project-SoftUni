<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\JobPost;
use FreelancingWebsiteBundle\Form\JobPostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class JobPostController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/jobPost/create", name="job_post_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $jobPost = new JobPost();
        $form = $this->createForm(JobPostType::class, $jobPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobPost->setClient($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($jobPost);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('jobPost/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param $id
     *
     * @Route("/jobPost/{id}", name="job_post_view")
     * @return Response
     */
    public function viewAction($id)
    {
        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($id);

        return $this->render('jobPost/job_post.html.twig', ['jobPost' => $jobPost]);
    }
}
