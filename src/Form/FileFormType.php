<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class FileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'mapped' => false,
                'label' => 'Ajouter un fichier :',
                'constraints' => [
                    new File([
                      'maxSize' => '2048k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'text/csv',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'application/json',
                            'application/vnd.oasis.opendocument.text',
                            'application/x-rar-compressed',
                            'application/x-tar',
                            'application/zip'
                        ]
                    ])
                ],
            ]);
    }
}