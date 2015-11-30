<?php

namespace Ais\BimbinganBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BimbinganType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mahasiswa_id')
            ->add('prodi')
            ->add('semester')
            ->add('angkatan')
            ->add('deskripsi')
            ->add('tindakan')
            ->add('keterangan')
            ->add('tema')
            ->add('tanggal')
            ->add('is_active')
            ->add('is_delete')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ais\BimbinganBundle\Entity\Bimbingan',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
