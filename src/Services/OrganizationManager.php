<?php

namespace App\Services;

use Symfony\Component\Yaml\Yaml;

class OrganizationManager
{
    protected string $filePath = __DIR__.'/../../data/organizations.yaml';

    public function __construct()
    {
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, Yaml::dump(['organizations' => []]));
        }
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     */
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }


    public function getOrganizations(): array
    {
        return Yaml::parseFile($this->filePath)['organizations'];
    }

    public function getOrganization(int $index): array
    {
        $organizations = $this->getOrganizations();
        return $organizations[$index];
    }

    // Remove organization by index and save to file
    public function removeOrganization(int $index): void
    {
        $organizations = $this->getOrganizations();
        unset($organizations[$index]);
        $yaml = Yaml::dump(compact('organizations'));
        file_put_contents($this->filePath, $yaml);
    }

    // Add organization and save to file
    public function addOrganization(array $organization): void
    {
        $organizations = $this->getOrganizations();
        $organizations[] = $organization;
        $yaml = Yaml::dump(compact('organizations'));
        file_put_contents($this->filePath, $yaml);
    }

    // Edit organization and save to file
    public function editOrganization(int $index, array $organization): void
    {
        $organizations = $this->getOrganizations();
        $organizations[$index] = $organization;
        $yaml = Yaml::dump(compact('organizations'));
        file_put_contents($this->filePath, $yaml);
    }
}
