<?php

declare(strict_types=1);

namespace Sulao\CraftFtp;

use Craft;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\flysystem\base\FlysystemFs;
use craft\helpers\App;
use craft\helpers\Assets;
use League\Flysystem\Config;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\Ftp\FtpAdapter;
use League\Flysystem\Ftp\FtpConnectionOptions;

class Fs extends FlysystemFs
{
    public string  $host = '';
    public int     $port = 21;
    public string  $username = '';
    public string  $password = '';
    public string  $root = '';

    public static function displayName(): string
    {
        return 'FTP';
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['parser'] = [
            'class'      => EnvAttributeParserBehavior::class,
            'attributes' => ['host', 'port', 'username', 'password', 'root'],
        ];

        return $behaviors;
    }

    public function getSettingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate('craft-ftp/fsSettings', [
            'fs'      => $this,
            'periods' => array_merge(['' => ''], Assets::periodList()),
        ]);
    }

    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            [['host', 'username', 'password'], 'required'],
        ]);
    }

    protected function createAdapter(): FilesystemAdapter
    {
        return new FtpAdapter(
            FtpConnectionOptions::fromArray([
                'host'     => App::parseEnv($this->host),
                'port'     => (int)App::parseEnv((string)$this->port),
                'username' => App::parseEnv($this->username),
                'password' => App::parseEnv($this->password),
                'root'     => App::parseEnv($this->root),
            ])
        );
    }

    protected function addFileMetadataToConfig(array $config): array
    {
        return array_merge(
            parent::addFileMetadataToConfig($config),
            [Config::OPTION_DIRECTORY_VISIBILITY => $this->visibility()]
        );
    }

    protected function invalidateCdnPath(string $path): bool
    {
        return true;
    }
}
