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

interface PRO {

  /**
   * maps multiple patterns and replacements to a subject string.
   *
   * @param array[]  $pairs            {
   *    @type array $... {
   *      @type PRO|string      $0  the pattern to compare against subject strings
   *      @type string|callable $1  the replacement string|template|callback
   *    }
   *  }
   * @param string   $subject          the string to search
   * @param int      $limit            maximum number of replacements per string, per pattern
   *                                   defaults to 1; or unlimited if its /g modifier is set
   * @throws BadFunctionCallException  if a callback throws or does not return a string
   * @return string[]                  list of subject strings, with any replacements performed
   */
  public static function mapReplace(array $pairs, string $subject, int $limit = null) : array;

  /**
   * quotes a string (so each character would be treated as a literal character).
   *
   * @param string $literal  the string to quote
   * @return string          the quoted string
   */
  public static function quote(string $literal) : string;


  /**
   * @param string $pattern            the regular expression, sans delimiters/modifiers
   * @param int    $modifiers          expression modifiers
   * @throws InvalidArgumentException  if pattern compilation fails
   */
  public function __construct(string $pattern, int $modifiers = 0);

  /**
   * gets the pattern as a string.
   *
   * @return string  the pattern
   */
  public function __toString();


  /**
   * gets the modifiers on this pattern.
   *
   * @return string[]  list of regex modifiers
   */
  public function getModifiers() : array;

  /**
   * gets the pattern, sans delimiters and modifiers.
   *
   * @return string  the regular expression
   */
  public function getPattern() : string;

  /**
   * gets the regex type (flavor) of this pattern.
   *
   * @return string  regex identifier (e.g., "pcre")
   */
  public function getType() : string;

  /**
   * finds subject items that match the pattern.
   *
   * @param string[] $subjects         list of strings to search
   * @param int      $flags            PRO::GREP_* flags
   * @throws InvalidArgumentException  if any item in $subjects is not a string
   * @return array                     list of strings that match the pattern
   */
  public function grep(array $subjects, int $flags = 0) : array;

  /**
   * finds and replaces pattern matches in multiple subject strings.
   * note, only matching strings are returned.
   *
   * @param string          $subject   list of strings to search
   * @param string|callable $replace   replacement string|template|callback
   * @param int             $limit     maximum number of replacements to make per string
   *                                   defaults to 1; or unlimited if the /g modifier is set
   * @throws BadFunctionCallException  if a callback throws or does not return a string
   * @return string                    list of subject strings that match the pattern,
   *                                   with any replacements performed
   */
  public function grepReplace(array $subjects, $replacement, int $limit = null) : array;

  /**
   * finds pattern matches in the subject string.
   * note, if you're looking for a match_all method, use the /g modifier.
   *
   * @param string $subject  the string to search
   * @param int    $flags    PRO::MATCH_* flags
   * @return array           a (possibly empty) array of matches
   */
  public function match(string $subject, int $flags = 0) : array;

  /**
   * finds and replaces pattern matches in the subject string.
   *
   * @param string          $subject   the string to search
   * @param string|callable $replace   replacement string|template|callback
   * @param int             $limit     maximum number of replacements to make
   *                                   defaults to 1; or unlimited if the /g modifier is set
   * @throws BadFunctionCallException  if a callback throws or does not return a string
   * @return string                    the subject string, with any replacements performed
   */
  public function replace(string $subject, $replace, int $limit = null) : string;

  /**
   * splits subject string on pattern matches.
   *
   * @param string $subject  the subject string
   * @param int    $flags    PRO::SPLIT_* flags
   * @param int    $limit    maximum number of split strings to return
   *                         if omitted, limited to 2; or unlimited if the /g modifier is set
   * @return array           the split subject string
   */
  public function split(string $subject, int $flags = 0, int $limit = null) : array;
}
