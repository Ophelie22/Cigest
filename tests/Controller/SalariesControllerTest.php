<?php

namespace App\Test\Controller;

use App\Entity\Salaries;
use App\Repository\SalariesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SalariesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SalariesRepository $repository;
    private string $path = '/salaries/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Salaries::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Salary index');

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
            'salary[nom]' => 'Testing',
            'salary[prenom]' => 'Testing',
            'salary[dateDeNaissance]' => 'Testing',
            'salary[Sexe]' => 'Testing',
            'salary[Adresse]' => 'Testing',
            'salary[codePostal]' => 'Testing',
            'salary[ville]' => 'Testing',
            'salary[courriel]' => 'Testing',
            'salary[fonction]' => 'Testing',
            'salary[dateEntree]' => 'Testing',
            'salary[salaire]' => 'Testing',
            'salary[nombrecongespris]' => 'Testing',
            'salary[nombreCongesRestants]' => 'Testing',
            'salary[cadre]' => 'Testing',
            'salary[datePassageCadre]' => 'Testing',
            'salary[societe]' => 'Testing',
        ]);

        self::assertResponseRedirects('/salaries/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Salaries();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setDateDeNaissance('My Title');
        $fixture->setSexe('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCodePostal('My Title');
        $fixture->setVille('My Title');
        $fixture->setCourriel('My Title');
        $fixture->setFonction('My Title');
        $fixture->setDateEntree('My Title');
        $fixture->setSalaire('My Title');
        $fixture->setNombrecongespris('My Title');
        $fixture->setNombreCongesRestants('My Title');
        $fixture->setCadre('My Title');
        $fixture->setDatePassageCadre('My Title');
        $fixture->setSociete('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Salary');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Salaries();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setDateDeNaissance('My Title');
        $fixture->setSexe('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCodePostal('My Title');
        $fixture->setVille('My Title');
        $fixture->setCourriel('My Title');
        $fixture->setFonction('My Title');
        $fixture->setDateEntree('My Title');
        $fixture->setSalaire('My Title');
        $fixture->setNombrecongespris('My Title');
        $fixture->setNombreCongesRestants('My Title');
        $fixture->setCadre('My Title');
        $fixture->setDatePassageCadre('My Title');
        $fixture->setSociete('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'salary[nom]' => 'Something New',
            'salary[prenom]' => 'Something New',
            'salary[dateDeNaissance]' => 'Something New',
            'salary[Sexe]' => 'Something New',
            'salary[Adresse]' => 'Something New',
            'salary[codePostal]' => 'Something New',
            'salary[ville]' => 'Something New',
            'salary[courriel]' => 'Something New',
            'salary[fonction]' => 'Something New',
            'salary[dateEntree]' => 'Something New',
            'salary[salaire]' => 'Something New',
            'salary[nombrecongespris]' => 'Something New',
            'salary[nombreCongesRestants]' => 'Something New',
            'salary[cadre]' => 'Something New',
            'salary[datePassageCadre]' => 'Something New',
            'salary[societe]' => 'Something New',
        ]);

        self::assertResponseRedirects('/salaries/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getDateDeNaissance());
        self::assertSame('Something New', $fixture[0]->getSexe());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getCodePostal());
        self::assertSame('Something New', $fixture[0]->getVille());
        self::assertSame('Something New', $fixture[0]->getCourriel());
        self::assertSame('Something New', $fixture[0]->getFonction());
        self::assertSame('Something New', $fixture[0]->getDateEntree());
        self::assertSame('Something New', $fixture[0]->getSalaire());
        self::assertSame('Something New', $fixture[0]->getNombrecongespris());
        self::assertSame('Something New', $fixture[0]->getNombreCongesRestants());
        self::assertSame('Something New', $fixture[0]->getCadre());
        self::assertSame('Something New', $fixture[0]->getDatePassageCadre());
        self::assertSame('Something New', $fixture[0]->getSociete());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Salaries();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setDateDeNaissance('My Title');
        $fixture->setSexe('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setCodePostal('My Title');
        $fixture->setVille('My Title');
        $fixture->setCourriel('My Title');
        $fixture->setFonction('My Title');
        $fixture->setDateEntree('My Title');
        $fixture->setSalaire('My Title');
        $fixture->setNombrecongespris('My Title');
        $fixture->setNombreCongesRestants('My Title');
        $fixture->setCadre('My Title');
        $fixture->setDatePassageCadre('My Title');
        $fixture->setSociete('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/salaries/');
    }
}
