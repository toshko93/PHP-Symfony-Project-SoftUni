<?php

namespace FreelancingWebsiteBundle\Controller;

use FreelancingWebsiteBundle\Entity\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    /**
     * @Route("/notifications", name="all_notifications")
     * @return Response
     */
    public function viewAllNotificationsAction()
    {
        $myId = $this->getUser()->getId();

        $myTopFiveNotifications = $this->getDoctrine()->getRepository(Notification::class)->findBy(['userId' => $myId], ['dateCreated' => 'DESC']);

        return $this->render('notifications_test.html.twig', ['myTopFiveNotifications' => $myTopFiveNotifications]);
    }

    /**
     * @Route("/last_five_notifications/ajax", name="last_five_notifications")
     * @param Request $request
     * @return Response
     */
    public function viewTopFiveNotificationsAction(Request $request)
    {
        $myId = $this->getUser()->getId();
        $myTopFiveNotifications = $this->getDoctrine()->getRepository(Notification::class)->findBy(['userId' => $myId], ['dateCreated' => 'DESC'], 5);

        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach ($myTopFiveNotifications as $notification) {
                $temp = array(
                    'message' => $notification->getMessage(),
                    'link' => $notification->getTargetLink(),
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            return $this->render('notifications_test.html.twig', ['myTopFiveNotifications' => $myTopFiveNotifications]);
        }
    }
}
