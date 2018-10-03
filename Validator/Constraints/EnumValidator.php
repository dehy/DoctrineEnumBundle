<?php
/*
 * This file is part of the FreshDoctrineEnumBundle
 *
 * (c) Artem Henvald <genvaldartem@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fresh\DoctrineEnumBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\ChoiceValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * EnumValidator validates that the value is one of the expected values.
 *
 * @author Artem Henvald <genvaldartem@gmail.com>
 */
class EnumValidator extends ChoiceValidator
{
    /**
     * @param mixed      $value
     * @param Constraint $constraint
     *
     * @throws ConstraintDefinitionException
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint->entity) {
            throw new ConstraintDefinitionException('Entity not specified.');
        }

        $entity = $constraint->entity;
        $constraint->choices = $entity::getValues();

        if ($value !== null && is_int(current($constraint->choices))) {
            $value = intval($value);
        }

        parent::validate($value, $constraint);
    }
}
