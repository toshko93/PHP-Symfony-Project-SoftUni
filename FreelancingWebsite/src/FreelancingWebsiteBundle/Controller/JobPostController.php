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

    /**
     * @param $id
     * @param Request $request
     *
     * @Route("/jobPost/edit/{id}", name="job_post_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function editJobPostAction($id, Request $request)
    {
        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($id);

        if ($jobPost === null) {
            return $this->redirectToRoute("homepage");
        }

        $form = $this->createForm(JobPostType::class, $jobPost);

        return $this->render("jobPost/edit.html.twig", array('jobPost' => $jobPost, 'form' => $form->createView()));
    }
}
