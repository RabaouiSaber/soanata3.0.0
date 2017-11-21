<?php
// src/AppBundle/Entity/FAQCategory/Translation.php

namespace AppBundle\Entity\BlogPost;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="appBundle_post1_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="lookup_unique_faq_post_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class TranslationPost extends AbstractPersonalTranslation
{
    
    /**
     * Convenient constructor
     *
     * @param string $locale
     * @param string $field
     * @param string $value
     */
    public function __construct($locale, $field, $value)
    {
        $this->setLocale($locale);
        $this->setField($field);
        $this->setContent($value);
    }
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Post", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;
}