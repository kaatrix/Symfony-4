<?php

namespace App\Form\Model;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity(
 *  fields={"email"},
 *  message="An email like this already exists"
 * )
 */
Class UserRegistrationFormModel
{
    /**
     * @Assert\NotBlank(message="Please enter an email")
     * @Assert\Email()
     */
    public $email;

    /**
     * @Assert\NotBlank(message="choose a password")
     * @Assert\Length(min=5, minMessage="password must be longer")
     */
    public $plainPassword;

    /**
     * @Assert\IsTrue(message="You must agree to our terms")
     */
    public $agreeTerms;
}