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
     * @param $id, $proposal_id
     *
     * @Route("/jobPost/{id}/proposal/{proposal_id}", name="single_proposal_view")
     * @return Response
     */
    public function viewSingleAction($id, $proposal_id)
    {
        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($id);
        $proposal = $this->getDoctrine()->getRepository(Proposal::class)->find($proposal_id);

        return $this->render('proposal/single.html.twig', ['jobPost' => $jobPost, 'proposal' =>$proposal]);
    }

    /**
     * @Route("/jobPost/{id}/proposals", name="all_proposals_for_single_job_post")
     * @param Request $request
     * @return Response
     */
    public function viewAllProposalsForSingleJobPost($id, Request $request)
    {
//        $myId = $this->getUser()->getId();
//
//        $myJobPosts = $this->getDoctrine()->getRepository(JobPost::class)->findBy(['clientId' => $myId]);
//
//        return $this->render('jobPost/my_job_posts.html.twig', ['myJobPosts' => $myJobPosts]);
        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($id);

        return $this->render('proposal/all.html.twig', ['jobPost' => $jobPost]);
    }
}
