<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait ZapCraftHelperTrait
{
    public function __construct(
        protected Filesystem $files
    ) {
    }

    public function getClassName(string $name, string $element, string $module): ?string
    {
        $entity = $this->getEntityName($name);
        $sub = $this->getSubFolder($name);

        $subnamespace = null;
        if ($sub) {
            $subnamespace = '/'.$sub;
        }
        switch ($element) {
            case 'model':
                $class = $entity;
                break;
            case 'controller':
                $class = $entity.'Controllers';
                break;
            case 'read-interface':
                $class = 'Read'.$entity.'Interface';
                break;
            case 'write-interface':
                $class = 'Write'.$entity.'Interface';
                break;
            case 'repository':
                $class = $entity.'Repository';
                break;
            case 'service':
                $class = $entity.'Service';
                break;
            case 'dto':
                $class = 'Create'.$entity.'DTO';
                break;
            case 'readOne-request':
                $class = 'ReadOne'.$entity.'Request';
                break;
            case 'readMany-request':
                $class = 'ReadMany'.$entity.'Request';
                break;
            case 'create-request':
                $class = 'Create'.$entity.'Request';
                break;
            case 'update-request':
                $class = 'Update'.$entity.'Request';
                break;
            case 'delete-request':
                $class = 'Delete'.$entity.'Request';
                break;
            case 'resource':
                $class = $entity.'Resource';
                break;
            case 'collection':
                $class = $entity.'Collection';
                break;
        }

        return $class;
    }

    public function getNameSpace(string $name, string $element, string $module): ?string
    {
        $entity = $this->getEntityName($name);
        $sub = $this->getSubNameSpaces($name);

        $subnamespace = null;
        if ($sub) {
            $subnamespace = '\\'.$sub;
        }

        $namespace = 'Modules\\'.$module.$subnamespace.'\\'.$entity;
        switch ($element) {
            case 'model':
                $namespace = 'Modules'.'\\'.$module.'\\app\\Models';
                break;
            case 'controller':
                $namespace = 'Modules'.'\\'.$module.'\\app\\Http\\Controllers'.$subnamespace;
                break;
            case 'read-interface':
                $namespace = 'Modules'.'\\'.$module.'\\Interfaces'.$subnamespace.'\\'.$entity;
                break;
            case 'write-interface':
                $namespace = 'Modules'.'\\'.$module.'\\Interfaces'.$subnamespace.'\\'.$entity;
                break;
            case 'repository':
                $namespace = 'Modules'.'\\'.$module.'\\Repositories'.$subnamespace;
                break;
            case 'service':
                $namespace = 'Modules'.'\\'.$module.'\\Services'.$subnamespace;
                break;
            case 'dto':
                $namespace = 'Modules'.'\\'.$module.'\\DTO'.$subnamespace;
                break;
            case 'readOne-request':
                $namespace = 'Modules'.'\\'.$module.'\\app\\Http\\Requests'.$subnamespace.'\\'.$entity;
                break;
            case 'readMany-request':
                $namespace = 'Modules'.'\\'.$module.'\\app\\Http\\Requests'.$subnamespace.'\\'.$entity;
                break;
            case 'create-request':
                $namespace = 'Modules'.'\\'.$module.'\\app\\Http\\Requests'.$subnamespace.'\\'.$entity;
                break;
            case 'update-request':
                $namespace = 'Modules'.'\\'.$module.'\\app\\Http\\Requests'.$subnamespace.'\\'.$entity;
                break;
            case 'delete-request':
                $namespace = 'Modules'.'\\'.$module.'\\app\\Http\\Requests'.$subnamespace.'\\'.$entity;
                break;
            case 'resource':
                $namespace = 'Modules'.'\\'.$module.'\\app\\Resources'.$subnamespace.'\\'.$entity;
                break;
            case 'collection':
                $namespace = 'Modules'.'\\'.$module.'\\app\\Resources'.$subnamespace.'\\'.$entity;
                break;
        }

        return $namespace;
    }

    /**
     * Get the destination for the new file
     */
    public function getDestination(string $name, string $element, string $module): ?string
    {
        $entity = $this->getEntityName($name);
        $classLower = $this->getClassLower($name);
        $sub = $this->getSubFolder($name);

        $subFolder = null;
        if ($sub) {
            $subFolder = $sub.'/';
        }

        switch ($element) {
            case 'model':
                $class = base_path()."/Modules/{$module}/app/Models/{$entity}.php";
                break;
            case 'migration':
                $table_name = $this->getTableName($name);
                $timestamp = now()->format('Y_m_d_His');
                $class = base_path()."/Modules/{$module}/database/migrations/{$timestamp}_create_{$table_name}_table.php";
                break;
            case 'controller':
                $class = base_path()."/Modules/{$module}/app/Http/Controllers/{$subFolder}{$entity}Controller.php";
                break;
            case 'read-interface':
                $class = base_path()."/Modules/{$module}/Interfaces/{$subFolder}{$entity}/Read{$entity}RepositoryInterface.php";
                break;
            case 'write-interface':
                $class = base_path()."/Modules/{$module}/Interfaces/{$subFolder}{$entity}/Write{$entity}RepositoryInterface.php";
                break;
            case 'repository':
                $class = base_path()."/Modules/{$module}/Repositories/{$subFolder}{$entity}Repository.php";
                break;
            case 'service':
                $class = base_path()."/Modules/{$module}/Services/{$subFolder}{$entity}Service.php";
                break;
            case 'dto':
                $class = base_path()."/Modules/{$module}/DTO/{$subFolder}{$entity}DTO.php";
                break;
            case 'readOne-request':
                $class = base_path()."/Modules/{$module}/app/Http/Requests/{$subFolder}{$entity}/ReadOne{$entity}Request.php";
                break;
            case 'readMany-request':
                $class = base_path()."/Modules/{$module}/app/Http/Requests/{$subFolder}{$entity}/ReadMany{$entity}Request.php";
                break;
            case 'create-request':
                $class = base_path()."/Modules/{$module}/app/Http/Requests/{$subFolder}{$entity}/Create{$entity}Request.php";
                break;
            case 'update-request':
                $class = base_path()."/Modules/{$module}/app/Http/Requests/{$subFolder}{$entity}/Update{$entity}Request.php";
                break;
            case 'delete-request':
                $class = base_path()."/Modules/{$module}/app/Http/Requests/{$subFolder}{$entity}/Delete{$entity}Request.php";
                break;
            case 'resource':
                $class = base_path()."/Modules/{$module}/app/Resources/{$subFolder}{$entity}/{$entity}Resource.php";
                break;
            case 'collection':
                $class = base_path()."/Modules/{$module}/app/Resources/{$subFolder}{$entity}/{$entity}Collection.php";
                break;
            case 'route':
                $class = base_path()."/Modules/{$module}/routes/api/{$classLower}.php";
                break;
        }

        return $class;
    }

    /**
     * Get stub files to new files
     */
    public function getStub(string $name, string $element): ?string
    {
        $entity = $this->getEntityName($name);
        $sub = $this->getSubFolder($name);

        $subFolder = null;
        if ($sub) {
            $subFolder = $sub.'/';
        }

        switch ($element) {
            case 'model':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/model.stub';
                break;
            case 'migration':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/migration.stub';
                break;
            case 'controller':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/controller.stub';
                break;
            case 'read-interface':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/read-interface.stub';
                break;
            case 'write-interface':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/write-interface.stub';
                break;
            case 'repository':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/repository.stub';
                break;
            case 'service':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/service.stub';
                break;
            case 'dto':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/dto.stub';
                break;
            case 'readOne-request':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/request.stub';
                break;
            case 'readMany-request':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/request.stub';
                break;
            case 'create-request':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/request.stub';
                break;
            case 'update-request':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/request.stub';
                break;
            case 'delete-request':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/request.stub';
                break;
            case 'resource':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/resource.stub';
                break;
            case 'collection':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/collection.stub';
                break;
            case 'route':
                $path = base_path().'/vendor/holdmyglass/zapCraft/stubs/route.stub';
                break;
        }

        return $path;
    }

    /**
     * get the lower name of the entity
     * used for variable names
     */
    private function getEntityLower(string $name): ?string
    {
        $parts = explode('/', $name);

        return Str::lower(end($parts));
    }

    /**
     * Get the name of the Entity for classname.
     */
    private function getEntityName(string $name): string
    {
        $parts = explode('/', $name);
        $class = end($parts);
        $upper = ucwords($class);

        return str_replace(' ', '', $upper);
    }

    /**
     * Get subfolders for namespace if there is any
     */
    private function getSubNameSpaces(string $name): ?string
    {
        if (strpos($name, '/') !== false) {

            // Explode the string using "/" and remove the last element
            $subfolders = explode('/', $name);
            array_pop($subfolders);

            // Join the remaining elements to get the subfolders
            $result = implode('\\', $subfolders);

            // Remove leading and trailing slashes
            $result = trim($result, '/');

            return $result;
        } else {
            // Return null if the input string doesn't contain "/"
            return null;
        }
    }

    /**
     * Get subfolders for namespace if there is any
     */
    private function getSubNameSpaceToImport(string $name): ?string
    {
        if (strpos($name, '/') !== false) {

            // Explode the string using "/" and remove the last element
            $subfolders = explode('/', $name);
            array_pop($subfolders);

            // Join the remaining elements to get the subfolders
            $result = implode('\\', $subfolders);

            // Remove leading and trailing slashes
            $result = trim($result, '/');

            return '\\'.$result;
        } else {
            // Return null if the input string doesn't contain "/"
            return null;
        }
    }

    /**
     * Get subfolders location
     */
    private function getSubFolder(string $name): ?string
    {
        if (strpos($name, '/') !== false) {

            // Explode the string using "/" and remove the last element
            $subfolders = explode('/', $name);
            array_pop($subfolders);

            // Join the remaining elements to get the subfolders
            $result = implode('/', $subfolders);

            // Remove leading and trailing slashes
            $result = trim($result, '/');
            $result = trim($result, '/');

            return $result;
        } else {
            // Return null if the input string doesn't contain "/"
            return null;
        }
    }

    private function makeDirectory(string $path): string
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    private function generateFromStub(string $stub, string $path, array $placeholders = []): bool
    {
        $content = File::get($stub);
        foreach ($placeholders as $placeholder => $replacement) {
            $content = str_replace($placeholder, $replacement, $content);
        }

        return File::put($path, $content);
    }

    private function checkIfFileExist(string $path): bool
    {
        if (file_exists($path)) {
            return true;
        }

        return false;
    }

    private function getTableName(string $name): string
    {
        $name = $this->getEntityName($name);

        return Str::plural(Str::snake($name));
    }

    private function checkIfMigrationExist(string $path): bool
    {
        $migrationPath = dirname($path);
        $file = basename($path);
        $migrationFiles = File::files($migrationPath);
        $expectedBasename = $this->getExpecteMigrationdBasename($file);
        foreach ($migrationFiles as $migrationFile) {
            if ($this->getExpecteMigrationdBasename(basename($migrationFile)) === $expectedBasename) {
                return true;
            }
        }

        return false;
    }

    protected function getExpecteMigrationdBasename($filename): string
    {
        preg_match('/^\d{4}_\d{2}_\d{2}_\d{6}_(.*)$/', $filename, $matches);

        if (isset($matches[1])) {
            return $matches[1];
        }

        return $filename;
    }

    public function getClassLower(string $input)
    {
        $words = preg_split('/(?<=\w)(?=[A-Z])/', $input);

        foreach ($words as $key => $word) {
            $words[$key] = ($key === 0) ? strtolower($word) : ucfirst(strtolower($word));
        }

        return implode('', $words);
    }
}
