<?php

namespace Boras;

/**
 * @Entity @Table(name="ontologija")
 **/

class Ontologija
{
    /** @id @Column(type="integer") @GeneratedValue **/
    protected $sifra;

    /**
    * @Column(type="string")
    */
    private $autor;

    /**
    * @Column(type="string")
    */
    private $dobioNagradu;

    /**
    * @Column(type="integer")
    */
    private $rodjenje;

    /**
    * @Column(type="integer")
    */
    private $vrijemeObjavljivanjaKnjige;

    /**
    * @Column(type="string")
    */
    private $nagradjenaKnjiga;

    /**
    * @Column(type="string")
    */
    private $zanr;

  	public function getSifra(){
      return $this->sifra;
    }
  
    public function setSifra($sifra){
      $this->sifra = $sifra;
    }
  
    public function getAutor(){
      return $this->autor;
    }
  
    public function setAutor($autor){
      $this->autor = $autor;
    }
  
    public function getDobioNagradu(){
      return $this->dobioNagradu;
    }
  
    public function setDobioNagradu($dobioNagradu){
      $this->dobioNagradu = $dobioNagradu;
    }
  
    public function getRodjenje(){
      return $this->rodjenje;
    }
  
    public function setRodjenje($rodjenje){
      $this->rodjenje = $rodjenje;
    }
  
    public function getVrijemeObjavljivanjaKnjige(){
      return $this->vrijemeObjavljivanjaKnjige;
    }
  
    public function setVrijemeObjavljivanjaKnjige($vrijemeObjavljivanjaKnjige){
      $this->vrijemeObjavljivanjaKnjige = $vrijemeObjavljivanjaKnjige;
    }
  
    public function getNagradjenaKnjiga(){
      return $this->nagradjenaKnjiga;
    }
  
    public function setNagradjenaKnjiga($nagradjenaKnjiga){
      $this->nagradjenaKnjiga = $nagradjenaKnjiga;
    }
  
    public function getZanr(){
      return $this->zanr;
    }
  
    public function setZanr($zanr){
      $this->zanr = $zanr;
    }

  public function setPodaci($podaci)
	{
		foreach($podaci as $kljuc => $vrijednost){
			$this->{$kljuc} = $vrijednost;
		}
	}

}
