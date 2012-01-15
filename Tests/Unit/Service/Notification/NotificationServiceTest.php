<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Tymoteusz Motylewski <t.motylewski@gmail.com>
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 * Test for the notification service
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Tymoteusz Motylewski <t.motylewski@gmail.com>
 */
class Tx_Community_Tests_Service_Notification_NotificationServiceTest extends Tx_Extbase_Tests_Unit_BaseTestCase {


	protected $service;

	public function setUp() {
		$this->service = new Tx_Community_Service_Notification_NotificationService();
	}

	/**
	 * @test
	 * @dataProvider isValidNotificationProvider
	 * @param Tx_Community_Service_Notification_Notification $notification
	 * @param array $configuration
	 * @param boolean $result
	 */
	public function isValidNotificationTest(Tx_Community_Service_Notification_Notification $notification, array $configuration, $result) {
		/* we are going to test protected method, so we have to use reflection (requires PHP 5.3)*/
		$reflection = new ReflectionClass('Tx_Community_Service_Notification_NotificationService');
		$method = $reflection->getMethod('isValidNotification');
		$method->setAccessible(true);

		$this->assertEquals($result, $method->invokeArgs($this->service, array($notification, $configuration)));
	}

	public function isValidNotificationProvider() {
		$user1 = $this->getAccessibleMock('Tx_Community_Domain_Model_User', array('getUid'));
		$user1->_set('uid', 1);
		$user2 = $this->getAccessibleMock('Tx_Community_Domain_Model_User', array('getUid'));
		$user2->_set('uid', 8);

		$correctNotification = new Tx_Community_Service_Notification_Notification("someRule", $user1, $user2);
		$wrongNotification = new Tx_Community_Service_Notification_Notification("someRule", $user1, $user1);
		$wrongNotification2 = new Tx_Community_Service_Notification_Notification("someRule", $user1, NULL);

		$dataSets = array();
		$dataSets[0] = array( //first test case: different users, empty configuration
				$correctNotification,
				array(), //configuration
				true //expected
		);
		$dataSets[1] = array(
				$correctNotification,
				array('allowSelfNotification' => 0),
				true
		);
		$dataSets[2] = array(
				$correctNotification,
				array('allowSelfNotification' => ''),
				true
		);
		$dataSets[3] = array(
				$wrongNotification,
				array('allowSelfNotification' => ''),
				false
		);
		$dataSets[3] = array(
				$wrongNotification,
				array('allowSelfNotification' => 1),
				true
		);
		$dataSets[3] = array(
				$wrongNotification,
				array('allowSelfNotification' => '1'),
				true
		);
		$dataSets[3] = array(
				$wrongNotification,
				array(),
				false
		);
		$dataSets[3] = array(
				$wrongNotification2,
				array(),
				false
		);
		$dataSets[3] = array(
				$wrongNotification2,
				array('allowSelfNotification' => 1),
				false
		);
		return $dataSets;
	}

}