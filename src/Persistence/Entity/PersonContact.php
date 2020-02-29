<?php

namespace OmniTools\Addresses\Persistence\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="addresses_person_contact", options={"collate":"utf8mb4_general_ci", "charset":"utf8mb4"})
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({
 *     "Email" = "PersonContactEmail",
 *     "Phone" = "PersonContactPhone",
 *     "Fax" = "PersonContactFax",
 * })
 * @HasLifecycleCallbacks
 */
abstract class PersonContact extends \OmniTools\Core\Persistence\AbstractEntity
{
    const TYPE_EMAIL = 'Email';
    const TYPE_PHONE = 'Phone';
    const TYPE_FAX = 'Fax';

    /**
     * @ManyToOne(targetEntity="Person", inversedBy="contacts")
     * @JoinColumn(name="person_id", referencedColumnName="id", nullable=false)
     */
    protected $person;

    /**
     * @Column(length=255, nullable=true, options={"default":"Private"})
     */
    protected $scope = 'Private';

    /**
     * @Column(length=255, nullable=true)
     */
    protected $value;

    /**
     *
     */
    public function getType(): string
    {
        preg_match('#\\PersonContact([a-z]+)$#i', get_class($this), $match);

        return $match[1];
    }

    /**
     *
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     *
     */
    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }
}
