<?php
/**
 * @package    at.pro
 * @author     Adrian <adrian@enspi.red>
 * @copyright  2014 - 2016
 * @license    GPL-3.0 (only)
 *
 *  This program is free software: you can redistribute it and/or modify it
 *  under the terms of the GNU General Public License, version 3.
 *  The right to apply the terms of later versions of the GPL is RESERVED.
 *
 *  This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 *  without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *  See the GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License along with this program.
 *  If not, see <http://www.gnu.org/licenses/gpl-3.0.txt>.
 */
declare(strict_types = 1);

namespace at\PRO;

use at\exceptable\Exception as Exceptable;

class RegexException extends Exceptable {

  /** @type int  invalid PRO fqcn. */
  const INVALID_PRO_FQCN = 1;

  /** @type int  invalid regular expression. */
  const INVALID_REGULAR_EXPRESSION = 2;

  /** {@inheritDoc} @see Exceptable::INFO */
  const INFO = [
    self::INVALID_PRO_FQCN => [
      'message' => 'invalid PRO classname',
      'tr_message' => 'class "{fqcn}" was not found, or does not implement the PRO interface',
      'severity' => Exceptable::WARNING
    ],
    self::INVALID_REGULAR_EXPRESSION => [
      'message' => 'invalid regular expression',
      'tr_message' => '"{regex}" is not a valid regular expression: {error}',
      'severity' => Exceptable::WARNING
    ]
  ];
}
