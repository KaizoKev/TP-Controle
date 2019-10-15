<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 * @UniqueEntity(
 *  fields={"libelle"},
 *  message="Un autre article possède déjà ce libelle, merci de le modifier"
 * )
 */
class Articles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, max=255, minMessage ="Le libellé doit faire plus de 5 caractère !", maxMessage="Le titre ne peut faire plus de 255 caractère !" )
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     * @Assert\Length(min=0, max=500, maxMessage="Le prix ne doit pas dépasser 500euros !" )
     */
    private $prix;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10, max=200, minMessage ="Votre description doit faire moins de 10 caractères !", maxMessage="La description ne doit pas dépassé 200 caractères" )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
