<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace MediaWiki\User;

use IDBAccessObject;
use InvalidArgumentException;

/**
 * Service for looking up UserIdentity
 *
 * @package MediaWiki\User
 * @since 1.36
 */
interface UserIdentityLookup extends IDBAccessObject {

	/**
	 * Find an identity of a user by $name
	 *
	 * @param string $name
	 * @param int $queryFlags one of IDBAccessObject constants
	 * @return UserIdentity|null
	 * @throws InvalidArgumentException if non-normalizable actor name is passed.
	 */
	public function getUserIdentityByName(
		string $name,
		int $queryFlags = self::READ_NORMAL
	): ?UserIdentity;

	/**
	 * Find an identity of a user by $userId
	 *
	 * @param int $userId
	 * @param int $queryFlags one of IDBAccessObject constants
	 * @return UserIdentity|null
	 */
	public function getUserIdentityByUserId(
		int $userId,
		int $queryFlags = self::READ_NORMAL
	): ?UserIdentity;

	/**
	 * Find an identity of a user by $userId or by $name in this order.
	 *
	 * @note calling this method is different from instantiating a new UserIdentity
	 * implementation since the returned actor is guaranteed to exist in the database.
	 *
	 * @param int|null $userId
	 * @param string|null $name
	 * @param int $queryFlags one of IDBAccessObject constants
	 * @return UserIdentity|null
	 */
	public function getUserIdentityByAnyId(
		?int $userId,
		?string $name,
		int $queryFlags = self::READ_NORMAL
	): ?UserIdentity;
}
