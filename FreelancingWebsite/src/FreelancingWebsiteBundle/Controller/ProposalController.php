<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\JobPost;
use FreelancingWebsiteBundle\Entity\Proposal;
use FreelancingWebsiteBundle\Form\ProposalType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProposalController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("//jobPost/{id}/createProposal", name="proposal_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function createAction($id, Request $request)
    {
        $proposal = new Proposal();
        $form = $this->createForm(ProposalType::class, $proposal);

        $form->handleRequest($request);

        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $proposal->setJobPost($jobPost);
            $proposal->setFreelancer($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($proposal);
            $em->flush();

            return $this->redirectToRoute('single_job_post_view', ['id' => $jobPost->getId()]);
        }

        return $this->render('proposal/create.html.twig', [
            'form' => $form->createView(),
            'jobPost' => $jobPost
        ]);
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

        return $this->render('jobPost/single_job_post.html.twig', ['jobPost' => $jobPost]);
    }
}
