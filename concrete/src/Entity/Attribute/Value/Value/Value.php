<?php
namespace Concrete\Core\Entity\Attribute\Value\Value;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\Table(name="AttributeValueValues")
 */
abstract class Value
{
    /**
     * @ORM\Id @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $avID;

    /**
     * @ORM\OneToMany(targetEntity="\Concrete\Core\Entity\Attribute\Value\Value", mappedBy="value")
     **/
    protected $attribute_values;

    /**
     * @return mixed
     */
    public function getAttributeKey()
    {
        $values = $this->getAttributeValues();
        if ($values->containsKey(0)) {
            return $values->get(0)->getAttributeKey();
        }
    }

    /**
     * @return mixed
     */
    public function getAttributeValues()
    {
        return $this->attribute_values;
    }

    public function getValue()
    {
        return $this;
    }

    public function getAttributeValueID()
    {
        return $this->avID;
    }


    public function __construct()
    {
        $this->attribute_values = new ArrayCollection();
    }

    public function getDisplaySanitizedValue()
    {
        $controller = $this->getAttributeKey()->getController();
        if (method_exists($controller, 'getDisplaySanitizedValue')) {
            $controller->setAttributeValue($this);

            return $controller->getDisplaySanitizedValue();
        }

        return $this->getDisplayValue();
    }

    public function getDisplayValue()
    {
        $controller = $this->getAttributeKey()->getController();
        if (method_exists($controller, 'getDisplayValue')) {
            $controller->setAttributeValue($this);

            return $controller->getDisplayValue();
        }

        return $this->getValue();
    }

    public function getSearchIndexValue()
    {
        $controller = $this->getAttributeKey()->getController();
        if (method_exists($controller, 'getSearchIndexValue')) {
            $controller->setAttributeValue($this);

            return $controller->getSearchIndexValue();
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getDisplayValue();
    }
}
