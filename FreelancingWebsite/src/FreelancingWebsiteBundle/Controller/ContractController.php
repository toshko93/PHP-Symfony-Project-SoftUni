<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\Contract;
use FreelancingWebsiteBundle\Entity\JobPost;
use FreelancingWebsiteBundle\Entity\Proposal;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/contract/create", name="contract_create")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $jobPostId = $_GET['job_post_id'];
        $proposalId = $_GET['proposal_id'];

        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($jobPostId);
        $proposal = $this->getDoctrine()->getRepository(Proposal::class)->find($proposalId);
        $priceAgreed = $proposal->getProposedPrice();

        $contract = new Contract();
        $contract->setSumAgreed($priceAgreed);
        $contract->setJobPost($jobPost);
        $contract->setProposal($proposal);

        $em = $this->getDoctrine()->getManager();
        $em->persist($contract);
        $em->flush();

        return $this->redirectToRoute('single_contract_view', ['id' => $jobPostId, 'jobPost' => $jobPost, 'contract' => $contract]);
//        return $this->render('jobPost/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param $id
     *
     * @Route("/contract/{id}", name="single_contract_view")
     *
     * @return Response
     */
    public function viewSingleAction($id)
    {
        $contract = $this->getDoctrine()->getRepository(Contract::class)->find($id);
        $jobPost = $this->getDoctrine()->getRepository(JobPost::class)->find($contract->getJobPostId());

        return $this->render('contract/single.html.twig', ['jobPost' => $jobPost, 'contract' => $contract]);
    }
}
