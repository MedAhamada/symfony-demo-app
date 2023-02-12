<?php

namespace App\Tests\Tests;

use App\Services\OrganizationManager;
use PHPUnit\Framework\TestCase;

class OrganizationManagerTest extends TestCase
{
    public function testGetOrganizations()
    {
        $manager  = new OrganizationManager();
        $filePath = __DIR__.'/../fixtures/organizations.yaml';
        $manager->setFilePath($filePath);
        $organizations = $manager->getOrganizations();
        $this->assertIsArray($organizations);
    }

    public function testGetOrganization()
    {
        $manager  = new OrganizationManager();
        $filePath = __DIR__.'/../fixtures/organizations.yaml';
        $manager->setFilePath($filePath);
        $organization = $manager->getOrganization(0);
        $this->assertIsArray($organization);
        $this->assertArrayHasKey('name', $organization);
        $this->assertEquals('Facebook', $organization['name']);
    }
}
