<?php

/*
 * This file is part of the Docs Builder package.
 *
 * (c) Ryan Weaver <ryan@symfonycasts.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SymfonyTools\GuidesExtension\Build;

use phpDocumentor\Guides\Nodes\ProjectNode;

final class BuildConfig
{
    private const SYMFONY_REPOSITORY_URL = 'https://github.com/symfony/symfony/blob/{symfonyVersion}/src/%s';

    private string $format = 'html';
    private string $defaultHighlightLanguage = 'php';

    public function __construct(
        private string $symfonyVersion = '6.1',
    ) {
    }

    public function setSymfonyVersion(string $symfonyVersion): void
    {
        $this->symfonyVersion = $symfonyVersion;
    }

    public function getSymfonyVersion(): string
    {
        return $this->symfonyVersion;
    }

    public function getSymfonyRepositoryUrl(): string
    {
        return str_replace('{symfonyVersion}', $this->getSymfonyVersion(), self::SYMFONY_REPOSITORY_URL);
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getDefaultHighlightLanguage(): string
    {
        return $this->defaultHighlightLanguage;
    }

    public function createProjectNode(): ProjectNode
    {
        return new ProjectNode('Symfony', $this->symfonyVersion);
    }
}
