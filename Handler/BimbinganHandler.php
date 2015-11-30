<?php

namespace Ais\BimbinganBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Ais\BimbinganBundle\Model\BimbinganInterface;
use Ais\BimbinganBundle\Form\BimbinganType;
use Ais\BimbinganBundle\Exception\InvalidFormException;

class BimbinganHandler implements BimbinganHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a Bimbingan.
     *
     * @param mixed $id
     *
     * @return BimbinganInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of Bimbingans.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new Bimbingan.
     *
     * @param array $parameters
     *
     * @return BimbinganInterface
     */
    public function post(array $parameters)
    {
        $bimbingan = $this->createBimbingan();

        return $this->processForm($bimbingan, $parameters, 'POST');
    }

    /**
     * Edit a Bimbingan.
     *
     * @param BimbinganInterface $bimbingan
     * @param array         $parameters
     *
     * @return BimbinganInterface
     */
    public function put(BimbinganInterface $bimbingan, array $parameters)
    {
        return $this->processForm($bimbingan, $parameters, 'PUT');
    }

    /**
     * Partially update a Bimbingan.
     *
     * @param BimbinganInterface $bimbingan
     * @param array         $parameters
     *
     * @return BimbinganInterface
     */
    public function patch(BimbinganInterface $bimbingan, array $parameters)
    {
        return $this->processForm($bimbingan, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param BimbinganInterface $bimbingan
     * @param array         $parameters
     * @param String        $method
     *
     * @return BimbinganInterface
     *
     * @throws \Ais\BimbinganBundle\Exception\InvalidFormException
     */
    private function processForm(BimbinganInterface $bimbingan, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new BimbinganType(), $bimbingan, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $bimbingan = $form->getData();
            $this->om->persist($bimbingan);
            $this->om->flush($bimbingan);

            return $bimbingan;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createBimbingan()
    {
        return new $this->entityClass();
    }

}
