<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftRepositoryTrait
{
    use ZapCraftHelperTrait;

    // generate model
    public function craftRepository(string $name, string $module): array
    {
        $placeholders = [
            '{{ namespace }}' => $this->getNamespace($name, 'repository', $module),
            '{{ class }}' => $this->getEntityname($name),
            '{{ classLower }}' => $this->getClassLower($this->getEntityname($name)),
            '{{ subFolderNamespace }}' => $this->getSubNameSpaceToImport($name),
            '{{ module }}' => $module,
        ];
        $stub = $this->getStub($name, 'repository', $module);
        $path = $this->getDestination($name, 'repository', $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfFileExist($path)) {
            return [
                'status' => 'error',
                'message' => 'Repository already exist at: '.$path,
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Repository created at: '.$path,
            ];
        }
    }
}
