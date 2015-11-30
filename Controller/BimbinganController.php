<?php

namespace Ais\BimbinganBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Ais\BimbinganBundle\Exception\InvalidFormException;
use Ais\BimbinganBundle\Form\BimbinganType;
use Ais\BimbinganBundle\Model\BimbinganInterface;


class BimbinganController extends FOSRestController
{
    /**
     * List all bimbingans.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing bimbingans.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many bimbingans to return.")
     *
     * @Annotations\View(
     *  templateVar="bimbingans"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getBimbingansAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('ais_bimbingan.bimbingan.handler')->all($limit, $offset);
    }

    /**
     * Get single Bimbingan.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Bimbingan for a given id",
     *   output = "Ais\BimbinganBundle\Entity\Bimbingan",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the bimbingan is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="bimbingan")
     *
     * @param int     $id      the bimbingan id
     *
     * @return array
     *
     * @throws NotFoundHttpException when bimbingan not exist
     */
    public function getBimbinganAction($id)
    {
        $bimbingan = $this->getOr404($id);

        return $bimbingan;
    }

    /**
     * Presents the form to use to create a new bimbingan.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newBimbinganAction()
    {
        return $this->createForm(new BimbinganType());
    }
    
    /**
     * Presents the form to use to edit bimbingan.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisBimbinganBundle:Bimbingan:editBimbingan.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the bimbingan id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when bimbingan not exist
     */
    public function editBimbinganAction($id)
    {
		$bimbingan = $this->getBimbinganAction($id);
		
        return array('form' => $this->createForm(new BimbinganType(), $bimbingan), 'bimbingan' => $bimbingan);
    }

    /**
     * Create a Bimbingan from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new bimbingan from the submitted data.",
     *   input = "Ais\BimbinganBundle\Form\BimbinganType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisBimbinganBundle:Bimbingan:newBimbingan.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postBimbinganAction(Request $request)
    {
        try {
            $newBimbingan = $this->container->get('ais_bimbingan.bimbingan.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newBimbingan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_bimbingan', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing bimbingan from the submitted data or create a new bimbingan at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\BimbinganBundle\Form\BimbinganType",
     *   statusCodes = {
     *     201 = "Returned when the Bimbingan is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisBimbinganBundle:Bimbingan:editBimbingan.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the bimbingan id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when bimbingan not exist
     */
    public function putBimbinganAction(Request $request, $id)
    {
        try {
            if (!($bimbingan = $this->container->get('ais_bimbingan.bimbingan.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $bimbingan = $this->container->get('ais_bimbingan.bimbingan.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $bimbingan = $this->container->get('ais_bimbingan.bimbingan.handler')->put(
                    $bimbingan,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $bimbingan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_bimbingan', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing bimbingan from the submitted data or create a new bimbingan at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\BimbinganBundle\Form\BimbinganType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisBimbinganBundle:Bimbingan:editBimbingan.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the bimbingan id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when bimbingan not exist
     */
    public function patchBimbinganAction(Request $request, $id)
    {
        try {
            $bimbingan = $this->container->get('ais_bimbingan.bimbingan.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $bimbingan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_bimbingan', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Fetch a Bimbingan or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return BimbinganInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($bimbingan = $this->container->get('ais_bimbingan.bimbingan.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $bimbingan;
    }
    
    public function postUpdateBimbinganAction(Request $request, $id)
    {
		try {
            $bimbingan = $this->container->get('ais_bimbingan.bimbingan.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $bimbingan->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_bimbingan', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
	}
}
