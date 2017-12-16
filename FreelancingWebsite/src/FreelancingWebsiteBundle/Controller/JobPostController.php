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
     * @Route("/jobPost/{id}", name="single_job_post_view")
     * @return Response
     */
    public function viewSingleAction($id)
    {
        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($id);

        return $this->render('jobPost/single.html.twig', ['jobPost' => $jobPost]);
    }

    /**
     * @Route("/my_job_posts", name="my_job_posts")
     * @param Request $request
     * @return Response
     */
    public function myJobPostsAction(Request $request)
    {
        $myId = $this->getUser()->getId();

        $myJobPosts = $this->getDoctrine()->getRepository(JobPost::class)->findBy(['clientId' => $myId]);

        return $this->render('jobPost/my_job_posts.html.twig', ['myJobPosts' => $myJobPosts]);
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
    public function editAction($id, Request $request)
    {
        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($id);

        if ($jobPost === null) {
            return $this->redirectToRoute('homepage');
        }

        $currentUser = $this->getUser();

        if (!$currentUser->isJobPostAuthor($jobPost) && !$currentUser->isAdmin())
        {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(JobPostType::class, $jobPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jobPost);
            $em->flush();

            return $this->redirectToRoute('job_post_view', array('id' => $jobPost->getId()));
        }

        return $this->render('jobPost/edit.html.twig', array('jobPost' => $jobPost, 'form' => $form->createView()));
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @Route("/jobPost/delete/{id}", name="job_post_delete")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function deleteAction($id, Request $request)
    {
        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($id);

        if ($jobPost === null) {
            return $this->redirectToRoute('homepage');
        }

        $currentUser = $this->getUser();

        if (!$currentUser->isJobPostAuthor($jobPost) && !$currentUser->isAdmin())
        {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(JobPostType::class, $jobPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jobPost);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('jobPost/delete.html.twig', array('jobPost' => $jobPost, 'form' => $form->createView()));
    }
}
