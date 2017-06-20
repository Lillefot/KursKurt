<?PHP
	function sendMessage(){
		//Dev
		$date = date();

    $category = 'KurtLecture';

    $title = array(
      "en" => 'Behandlades målen adekvat?'
    );

    $lecture = 'Föreläsningstitel';
    $subtitle = array(
      "en" => $lecture
    );

    $courseGoals = '
    • Förstå hjärtats funktion
    • Redogöra för hjärtats anatomi
    • Dricka kaffe
    • Äta macka
    • Somna
    • Kolla Facebook';

    $content = array(
      "en" => 'Följande kursmål ska ha tagits upp:' . $courseGoals
      );

		$fields = array(
			'app_id' => "88aaa3f2-e759-4311-b1fd-d706b1d18335",
			'included_segments' => array('All'),
      'send_after' => $date,
			'content_available' => true,
      //'template_id' => '576a00f4-2d3b-4441-a9fb-3e4dcea9f962'
      'ios_category' => $category,
      'ios_badgeType' => 'None',
      'headings' => $title,
      'subtitle' => $subtitle,
      'contents' => $content
		);

		$fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic OTViNGEyM2ItNWRkMC00MmMzLTk2OWMtNzFmZjc1ODgwYmY5'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);

  print("\n\nJSON received:\n");
	print($return);
  print("\n");
?>
