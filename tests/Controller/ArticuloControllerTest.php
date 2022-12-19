<?php

namespace App\Test\Controller;

use App\Entity\Articulo;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticuloControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/articulo/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Articulo::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Articulo index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'articulo[nombre]' => 'Testing',
            'articulo[gtin]' => 'Testing',
            'articulo[codigointerno]' => 'Testing',
            'articulo[fraccionable]' => 'Testing',
            'articulo[unidaddefraccion]' => 'Testing',
            'articulo[precioventa]' => 'Testing',
            'articulo[preciocompra]' => 'Testing',
            'articulo[idalmacen]' => 'Testing',
            'articulo[idlaboratorio]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Articulo();
        $fixture->setNombre('My Title');
        $fixture->setGtin('My Title');
        $fixture->setCodigointerno('My Title');
        $fixture->setFraccionable('My Title');
        $fixture->setUnidaddefraccion('My Title');
        $fixture->setPrecioventa('My Title');
        $fixture->setPreciocompra('My Title');
        $fixture->setIdalmacen('My Title');
        $fixture->setIdlaboratorio('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Articulo');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Articulo();
        $fixture->setNombre('Value');
        $fixture->setGtin('Value');
        $fixture->setCodigointerno('Value');
        $fixture->setFraccionable('Value');
        $fixture->setUnidaddefraccion('Value');
        $fixture->setPrecioventa('Value');
        $fixture->setPreciocompra('Value');
        $fixture->setIdalmacen('Value');
        $fixture->setIdlaboratorio('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'articulo[nombre]' => 'Something New',
            'articulo[gtin]' => 'Something New',
            'articulo[codigointerno]' => 'Something New',
            'articulo[fraccionable]' => 'Something New',
            'articulo[unidaddefraccion]' => 'Something New',
            'articulo[precioventa]' => 'Something New',
            'articulo[preciocompra]' => 'Something New',
            'articulo[idalmacen]' => 'Something New',
            'articulo[idlaboratorio]' => 'Something New',
        ]);

        self::assertResponseRedirects('/articulo/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNombre());
        self::assertSame('Something New', $fixture[0]->getGtin());
        self::assertSame('Something New', $fixture[0]->getCodigointerno());
        self::assertSame('Something New', $fixture[0]->getFraccionable());
        self::assertSame('Something New', $fixture[0]->getUnidaddefraccion());
        self::assertSame('Something New', $fixture[0]->getPrecioventa());
        self::assertSame('Something New', $fixture[0]->getPreciocompra());
        self::assertSame('Something New', $fixture[0]->getIdalmacen());
        self::assertSame('Something New', $fixture[0]->getIdlaboratorio());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Articulo();
        $fixture->setNombre('Value');
        $fixture->setGtin('Value');
        $fixture->setCodigointerno('Value');
        $fixture->setFraccionable('Value');
        $fixture->setUnidaddefraccion('Value');
        $fixture->setPrecioventa('Value');
        $fixture->setPreciocompra('Value');
        $fixture->setIdalmacen('Value');
        $fixture->setIdlaboratorio('Value');

        $$this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/articulo/');
        self::assertSame(0, $this->repository->count([]));
    }
}
