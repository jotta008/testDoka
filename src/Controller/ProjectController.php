<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Almacen;
use App\Entity\Laboratorio;
use App\Entity\Articulo;
 
/**
 * @Route("/api", name="api_")
 */
 
class ProjectController extends AbstractController
{
    /**
    * @Route("/project", name="project_index", methods={"GET"})
    */
    public function index(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine
            ->getRepository(Almacen::class)
            ->findAll();
  
        $data = [];
  
        foreach ($products as $product) {
           $data[] = [
               'id' => $product->getId(),
               'nombre' => $product->getNombre(),
           ];
        }
  
  
        return $this->json($data);
    }
    /**
    * @Route("/project/articulos", name="project_index_articulos", methods={"GET"})
    */
    public function index_articulos(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine
            ->getRepository(Articulo::class)
            ->findAll();
  
        $data = [];
  
        foreach ($products as $product) {
           $data[] = [
               'id' => $product->getId(),
               'nombre' => $product->getNombre(),
               'gtin' => $product->getGtin(),
               'codigoInterno' => $product->getCodigoInterno(),
               'esFraccionable' => $product->isFraccionable(),
               'unidadDeFraccion' => $product->getUnidaddefraccion(),
               'precioVenta' => $product->getPrecioventa(),
               'precioCompra' => $product->getPreciocompra(),
               'idAlmacen' => $product->getIdalmacen(),
               'idLaboratorio' => $product->getIdlaboratorio(),

           ];
        }
  
  
        return $this->json($data);
    }

    /**
    * @Route("/project/laboratorios", name="project_index_laboratorios", methods={"GET"})
    */
    public function index_laboratorios(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine
            ->getRepository(Laboratorio::class)
            ->findAll();
  
        $data = [];
  
        foreach ($products as $product) {
           $data[] = [
               'id' => $product->getId(),
               'nombre' => $product->getNombre(),
               'cuit' => $product->getCuit(),
               'razonSocial' => $product->getRazonsocial(),
               'direccion' => $product->getDireccion(),
               'codigo' => $product->getCodigo(),
           ];
        }
  
  
        return $this->json($data);
    }
 
  
    /**
     * @Route("/project/nuevo_laboratorio", name="project_new_laboratorio", methods={"POST"})
     */
    public function new_laboratorio(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
  
        $laboratorio = new Laboratorio();
        $laboratorio->setNombre($request->request->get('nombre'));
        $laboratorio->setCuit($request->request->get('cuit'));
        $laboratorio->setRazonsocial($request->request->get('razonSocial'));
        $laboratorio->setDireccion($request->request->get('direccion'));
        $laboratorio->setCodigo($request->request->get('codigo'));
  
        $entityManager->persist($laboratorio);
        $entityManager->flush();
  
        return $this->json('Created new project successfully with id ' . $laboratorio->getId());
    }
    /**
     * @Route("/project/nuevo_articulo", name="project_new_articulo", methods={"POST"})
     */
    public function new_articulo(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $articulo = new Articulo();
        $articulo->setNombre($request->request->get('nombre'));
        $articulo->setGtin($request->request->get('gtin'));
        $articulo->setCodigointerno($request->request->get('codigoInterno'));
        $articulo->setFraccionable($request->request->get('fraccionable'));
        $articulo->setUnidaddefraccion($request->request->get('unidadDeFraccion'));
        $articulo->setPrecioventa($request->request->get('precioVenta'));
        $articulo->setPreciocompra($request->request->get('precioCompra'));
        $laboratorio = $doctrine->getRepository(Laboratorio::class)->find($request->request->get('idLaboratorio'));             
        $articulo->setIdlaboratorio($laboratorio);
        $almacen = $doctrine->getRepository(Almacen::class)->find($request->request->get('idAlmacen'));             
        $articulo->setIdalmacen($almacen);
        $entityManager->persist($articulo);
        $entityManager->flush();
        return $this->json('Created new project successfully with id ' . $articulo->getId());
    }
    /**
     * @Route("/project/laboratorio/{id}", name="project_show_laboratorio", methods={"GET"})
     */
    public function show_laboratorio(ManagerRegistry $doctrine, int $id): Response
    {
        $laboratorio = $doctrine->getRepository(Laboratorio::class)->find($id);

        if (!$laboratorio) {
  
            return $this->json('No laboratorio found for id' . $id, 404);
        }
  
        $data =  [
            'id' => $laboratorio->getId(),
            'nombre' => $laboratorio->getNombre(),
            'cuit' => $laboratorio->getCuit(),
        ];
          
        return $this->json($data);
    }
    /**
     * @Route("/project/articulo/{id}", name="project_show_articulo", methods={"GET"})
     */
    public function show_articulo(ManagerRegistry $doctrine, int $id): Response
    {
        $articulo = $doctrine->getRepository(Articulo::class)->find($id);

        if (!$articulo) {
  
            return $this->json('No articulo found for id' . $id, 404);
        }
  
        $data =  [
            'id' => $articulo->getId(),
            'nombre' => $articulo->getNombre(),
            'gtin' => $articulo->getGtin(),
        ];
          
        return $this->json($data);
    }
  
