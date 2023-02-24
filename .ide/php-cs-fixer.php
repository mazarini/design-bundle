<?php

if (!isset($fileHeaderComment)) {
    $header = <<<COMMENT
        This file is part of mazarini/design-bundle.

        mazarini/design-bundle is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.

        mazarini/design-bundle is distributed in the hope that it will be useful, but
        WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
        or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
        for more details.

        You should have received a copy of the GNU General Public License along
        with mazarini/design-bundle. If not, see <https://www.gnu.org/licenses/>.

        @package mazarini/design-bundle
        COMMENT;
    $fileHeaderComment = ['header' => $header, 'comment_type' => 'PHPDoc'];
}

$projectRoot = __DIR__;

$fixer = (new PhpCsFixer\Config())
    ->setRules([
        '@PHP81Migration' => true,
        '@PSR12' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'protected_to_private' => false,
        'native_constant_invocation' => ['strict' => false],
        'nullable_type_declaration_for_default_null_value' => ['use_nullable_type_declaration' => false],
        'header_comment' => $fileHeaderComment,
        'modernize_strpos' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder(
        (new PhpCsFixer\Finder())
            ->in(__DIR__.'/../src')
            ->in(__DIR__.'/../tests')
    )
    ->setCacheFile(__DIR__.'/../var/cache/php-cs-fixer.cache');

return $fixer;
