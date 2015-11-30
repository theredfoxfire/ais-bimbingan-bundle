<?php

namespace Ais\BimbinganBundle\Handler;

use Ais\BimbinganBundle\Model\BimbinganInterface;

interface BimbinganHandlerInterface
{
    /**
     * Get a Bimbingan given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return BimbinganInterface
     */
    public function get($id);

    /**
     * Get a list of Bimbingans.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post Bimbingan, creates a new Bimbingan.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return BimbinganInterface
     */
    public function post(array $parameters);

    /**
     * Edit a Bimbingan.
     *
     * @api
     *
     * @param BimbinganInterface   $bimbingan
     * @param array           $parameters
     *
     * @return BimbinganInterface
     */
    public function put(BimbinganInterface $bimbingan, array $parameters);

    /**
     * Partially update a Bimbingan.
     *
     * @api
     *
     * @param BimbinganInterface   $bimbingan
     * @param array           $parameters
     *
     * @return BimbinganInterface
     */
    public function patch(BimbinganInterface $bimbingan, array $parameters);
}
