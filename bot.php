<?php echo "I am a bot";


{  "events": [      {        "replyToken": "nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",        "type": "message",        "timestamp": 1462629479859,        "source": {             "type": "user",             "userId": "U206d25c2ea6bd87c17655609a1c37cb8"         },         "message": {             "id": "325708",             "type": "text",             "text": "Hello, world"          }      }  ]}


curl -X POST \-H 'Content-Type:application/json' \-H 'Authorization: Bearer {ENTER_ACCESS_TOKEN}' \-d '{    "replyToken":"nHuyWiB7yP5Zw52FIkcQobQuGDXCTA",    "messages":[        {            "type":"text",            "text":"Hello, user"        },        {            "type":"text",            "text":"May I help you?"        }    ]}' https://api.line.me/v2/bot/message/reply


<?php$access_token = 'RbbQB/btxYU8qNvKDTngdHTtPb3W0uyB1XSl31aYEdcDD39zi/aszgSaZMz1FuOt8nSqaJBb7tKr0hJKH9ikwwDOyPNugS1q3fUqibNMDya93hzdFE0/8KiAboYBCDNwWk7x/AryUXK4TohhmWwsqwdB04t89/1O/w1cDnyilFU=';
// Get POST body content$content = file_get_contents('php://input');
// Parse JSON$events = json_decode($content, true);
// Validate parsed JSON dataif (!is_null($events['events'])) {	
// Loop through each event	foreach ($events['events'] as $event) {		
// Reply only when message sent is in 'text' format		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {			
// Get text sent			$text = $event['message']['text'];			
// Get replyToken			$replyToken = $event['replyToken'];			
// Build message to reply back			$messages = [				'type' => 'text',				'text' => $text			];			
// Make a POST Request to Messaging API to reply to sender			$url = 'https://api.line.me/v2/bot/message/reply';			
$data = [				'replyToken' => $replyToken,				'messages' => [$messages],			];			$post = json_encode($data);			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);			$ch = curl_init($url);			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);			$result = curl_exec($ch);			curl_close($ch);			echo $result . "";		}	}}echo "OK";
