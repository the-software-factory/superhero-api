<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Model\Superhero;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SuperheroNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     * @param Superhero $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'realName' => $object->getRealName(),
            'location' => $object->getLocation(),
            'hasCloak' => $object->hasCloak(),
            'picture' => $object->getPicture(),
            'birthDate' => $object->getBirthDate()->format('Y-m-d'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Superhero;
    }
}
