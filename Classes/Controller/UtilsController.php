<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Varoius Actions that didn't fit anywhere
 */
class Tx_Community_Controller_UtilsController extends Tx_Community_Controller_BaseController {

	/**
	 * Manages printing messages from 
	 * @return mixed
	 */
	public function flashMessagesDisplayAction() {
		if (Tx_Community_Controller_BaseController::$redirected) {
			return ''; //Dont show messages
		}
	}
}
?>