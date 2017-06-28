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

use at\PRO\PRO;

class PCRE implements PRO {

  /** @type string  PHP-flavored Perl-Compatible Regular Expression. */
  const TYPE = 'PCRE';

  /** @type string  the regular expression, sans delimiters + modifiers. */
  protected $_pattern;

  /** @type string  modifiers for the regular expression. */
  protected $_modifiers;

  /**
   * {@inheritDoc}
   * @see PRO::fromString()
   */
  public static function fromString(string $pattern) : PRO {
    if (@preg_match($pattern, '') === -1) {
      throw new RegexException(
        RegexException::INVALID_REGULAR_EXPRESSION,
        ['regex' => $pattern, 'error' => substr(error_get_last()['message'], 14)]
      );
    }

    switch ($pattern[0]) {
      case '(' :
        $delimiter = strrpos($pattern, ')');
        break;
      case '{':
        $delimiter = strrpos($pattern, '}');
        break;
      case '[':
        $delimiter = strrpos($pattern, ']');
        break;
      case '<':
        $delimiter = strrpos($pattern, '>');
        break;
      default:
        $delimiter = strrpos($pattern, $pattern[0]);
        break;
    }

    $PCRE = new self('');
    $PCRE->_pattern = substr($pattern, 1, $delimiter - 1);
    $PCRE->_modifiers = substr($pattern, $delimiter + 1);

    return $PCRE;
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
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::quote()
   */
  public static function quote(string $literal) : string {
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::__construct()
   */
  public function __construct(
    string $pattern,
    int $modifiers = 0,
    int $defaultFlags = PRO::DEFAULT_FLAGS
  ) {
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::__toString()
   */
  public function __toString() {
    // @todo
  }


  /**
   * {@inheritDoc}
   * @see PRO::getModifiers()
   */
  public function getModifiers() : array {
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::getPattern()
   */
  public function getPattern() : string {
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::getType()
   */
  public function getType() : string {
    return self::TYPE;
  }

  /**
   * {@inheritDoc}
   * @see PRO::grep()
   */
  public function grep(array $subjects, int $flags = 0) : array {
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::grepReplace()
   */
  public function grepReplace(array $subjects, $replacement, int $limit = null) : array {
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::match()
   */
  public function match(string $subject, int $flags = 0) : array {
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::matches()
   */
  public function matches(string $subject, int $flags = 0) : bool {
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::replace()
   */
  public function replace(string $subject, $replace, int $limit = null) : string {
    // @todo
  }

  /**
   * {@inheritDoc}
   * @see PRO::split()
   */
  public function split(string $subject, int $flags = 0, int $limit = null) : array {
    // @todo
  }
}
