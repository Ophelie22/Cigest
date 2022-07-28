<?php

namespace App\Test\Controller;

use App\Entity\Societe;
use App\Repository\SocieteRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SocieteControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SocieteRepository $repository;
    private string $path = '/societe/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Societe::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Societe index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'societe[nomste]' => 'Testing',
            'societe[adresse]' => 'Testing',
            'societe[codepostal]' => 'Testing',
            'societe[ville]' => 'Testing',
            'societe[siteweb]' => 'Testing',
        ]);

        self::assertResponseRedirects('/societe/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Societe();
        $fixture->setNomste('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCodepostal('My Title');
        $fixture->setVille('My Title');
        $fixture->setSiteweb('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Societe');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Societe();
        $fixture->setNomste('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCodepostal('My Title');
        $fixture->setVille('My Title');
        $fixture->setSiteweb('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'societe[nomste]' => 'Something New',
            'societe[adresse]' => 'Something New',
            'societe[codepostal]' => 'Something New',
            'societe[ville]' => 'Something New',
            'societe[siteweb]' => 'Something New',
        ]);

        self::assertResponseRedirects('/societe/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNomste());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getCodepostal());
        self::assertSame('Something New', $fixture[0]->getVille());
        self::assertSame('Something New', $fixture[0]->getSiteweb());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Societe();
        $fixture->setNomste('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCodepostal('My Title');
        $fixture->setVille('My Title');
        $fixture->setSiteweb('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/societe/');
    }
}
