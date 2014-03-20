<?php
namespace Security;
use Nette;
use Nette\Security\Identity;
use Nette\Object,
	Nette\Environment;
use Nette\Security\AuthenticationException;

class Authenticator extends Nette\Object implements Nette\Security\IAuthenticator {

	/** @var Nette\Database\Context */
	private $database;

	/**
	 * @param Nette\Database\Context
	 */
//	public function __construct(Nette\Database\Context $database)
//	{
//		$this->database = $database;
//	}
	public function __construct()
	{
	}

	/**
	 * Performas an authentication
	 * @param array
	 * @return Nette\Security\Identity
	 */
	public function authenticate(array $credentials) {
		list($login, $password) = $credentials;
//		$row = $this->database->table('user')->where('email', $login)->fetch();
		$row = array('id' => 1, 'email' => 'student', 'role' => 'student');

		if (!$row) {
			throw new AuthenticationException('Zlý login.', self::IDENTITY_NOT_FOUND);
		}
		/*
				if ($row->password !== sha1($password)) {
						throw new AuthenticationException('Zlé heslo.', self::INVALID_CREDENTIAL);
				}
		*/

//		unset($row->password);
//		return new Identity($row->id, $row->role, $row->toArray());
		return new Identity($row['id'], $row['role'], $row);

	}

}