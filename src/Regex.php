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

use at\PRO\ {
    PRO,
    PCRE,
    RegexException
  };

/**
 * base implementation for PHP Regex Objects.
 *
 * provides a unified interface for accessing any PRO implementation.
 * defaults to using the PCRE class.
 */
class Regex implements PRO {

  /** @type string  fqcn for default PRO class to use when none specified. */
  const DEFAULT_PRO_FQCN = PCRE::class;

  /** @type string  default PRO class FQCN. */
  protected static $_defaultPROFQCN = self::DEFAULT_PRO_FQCN;

  /** @type PRO  the actual PRO object this instance operates on. */
  protected $_PRO;

  /**
   * {@inheritDoc}
   * @see PRO::fromString()
   */
  public static function fromString(string $pattern) : PRO {
    $Regex = new self('');
    $PRO = self::getPROClass();
    $Regex->_PRO = $PRO::fromString($pattern);
    return $Regex;
  }

  /**
   * gets the current default PRO class.
   * @see Regex::setPROClass()
   *
   * @return string  fully qualified classname of the default PRO class
   */
  public static function getPROClass() : string {
    return self::$_defaultPROFQCN;
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public static function mapReplace(
    array $patterns_and_replacements,
    string $subject,
    int $limit = null
  ) : array {
    $PRO = self::getPROClass();
    return $PRO::mapReplace($patterns_and_replacements, $subject, $limit);
  }

  /**
   * {@inheritDoc}
   * @see PRO::quote()
   */
  public static function quote(string $literal) : string {
    $PRO = self::getPROClass();
    return $PRO::quote($literal);
  }

  /**
   * sets the default PRO class.
   *
   * this method will affect *all* future calls to static methods, or on construct,
   * which do not specify a PRO class to use.
   *
   * @param string $fqcn     fully qualified PRO classname
   * @throws RegexException  if given classname does not exist, or does not implement PRO
   */
  public static function setPROClass(string $fqcn) {
    if (! is_a($fqcn, PRO::class, true)) {
      throw new RegexException(RegexException::INVALID_PRO_FQCN, ['fqcn' => $fqcn]);
    }

    self::$_defaultPROFQCN = $fqcn;
  }


  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function __construct(
    string $pattern,
    int $modifiers = 0,
    int $defaultFlags = PRO::DEFAULT_FLAGS
  ) {
    $PRO = self::getPROClass();
    $this->_PRO = new $PRO($pattern, $modifiers, $defaultFlags);
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function __toString() {
    return $this->_PRO->__toString();
  }


  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function getModifiers() : array {
    return $this->_PRO->getModifiers();
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function getPattern() : string {
    return $this->_PRO->getPattern();
  }

  /**
   * gets the underlying PRO instance.
   *
   * @return PRO  the PRO instance
   */
  public function getPRO() : PRO {
    return $this->_PRO;
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function getType() : string {
    return $this->_PRO->getType();
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function grep(array $subjects, int $flags = 0) : array {
    return $this->_PRO->grep($subjects, $flags);
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function grepReplace(array $subjects, $replacement, int $limit = null) : array {
    return $this->_PRO->grepReplace($subjects, $replacement, $limit);
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function match(string $subject, int $flags = 0) : array {
    return $this->_PRO->match($subject, $flags);
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function matches(string $subject, int $flags = 0) : bool {
    return $this->_PRO->matches($subject, $flags);
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function replace(string $subject, $replace, int $limit = null) : string {
    return $this->_PRO->replace($subject, $replace, $limit);
  }

  /**
   * {@inheritDoc}
   * @see PRO::mapReplace()
   */
  public function split(string $subject, int $flags = 0, int $limit = null) : array {
    return $this->_PRO->split($subject, $flags, $limit);
  }
}
