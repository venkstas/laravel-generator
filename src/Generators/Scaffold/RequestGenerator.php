<?php

namespace InfyOm\Generator\Generators\Scaffold;

use InfyOm\Generator\Common\CommandData;
use InfyOm\Generator\Generators\BaseGenerator;
use InfyOm\Generator\Utils\FileUtil;
use App\Models\Permission;

class RequestGenerator extends BaseGenerator
{
    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var string */
    private $readFileName;

    /** @var string */
    private $createFileName;

    /** @var string */
    private $storeFileName;

    /** @var string */
    private $editFileName;

    /** @var string */
    private $updateFileName;

    /** @var string */
    private $deleteFileName;

    public function __construct(CommandData $commandData)
    {
        $this->commandData = $commandData;
        $this->path = $commandData->config->pathRequest;
        $this->readFileName = 'Read' . $this->commandData->modelName . 'Request.php';
        $this->createFileName = 'Create' . $this->commandData->modelName . 'Request.php';
        $this->storeFileName = 'Store' . $this->commandData->modelName . 'Request.php';
        $this->editFileName = 'Edit' . $this->commandData->modelName . 'Request.php';
        $this->updateFileName = 'Update' . $this->commandData->modelName . 'Request.php';
        $this->deleteFileName = 'Delete' . $this->commandData->modelName . 'Request.php';
    }

    public function generate()
    {
        $this->generateReadRequest();
        $this->generateCreateRequest();
        $this->generateStoreRequest();
        $this->generateEditRequest();
        $this->generateUpdateRequest();
        $this->generateDeleteRequest();
        $this->generateLaraTrustPermissions();
    }

    private function generateLaraTrustPermissions()
    {
        $readPermission = Permission::firstOrCreate(
            ['name' => 'read-' . $this->commandData->modelName], ['display_name' => 'Read ' . $this->commandData->modelName], ['description' => 'Read ' . $this->commandData->modelName]
        );
        $createPermission = Permission::firstOrCreate(
            ['name' => 'create-' . $this->commandData->modelName], ['display_name' => 'Create ' . $this->commandData->modelName], ['description' => 'Create ' . $this->commandData->modelName]
        );
        $updatePermission = Permission::firstOrCreate(
            ['name' => 'update-' . $this->commandData->modelName], ['display_name' => 'Update ' . $this->commandData->modelName], ['description' => 'Update ' . $this->commandData->modelName]
        );
        $deletePermission = Permission::firstOrCreate(
            ['name' => 'delete-' . $this->commandData->modelName], ['display_name' => 'Delete ' . $this->commandData->modelName], ['description' => 'Delete ' . $this->commandData->modelName]
        );
    }

    private function generateReadRequest()
    {
        $templateData = get_template('scaffold.request.read_request', 'laravel-generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        FileUtil::createFile($this->path, $this->readFileName, $templateData);

        $this->commandData->commandComment("\nRead Request created: ");
        $this->commandData->commandInfo($this->readFileName);
    }

    private function generateCreateRequest()
    {
        $templateData = get_template('scaffold.request.create_request', 'laravel-generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        FileUtil::createFile($this->path, $this->createFileName, $templateData);

        $this->commandData->commandComment("\nCreate Request created: ");
        $this->commandData->commandInfo($this->createFileName);
    }

    private function generateStoreRequest()
    {
        $templateData = get_template('scaffold.request.store_request', 'laravel-generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        FileUtil::createFile($this->path, $this->storeFileName, $templateData);

        $this->commandData->commandComment("\nStore Request created: ");
        $this->commandData->commandInfo($this->storeFileName);
    }

    private function generateEditRequest()
    {
        $templateData = get_template('scaffold.request.edit_request', 'laravel-generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        FileUtil::createFile($this->path, $this->editFileName, $templateData);

        $this->commandData->commandComment("\nEdit Request created: ");
        $this->commandData->commandInfo($this->editFileName);
    }

    private function generateUpdateRequest()
    {
        $templateData = get_template('scaffold.request.update_request', 'laravel-generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        FileUtil::createFile($this->path, $this->updateFileName, $templateData);

        $this->commandData->commandComment("\nUpdate Request created: ");
        $this->commandData->commandInfo($this->updateFileName);
    }

    private function generateDeleteRequest()
    {
        $templateData = get_template('scaffold.request.delete_request', 'laravel-generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        FileUtil::createFile($this->path, $this->deleteFileName, $templateData);

        $this->commandData->commandComment("\nDelete Request created: ");
        $this->commandData->commandInfo($this->deleteFileName);
    }

    public function rollback()
    {
        if ($this->rollbackFile($this->path, $this->readFileName)) {
            $this->commandData->commandComment('Read API Request file deleted: ' . $this->readFileName);
        }

        if ($this->rollbackFile($this->path, $this->createFileName)) {
            $this->commandData->commandComment('Create API Request file deleted: ' . $this->createFileName);
        }

        if ($this->rollbackFile($this->path, $this->storeFileName)) {
            $this->commandData->commandComment('Store API Request file deleted: ' . $this->storeFileName);
        }

        if ($this->rollbackFile($this->path, $this->editFileName)) {
            $this->commandData->commandComment('Edit API Request file deleted: ' . $this->editFileName);
        }

        if ($this->rollbackFile($this->path, $this->updateFileName)) {
            $this->commandData->commandComment('Update API Request file deleted: ' . $this->updateFileName);
        }

        if ($this->rollbackFile($this->path, $this->deleteFileName)) {
            $this->commandData->commandComment('Delete API Request file deleted: ' . $this->deleteFileName);
        }
    }
}
