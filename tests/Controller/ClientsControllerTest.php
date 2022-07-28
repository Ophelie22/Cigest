<?php

namespace App\Test\Controller;

use App\Entity\Clients;
use App\Repository\ClientsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ClientsRepository $repository;
    private string $path = '/clients/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Clients::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Client index');

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
            'client[nom]' => 'Testing',
            'client[prenom]' => 'Testing',
            'client[DatedeNaissance]' => 'Testing',
            'client[adresse]' => 'Testing',
            'client[codepostal]' => 'Testing',
            'client[ville]' => 'Testing',
            'client[FonctionDanslaSté]' => 'Testing',
            'client[Sociéte]' => 'Testing',
            'client[societe]' => 'Testing',
        ]);

        self::assertResponseRedirects('/clients/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Clients();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setDatedeNaissance('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCodepostal('My Title');
        $fixture->setVille('My Title');
        $fixture->setFonctionDanslaSté('My Title');
        $fixture->setSociéte('My Title');
        $fixture->setSociete('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Client');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Clients();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setDatedeNaissance('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCodepostal('My Title');
        $fixture->setVille('My Title');
        $fixture->setFonctionDanslaSté('My Title');
        $fixture->setSociéte('My Title');
        $fixture->setSociete('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'client[nom]' => 'Something New',
            'client[prenom]' => 'Something New',
            'client[DatedeNaissance]' => 'Something New',
            'client[adresse]' => 'Something New',
            'client[codepostal]' => 'Something New',
            'client[ville]' => 'Something New',
            'client[FonctionDanslaSté]' => 'Something New',
            'client[Sociéte]' => 'Something New',
            'client[societe]' => 'Something New',
        ]);

        self::assertResponseRedirects('/clients/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getDatedeNaissance());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getCodepostal());
        self::assertSame('Something New', $fixture[0]->getVille());
        self::assertSame('Something New', $fixture[0]->getFonctionDanslaSté());
        self::assertSame('Something New', $fixture[0]->getSociéte());
        self::assertSame('Something New', $fixture[0]->getSociete());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Clients();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setDatedeNaissance('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCodepostal('My Title');
        $fixture->setVille('My Title');
        $fixture->setFonctionDanslaSté('My Title');
        $fixture->setSociéte('My Title');
        $fixture->setSociete('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/clients/');
    }
}