    /**
     * @Route("/project/editar_laboratorio/{id}", name="project_edit_laboratorio", methods={"POST"})
     */
    public function edit_laboratorio(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $laboratorio = $entityManager->getRepository(Laboratorio::class)->find($id);
  
        if (!$laboratorio) {
            return $this->json('No project found for id' . $id, 404);
        }

        $laboratorio->setNombre($request->request->get('nombre'));
        $laboratorio->setCuit($request->request->get('cuit'));
        $laboratorio->setRazonsocial($request->request->get('razonSocial'));
        $laboratorio->setDireccion($request->request->get('direccion'));
        $laboratorio->setCodigo($request->request->get('codigo'));
        $entityManager->flush();
  
        $data =  [
            'status' => 'ok',
        ];
        return $this->json($data);
    }
    /**
     * @Route("/project/editar_articulo/{id}", name="project_edit_articulo", methods={"POST"})
     */
    public function edit_articulo(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $articulo = $entityManager->getRepository(Articulo::class)->find($id);

        if (!$articulo) {
            return $this->json('No project found for id' . $id, 404);
        }

        $articulo->setNombre($request->request->get('nombre'));
        $articulo->setGtin($request->request->get('gtin'));
        $articulo->setCodigointerno($request->request->get('codigoInterno'));
        $articulo->setFraccionable($request->request->get('fraccionable'));
        $articulo->setUnidaddefraccion($request->request->get('unidadDeFraccion'));
        $articulo->setPrecioventa($request->request->get('precioVenta'));
        $articulo->setPreciocompra($request->request->get('precioCompra'));
        $laboratorio = $doctrine->getRepository(Laboratorio::class)->find($request->request->get('idLaboratorio'));             
        $articulo->setIdlaboratorio($laboratorio);
        $almacen = $doctrine->getRepository(Almacen::class)->find($request->request->get('idAlmacen'));             
        $articulo->setIdalmacen($almacen);
        $entityManager->flush();
  
        $data =  [
            'status' => 'ok',
        ];
        
        return $this->json($data);
    }
  
    /**
     * @Route("/project/eliminar_laboratorio/{id}", name="project__laboratorio", methods={"POST"})
     */
    public function deleted_laboratorio(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $project = $entityManager->getRepository(Laboratorio::class)->find($id);
  
        if (!$project) {
            return $this->json('No project found for id' . $id, 404);
        }
  
        $entityManager->remove($project);
        $entityManager->flush();
  
        return $this->json('Eliminado con id ' . $id);
    }
    /**
     * @Route("/project/eliminar_articulo/{id}", name="project__articulo", methods={"POST"})
     */
    public function deleted_articulo(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $project = $entityManager->getRepository(Articulo::class)->find($id);
  
        if (!$project) {
            return $this->json('No project found for id' . $id, 404);
        }
  
        $entityManager->remove($project);
        $entityManager->flush();
  
        return $this->json('Eliminado con id ' . $id);
    }
}