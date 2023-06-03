<?php

namespace SymfonyDocsBuilder\TextRole;

use SymfonyDocsBuilder\Build\BuildConfig;
use SymfonyDocsBuilder\Node\ExternalLinkToken;
use phpDocumentor\Guides\Nodes\InlineToken\InlineMarkupToken;
use phpDocumentor\Guides\ParserContext;
use phpDocumentor\Guides\RestructuredText\TextRoles\TextRole;
use function Symfony\Component\String\u;

class MethodRole implements TextRole
{
    public function __construct(
        private BuildConfig $buildConfig
    ) {
    }

    public function processNode(ParserContext $parserContext, string $id, string $role, string $content): InlineMarkupToken
    {
        [$fqcn, $method] = u($content)->replace('\\\\', '\\')->split('::', 2);

        $filename = sprintf('%s.php#:~:text=%s', $fqcn->replace('\\', '/'), rawurlencode('function '.$method));
        $url = sprintf($this->buildConfig->getSymfonyRepositoryUrl(), $filename);

        return new ExternalLinkToken($id, $url, $method.'()', $fqcn.'::'.$method.'()');
    }

    public function getName(): string
    {
        return 'method';
    }

    public function getAliases(): array
    {
        return [];
    }
}