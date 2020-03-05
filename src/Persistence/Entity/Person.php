<?php

namespace OmniTools\Addresses\Persistence\Entity;


/**
 * @Entity
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="className", type="string")
 * @DiscriminatorMap({
 *     "Person" = "Person",
 *     "\OmniTools\ApartmentsRental\Persistence\Entity\Customer" = "\OmniTools\ApartmentsRental\Persistence\Entity\Customer"
 * })
 * @Table(name="addresses_person", options={"collate":"utf8mb4_general_ci", "charset":"utf8mb4"})
 */
class Person extends \OmniTools\Core\Persistence\AbstractEntity
{
    /**
     * @OneToMany(targetEntity="PersonContact", mappedBy="person", cascade={"all"})
     */
    protected $contacts;

    /**
     * @Column(length=255, nullable=true)
     */
    protected $title;

    /**
     * @Column(length=255, nullable=true)
     */
    protected $gender;

    /**
     * @Column(length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @Column(length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @Column(length=255, nullable=true)
     */
    protected $street;

    /**
     * @Column(length=255, nullable=true)
     */
    protected $streetNumber;

    /**
     * @Column(length=255, nullable=true)
     */
    protected $addition;

    /**
     * @Column(length=255, nullable=true)
     */
    protected $zipcode;

    /**
     * @Column(length=255, nullable=true)
     */
    protected $city;

    /**
     * @Column(length=2, nullable=true)
     */
    protected $country;

    /**
     * @Column(length=5, nullable=true)
     */
    protected $language;

    /**
     * @Column(length=32, nullable=true)
     */
    protected $timezone;

    /**
     * @Column(type="text", nullable=true)
     */
    protected $noteInternal;

    /**
     * Person constructor.
     */
    public function __construct(array $record = null)
    {
        parent::__construct($record);

        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     *
     */
    public function addContact(PersonContact $contact): void
    {
        $contact->setPerson($this);

        $this->contacts->add($contact);
    }

    /**
     *
     */
    public function getAddition()
    {
        return $this->addition;
    }

    /**
     *
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     *
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     *
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     *
     */
    public function getEmail(): string
    {
        foreach ($this->contacts as $contact) {

            if ($contact->getType() == PersonContact::TYPE_EMAIL) {
                return $contact->getValue();
            }
        }

        return (string) null;
    }

    /**
     *
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     *
     */
    public function getFullName(): string
    {
        return $this->getFirstname() . ' ' . $this->getLastname();
    }

    /**
     *
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     *
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     *
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     *
     */
    public function getNoteInternal(): ?string
    {
        return $this->noteInternal;
    }

    /**
     *
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     *
     */
    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    /**
     *
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     *
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     *
     */
    public function setNoteInternal(string $noteInternal): void
    {
        $this->noteInternal = $noteInternal;
    }
}