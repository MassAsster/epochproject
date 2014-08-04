<?php
/**
 * EMAIL
 *
 * Simple email class that allows the sending of
 * html email templates.
 *
 */
class Email {
	/**
	 * Who is the email being sent to?
	 * @var string
	 */
	public static $to = 'John Cross <john@anarctic.com>';
	/**
	 * Whos is the email from?
	 * @var string
	 */
	public static $from = 'John Doe <john.doe@example.com>';
	/**
	 * What is the subject of the email?
	 * @var string
	 */
	public static $subject = 'A Generic Subject Title';
	/**
	 * Whats the message of the email?
	 * @var string
	 */
	public static $message;

	public static function to($to) {
		self::$to = $to;
	}

	public static function from($from) {
		self::$from = $from;
	}

	public static function subject($subject) {
		self::$subject = $subject;
	}

	public static function message($message) {
		self::$message = $message;
	}

	public static function template($file, $data) {
		$data['subject'] = self::$subject; // Set the subject here.
		if ( file_exists( $file ) ) {
			$contents = file_get_contents( $file );
			foreach ( $data as $key => $value ) {
				$contents = preg_replace("/{{{$key}}}/", $value, $contents);
			}
			self::$message = $contents;
		}
	}

	public static function send() {
		$headers = 'MIME-Version: 1.0' . "\r\n" .
				'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
				'From:' . self::$from . "\r\n" .
				'Reply-To:' . self::$from . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		if ( mail( self::$to, self::$subject, self::$message, $headers ) )
			return true;
		else
			return false;
	}
}