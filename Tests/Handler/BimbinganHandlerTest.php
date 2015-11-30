<?php

namespace Ais\BimbinganBundle\Tests\Handler;

use Ais\BimbinganBundle\Handler\BimbinganHandler;
use Ais\BimbinganBundle\Model\BimbinganInterface;
use Ais\BimbinganBundle\Entity\Bimbingan;

class BimbinganHandlerTest extends \PHPUnit_Framework_TestCase
{
    const DOSEN_CLASS = 'Ais\BimbinganBundle\Tests\Handler\DummyBimbingan';

    /** @var BimbinganHandler */
    protected $bimbinganHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::DOSEN_CLASS));
    }


    public function testGet()
    {
        $id = 1;
        $bimbingan = $this->getBimbingan();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($bimbingan));

        $this->bimbinganHandler = $this->createBimbinganHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $this->bimbinganHandler->get($id);
    }

    public function testAll()
    {
        $offset = 1;
        $limit = 2;

        $bimbingans = $this->getBimbingans(2);
        $this->repository->expects($this->once())->method('findBy')
            ->with(array(), null, $limit, $offset)
            ->will($this->returnValue($bimbingans));

        $this->bimbinganHandler = $this->createBimbinganHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $all = $this->bimbinganHandler->all($limit, $offset);

        $this->assertEquals($bimbingans, $all);
    }

    public function testPost()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $bimbingan = $this->getBimbingan();
        $bimbingan->setTitle($title);
        $bimbingan->setBody($body);

        $form = $this->getMock('Ais\BimbinganBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($bimbingan));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->bimbinganHandler = $this->createBimbinganHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $bimbinganObject = $this->bimbinganHandler->post($parameters);

        $this->assertEquals($bimbinganObject, $bimbingan);
    }

    /**
     * @expectedException Ais\BimbinganBundle\Exception\InvalidFormException
     */
    public function testPostShouldRaiseException()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $bimbingan = $this->getBimbingan();
        $bimbingan->setTitle($title);
        $bimbingan->setBody($body);

        $form = $this->getMock('Ais\BimbinganBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->bimbinganHandler = $this->createBimbinganHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $this->bimbinganHandler->post($parameters);
    }

    public function testPut()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $bimbingan = $this->getBimbingan();
        $bimbingan->setTitle($title);
        $bimbingan->setBody($body);

        $form = $this->getMock('Ais\BimbinganBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($bimbingan));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->bimbinganHandler = $this->createBimbinganHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $bimbinganObject = $this->bimbinganHandler->put($bimbingan, $parameters);

        $this->assertEquals($bimbinganObject, $bimbingan);
    }

    public function testPatch()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('body' => $body);

        $bimbingan = $this->getBimbingan();
        $bimbingan->setTitle($title);
        $bimbingan->setBody($body);

        $form = $this->getMock('Ais\BimbinganBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($bimbingan));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->bimbinganHandler = $this->createBimbinganHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $bimbinganObject = $this->bimbinganHandler->patch($bimbingan, $parameters);

        $this->assertEquals($bimbinganObject, $bimbingan);
    }


    protected function createBimbinganHandler($objectManager, $bimbinganClass, $formFactory)
    {
        return new BimbinganHandler($objectManager, $bimbinganClass, $formFactory);
    }

    protected function getBimbingan()
    {
        $bimbinganClass = static::DOSEN_CLASS;

        return new $bimbinganClass();
    }

    protected function getBimbingans($maxBimbingans = 5)
    {
        $bimbingans = array();
        for($i = 0; $i < $maxBimbingans; $i++) {
            $bimbingans[] = $this->getBimbingan();
        }

        return $bimbingans;
    }
}

class DummyBimbingan extends Bimbingan
{
}
