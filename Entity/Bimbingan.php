<?php

namespace Ais\BimbinganBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ais\BimbinganBundle\Model\BimbinganInterface;
/**
 * Bimbingan
 */
class Bimbingan implements BimbinganInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $mahasiswa_id;

    /**
     * @var string
     */
    private $prodi;

    /**
     * @var string
     */
    private $semester;

    /**
     * @var string
     */
    private $angkatan;

    /**
     * @var string
     */
    private $deskripsi;

    /**
     * @var string
     */
    private $tindakan;

    /**
     * @var string
     */
    private $keterangan;

    /**
     * @var string
     */
    private $tema;

    /**
     * @var \DateTime
     */
    private $tanggal;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var boolean
     */
    private $is_delete;


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
     * Set mahasiswaId
     *
     * @param integer $mahasiswaId
     *
     * @return Bimbingan
     */
    public function setMahasiswaId($mahasiswaId)
    {
        $this->mahasiswa_id = $mahasiswaId;

        return $this;
    }

    /**
     * Get mahasiswaId
     *
     * @return integer
     */
    public function getMahasiswaId()
    {
        return $this->mahasiswa_id;
    }

    /**
     * Set prodi
     *
     * @param string $prodi
     *
     * @return Bimbingan
     */
    public function setProdi($prodi)
    {
        $this->prodi = $prodi;

        return $this;
    }

    /**
     * Get prodi
     *
     * @return string
     */
    public function getProdi()
    {
        return $this->prodi;
    }

    /**
     * Set semester
     *
     * @param string $semester
     *
     * @return Bimbingan
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * Get semester
     *
     * @return string
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * Set angkatan
     *
     * @param string $angkatan
     *
     * @return Bimbingan
     */
    public function setAngkatan($angkatan)
    {
        $this->angkatan = $angkatan;

        return $this;
    }

    /**
     * Get angkatan
     *
     * @return string
     */
    public function getAngkatan()
    {
        return $this->angkatan;
    }

    /**
     * Set deskripsi
     *
     * @param string $deskripsi
     *
     * @return Bimbingan
     */
    public function setDeskripsi($deskripsi)
    {
        $this->deskripsi = $deskripsi;

        return $this;
    }

    /**
     * Get deskripsi
     *
     * @return string
     */
    public function getDeskripsi()
    {
        return $this->deskripsi;
    }

    /**
     * Set tindakan
     *
     * @param string $tindakan
     *
     * @return Bimbingan
     */
    public function setTindakan($tindakan)
    {
        $this->tindakan = $tindakan;

        return $this;
    }

    /**
     * Get tindakan
     *
     * @return string
     */
    public function getTindakan()
    {
        return $this->tindakan;
    }

    /**
     * Set keterangan
     *
     * @param string $keterangan
     *
     * @return Bimbingan
     */
    public function setKeterangan($keterangan)
    {
        $this->keterangan = $keterangan;

        return $this;
    }

    /**
     * Get keterangan
     *
     * @return string
     */
    public function getKeterangan()
    {
        return $this->keterangan;
    }

    /**
     * Set tema
     *
     * @param string $tema
     *
     * @return Bimbingan
     */
    public function setTema($tema)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return string
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set tanggal
     *
     * @param \DateTime $tanggal
     *
     * @return Bimbingan
     */
    public function setTanggal($tanggal)
    {
        $this->tanggal = $tanggal;

        return $this;
    }

    /**
     * Get tanggal
     *
     * @return \DateTime
     */
    public function getTanggal()
    {
        return $this->tanggal;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Bimbingan
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Bimbingan
     */
    public function setIsDelete($isDelete)
    {
        $this->is_delete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->is_delete;
    }
}
