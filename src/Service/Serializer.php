<?php


namespace App\Service;


use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

class Serializer
{
    public function toJSON($data, $groups = ["Default"]):string{
        $builder = SerializerBuilder::create();
        $namingStrategy = new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy());
        $builder->setPropertyNamingStrategy($namingStrategy);
        $serializer = $builder->build();
        $context = SerializationContext::create()->enableMaxDepthChecks();
        $json = null;
        if($context instanceof SerializationContext){
            $context->setSerializeNull(true);
            $context->setGroups($groups);
            $json = $serializer->serialize($data, 'json', $context);
        }
        return $json;
    }
}
