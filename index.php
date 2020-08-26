<?php
require 'vendor/autoload.php';
require 'bootstrap.php';
use Boras\Ontologija;
use Composer\Autoload\ClassLoader;

Flight::route('/', function(){
  $foaf = \EasyRdf\Graph::newAndLoad('https://oziz.ffos.hr/nastava20192020/aboras_19/ontologija-api/ontologija.rdf');
  echo $foaf->dump();
});

Flight::route('GET /search', function(){

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij=$em->getRepository('Boras\Ontologija');
  $zapisi = $repozitorij->findAll();
  echo $doctrineBootstrap->getJson($zapisi);
});

Flight::route('GET /search/@autor', function($autor){

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij=$em->getRepository('Boras\Ontologija');
  $zapisi = $repozitorij->createQueryBuilder('a')
                        ->where('a.autor LIKE :autor')
                        ->setParameter('autor', '%' . $autor . '%')
                        ->getQuery()
                        ->getResult();
  echo $doctrineBootstrap->getJson($zapisi);

});

Flight::route('GET /unosPodataka', function(){

  $foaf = \EasyRdf\Graph::newAndLoad('https://oziz.ffos.hr/nastava20192020/aboras_19/ontologija-api/ontologija.rdf');

  foreach ($foaf->resources() as $resource) {

    if($foaf->get($resource, '<http://oziz.ffos.hr/tsw2/aboras/dodjela#nagradjenaKnjiga>') != ''){
      
      $url = parse_url($foaf->get($resource, '<http://oziz.ffos.hr/aboras/ak-ontologija#Autor>'));
      $autor = str_replace('_', ' ', $url["fragment"]);
      $url = parse_url($foaf->get($resource, '<http://oziz.ffos.hr/aboras/ak-ontologija#DobioNagradu>'));
      $dobioNagradu = str_replace('_', ' ', $url["fragment"]);
      $rodjenje = ''.$foaf->get($resource, '<http://oziz.ffos.hr/aboras/ak-ontologija#RodjenJe>') . ' god.';
      $vrijemeObjavljivanjaKnjige = ''.$foaf->get($resource, '<http://oziz.ffos.hr/tsw2/aboras/dodjela#vrijeme_objavljivanja_knjige>') . ' god.';
      $nagradjenaKnjiga = ''.$foaf->get($resource, '<http://oziz.ffos.hr/tsw2/aboras/dodjela#nagradjenaKnjiga>');
      $zanr = ''.$foaf->get($resource, '<http://oziz.ffos.hr/tsw2/aboras/dodjela#zanr>');

      $ontologija = new Ontologija();
      $ontologija->setPodaci(Flight::request()->data);

        $ontologija->setAutor($autor);
        $ontologija->setDobioNagradu($dobioNagradu);
        $ontologija->setRodjenje($rodjenje);
        $ontologija->setVrijemeObjavljivanjaKnjige($vrijemeObjavljivanjaKnjige);
        $ontologija->setNagradjenaKnjiga($nagradjenaKnjiga);
        $ontologija->setZanr($zanr);

      $doctrineBootstrap = Flight::entityManager();
      $em = $doctrineBootstrap->getEntityManager();

      $em->persist($ontologija);
      $em->flush();
      }
    }

  echo "Podaci su uspješno uneseni u bazu..";

});

$cl = new ClassLoader('Boras', __DIR__, '/src');
$cl->register();
require_once 'bootstrap.php';
Flight::register('entityManager', 'DoctrineBootstrap');

Flight::start();
