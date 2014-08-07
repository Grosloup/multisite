<?php

namespace ZPB\Admin\MediatekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Pdf
 *
 * @ORM\Table(name="zpb_media_pdfs")
 * @ORM\Entity(repositoryClass="ZPB\Admin\MediatekBundle\Entity\PdfRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Pdf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9._-]*$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var \DateTime
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var string
     * @ORM\Column(name="upload_dir", type="string", length=255, nullable=false)
     */
    private $uploadDir;

    /**
     * @var string
     * @ORM\Column(name="doc_root", type="string", length=255, nullable=false)
     */
    private $docRoot;

    /**
     * @var string
     * @ORM\Column(name="extension", type="string", length=10, nullable=true)
     */
    private $extension;

    /**
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     * @Assert\File(maxSize="6000000",mimeTypes ={"application/pdf"}, mimeTypesMessage="Votre fichier n'est pas un fichier pdf valide.", maxSizeMessage="Votre pdf est trop lourd.")
     */
    public $file;

    private $originalPathForRemove;



    function __construct($uploadDir = "uploads/medias/pdf", $docRoot = "web")
    {
        $this->uploadDir = $uploadDir;
        $this->docRoot = $docRoot;
    }

    public function upload()
    {
        if ($this->file == null) {
            return false;
        }
        $this->extension = $this->file->guessExtension();
        $dest = $this->docRoot . "/" . $this->uploadDir;
        $this->filename = $this->name === null ? $this->sanitizeFilename($this->file->getClientOriginalName()) : $this->name . '.' . $this->extension;
        if($this->name === null){
            $this->name = preg_replace('/\.(pdf|PDF)$/', '', $this->filename);
        }
        $this->file->move($dest, $this->filename);

        $this->file = null;
        return true;
    }

    /**
     * @ORM\PreRemove()
     */
    public function storePath()
    {
        $this->originalPathForRemove = $this->getAbsolutePath();

    }

    /**
     * @ORM\PostRemove()
     */
    public function remove()
    {
        if($this->originalPathForRemove != null){
            unlink($this->originalPathForRemove);
        }

    }

    /**
     * @param string $string
     * @return string
     */
    private function sanitizeFilename($string="")
    {
        return preg_replace('/[^a-zA-Z0-9._-]/', '', $string);
    }

    public function getAbsolutePath()
    {
        return $this->filename === null ? null : $this->docRoot . "/" . $this->uploadDir . "/" . $this->filename;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Pdf
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return Pdf
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Pdf
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get uploadDir
     *
     * @return string
     */
    public function getUploadDir()
    {
        return $this->uploadDir;
    }

    /**
     * Set uploadDir
     *
     * @param string $uploadDir
     * @return Pdf
     */
    public function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;

        return $this;
    }

    /**
     * Get docRoot
     *
     * @return string
     */
    public function getDocRoot()
    {
        return $this->docRoot;
    }

    /**
     * Set docRoot
     *
     * @param string $docRoot
     * @return Pdf
     */
    public function setDocRoot($docRoot)
    {
        $this->docRoot = $docRoot;

        return $this;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return Pdf
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string 
     */
    public function getExtension()
    {
        return $this->extension;
    }
}
