<?php
namespace Kus;

class DbSessionHandler implements \SessionHandlerInterface{
    
    /**
	 * (PHP 5 &gt;= 5.4.0, PHP 7)<br/>
	 * Initialize session
	 * @link http://php.net/manual/en/sessionhandlerinterface.open.php
	 * @param string $save_path <p>
	 * The path where to store/retrieve the session.
	 * </p>
	 * @param string $name <p>
	 * The session name.
	 * </p>
	 * @return bool The return value (usually <b>TRUE</b> on success, <b>FALSE</b> on failure). Note this value is returned internally to PHP for processing.
	 */
	public function open(string $save_path, string $name) : bool{
            
        }

	/**
	 * (PHP 5 &gt;= 5.4.0, PHP 7)<br/>
	 * Close the session
	 * @link http://php.net/manual/en/sessionhandlerinterface.close.php
	 * @return bool The return value (usually <b>TRUE</b> on success, <b>FALSE</b> on failure). Note this value is returned internally to PHP for processing.
	 */
	public function close(): bool{
            
        }

	/**
	 * (PHP 5 &gt;= 5.4.0, PHP 7)<br/>
	 * Read session data
	 * @link http://php.net/manual/en/sessionhandlerinterface.read.php
	 * @param string $session_id <p>
	 * The session id.
	 * </p>
	 * @return string an encoded string of the read data. If nothing was read, it must return an empty string. Note this value is returned internally to PHP for processing.
	 */
	public function read(string $session_id): string{
            
        }

	/**
	 * (PHP 5 &gt;= 5.4.0, PHP 7)<br/>
	 * Write session data
	 * @link http://php.net/manual/en/sessionhandlerinterface.write.php
	 * @param string $session_id <p>
	 * The session id.
	 * </p>
	 * @param string $session_data <p>
	 * The encoded session data. This data is the result of the PHP internally encoding the $_SESSION superglobal to a serialized
	 * string and passing it as this parameter. Please note sessions use an alternative serialization method.
	 * </p>
	 * @return bool The return value (usually <b>TRUE</b> on success, <b>FALSE</b> on failure). Note this value is returned internally to PHP for processing.
	 */
	public function write(string $session_id, string $session_data): bool{
            
        }

	/**
	 * (PHP 5 &gt;= 5.4.0, PHP 7)<br/>
	 * Destroy a session
	 * @link http://php.net/manual/en/sessionhandlerinterface.destroy.php
	 * @param string $session_id <p>
	 * The session ID being destroyed.
	 * </p>
	 * @return bool The return value (usually <b>TRUE</b> on success, <b>FALSE</b> on failure). Note this value is returned internally to PHP for processing.
	 */
	public function destroy(string $session_id): bool{
            
        }

	/**
	 * (PHP 5 &gt;= 5.4.0, PHP 7)<br/>
	 * Cleanup old sessions
	 * @link http://php.net/manual/en/sessionhandlerinterface.gc.php
	 * @param int $maxlifetime <p>
	 * Sessions that have not updated for the last <i>maxlifetime</i> seconds will be removed.
	 * </p>
	 * @return bool The return value (usually <b>TRUE</b> on success, <b>FALSE</b> on failure). Note this value is returned internally to PHP for processing.
	 */
	public function gc(int $maxlifetime): bool{
            
        }
}

