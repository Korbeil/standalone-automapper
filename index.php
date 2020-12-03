<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/dto.php';

use Jane\AutoMapper\AutoMapper;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use Jane\AutoMapper\Loader\FileLoader;
use Jane\AutoMapper\Generator\Generator;
use PhpParser\ParserFactory;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;

$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

$fileLoader = new FileLoader(new Generator(
    (new ParserFactory())->create(ParserFactory::PREFER_PHP7),
    new ClassDiscriminatorFromClassMetadata($classMetadataFactory)
), __DIR__ . '/cache');

$automapper = AutoMapper::create(true, $fileLoader);

dump($automapper->map([
    'name' => 'Grégoire',
    'age' => 34
], \Client::class));
