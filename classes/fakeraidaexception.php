<?php
/**
 * Copyright 2018 CloudCoin 
 *
 * You are hereby granted a non-exclusive, worldwide, royalty-free license to
 * use, copy, modify, and distribute this software in source code or binary
 * form for use in connection with the web services and APIs provided by
 * Facebook.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 */
namespace FakeRAIDA;

class FakeRAIDAException extends \Exception {
	public function __construct($errorMessage, $errorCode = "400") {

		if (is_array($errorMessage)) {
			$data = @json_encode($errorMessage);
			$jsonLastError = json_last_error();
			if ($jsonLastError !== JSON_ERROR_NONE) {
				Logger::error("Failed data: " . print_r($errorMessage, true));
				$errorMessage = "Nested. Failed to encode JSON: " . $jsonLastError;
			} else
				$errorMessage = $data;
		}

		Logger::error("Exception[$errorCode]: $errorMessage");

		parent::__construct($errorMessage, $errorCode);
	}
}
