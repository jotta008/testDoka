<?php

namespace App\Test\Controller;

use App\Entity\Laboratorio;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LaboratorioControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/laboratorio/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Laboratorio::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Laboratorio index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'laboratorio[nombre]' => 'Testing',
            'laboratorio[cuit]' => 'Testing',
            'laboratorio[razonsocial]' => 'Testing',
            'laboratorio[direccion]' => 'Testing',
            'laboratorio[codigo]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Laboratorio();
        $fixture->setNombre('My Title');
        $fixture->setCuit('My Title');
        $fixture->setRazonsocial('My Title');
        $fixture->setDireccion('My Title');
        $fixture->setCodigo('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Laboratorio');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Laboratorio();
        $fixture->setNombre('Value');
        $fixture->setCuit('Value');
        $fixture->setRazonsocial('Value');
        $fixture->setDireccion('Value');
        $fixture->setCodigo('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'laboratorio[nombre]' => 'Something New',
            'laboratorio[cuit]' => 'Something New',
            'laboratorio[razonsocial]' => 'Something New',
            'laboratorio[direccion]' => 'Something New',
            'laboratorio[codigo]' => 'Something New',
        ]);

        self::assertResponseRedirects('/laboratorio/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNombre());
        self::assertSame('Something New', $fixture[0]->getCuit());
        self::assertSame('Something New', $fixture[0]->getRazonsocial());
        self::assertSame('Something New', $fixture[0]->getDireccion());
        self::assertSame('Something New', $fixture[0]->getCodigo());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Laboratorio();
        $fixture->setNombre('Value');
        $fixture->setCuit('Value');
        $fixture->setRazonsocial('Value');
        $fixture->setDireccion('Value');
        $fixture->setCodigo('Value');

        $$this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/laboratorio/');
        self::assertSame(0, $this->repository->count([]));
    }
}
