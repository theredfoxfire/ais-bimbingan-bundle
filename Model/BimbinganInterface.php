<?php

namespace Ais\BimbinganBundle\Model;

Interface BimbinganInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set mahasiswaId
     *
     * @param integer $mahasiswaId
     *
     * @return Bimbingan
     */
    public function setMahasiswaId($mahasiswaId);

    /**
     * Get mahasiswaId
     *
     * @return integer
     */
    public function getMahasiswaId();

    /**
     * Set prodi
     *
     * @param string $prodi
     *
     * @return Bimbingan
     */
    public function setProdi($prodi);

    /**
     * Get prodi
     *
     * @return string
     */
    public function getProdi();

    /**
     * Set semester
     *
     * @param string $semester
     *
     * @return Bimbingan
     */
    public function setSemester($semester);

    /**
     * Get semester
     *
     * @return string
     */
    public function getSemester();

    /**
     * Set angkatan
     *
     * @param string $angkatan
     *
     * @return Bimbingan
     */
    public function setAngkatan($angkatan);

    /**
     * Get angkatan
     *
     * @return string
     */
    public function getAngkatan();

    /**
     * Set deskripsi
     *
     * @param string $deskripsi
     *
     * @return Bimbingan
     */
    public function setDeskripsi($deskripsi);

    /**
     * Get deskripsi
     *
     * @return string
     */
    public function getDeskripsi();

    /**
     * Set tindakan
     *
     * @param string $tindakan
     *
     * @return Bimbingan
     */
    public function setTindakan($tindakan);

    /**
     * Get tindakan
     *
     * @return string
     */
    public function getTindakan();

    /**
     * Set keterangan
     *
     * @param string $keterangan
     *
     * @return Bimbingan
     */
    public function setKeterangan($keterangan);

    /**
     * Get keterangan
     *
     * @return string
     */
    public function getKeterangan();

    /**
     * Set tema
     *
     * @param string $tema
     *
     * @return Bimbingan
     */
    public function setTema($tema);

    /**
     * Get tema
     *
     * @return string
     */
    public function getTema();

    /**
     * Set tanggal
     *
     * @param \DateTime $tanggal
     *
     * @return Bimbingan
     */
    public function setTanggal($tanggal);

    /**
     * Get tanggal
     *
     * @return \DateTime
     */
    public function getTanggal();

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Bimbingan
     */
    public function setIsActive($isActive);

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive();

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Bimbingan
     */
    public function setIsDelete($isDelete);

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete();
}
