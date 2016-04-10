require "aws.phar";

use Aws\Ses\SesClient,
use Aws\Ses\Exception\SesException,
use Aws\Common\Enum\Region;

// initialize AWS SES
$client = SesClient::factory(array(
　　'key' => 'AWS key',
　　'secret' => 'AWS secret',
　　'region' => Region::US_WEST_2,
));

//HTML mail body
$html_templete = '<b>test sending from AWS SES </b>';

// setting HTML mail body,Charset
$body = array('Data' => $html_templete,'Charset' => 'iso-2022-jp');

// mail sending
$mail = $client->sendEmail(array(

　　// From,To
　　'Source' => 'test_from@test.com', //FROM mail address
　　'Destination' => array(
　　'ToAddresses' => array('test_to@test.com'), //To mail address
　　),

　　// Subject
　　'Message' => array(
　　　'Subject' => array(
　　　'Data' => 'subject is ses sending',
　　),

　　// Body
　　'Body' => array('Html' => $body),
　　),
　)
);

// receive response
$response = $mail->toArray();
$message_id = $response["MessageId"];
$request_id = $response["ResponseMetadata"]["RequestId"];
