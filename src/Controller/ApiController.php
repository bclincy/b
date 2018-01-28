<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 11/17/17
 * Time: 6:22 AM
 */

namespace app\Controller;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ApiController
{


    /**
     * @var ContainerInterface
     */
    protected $container;
    /** @var mixed|\PDO */
    protected $pdo;
    /** @var array $error */
    protected $error;
    /** @var \Monolog\Logger */
    protected $logger;
    /** @var array $apiMsgs */
    protected $apiMsgs;
    /** @var array $required */
    protected $required = [
        'mothersday' => ['fname|string|2', 'lname|string|2', 'email|string'],
        'contact' => ['name|string|5', 'emailCnt|email|', 'message|string|5'],
        'shoutout' => ['name|string|5', 'shoutout|string|15', 'slug|string|3'],
    ];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->pdo = $container->pdo;
        $this->logger = $container->logger;
        $this->apiMsgs = $container->get('apiStatus');
    }


    public function contactFrm (Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        if ($data !== null) {
            array_walk($this->required['contact'], [$this, 'meetsRequirements'], $data);
            $data['email'] = $data['emailCnt'];
            if ($this->error !== null) {
                $return = $this->apiMsgs['codes'][400];
                $return['status'] = 'Failure';
                $error = ucwords(implode(' <br />', $this->error[0]));
                $return['content'] = '<h2>Please Fill All Required Fields</h2><p>' . $error . '</p>';
            } else {
                list($firstName, $lastName) = $this->nameSplits($data['name']);
                try {
                    $name = $data['name'];
                    $dbdata = [
                        ':fname' => $firstName,
                        ':lname' => $lastName,
                        ':email' => $data['emailCnt'],
                        ':subject' => $data['subject'],
                        ':message' => $data['message'],
                    ];
                    $sql = 'INSERT INTO contact (fname, lname, email, subject, message, isReturned, recievedOn) VALUES (
                             :fname, :lname, :email, :subject, :message, 0, now() )';
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute($dbdata);
                    $return['id'] = $this->pdo->lastInsertId();
                    $mail = $this->sendmail($data);
                    $return['sent'] = $mail;
                    $return['status'] = 200;
                    $return['msg'] = 'Success';
                    $return['content'] = '<div><h1><i class="fa fa-thumbs-o-up fa-2x"'
                        . 'aria-hidden="true"></i> ' . $name . ' your message was sent!</h1>' . '<p>Thank you your ' .
                        'feedback is important to us please give us 24 hours to respond to your message.</p>';
                } catch (\Exception $e) {
                    $return = $this->restErrors(500);
                    $return['content'] = $e->getMessage();
                    return $response->withJson($return)->withHeader('Content-Type', 'application/json');
                }
            }
        } else {
            $return = $this->restErrors(500);
            $return['status'] = 'error';
        }

        return $response->withJson($return)->withHeader('Content-Type', 'application/json');
    }

    public function contact (Request $request, Response $response)
    {
        if( $data = $request->getParsedBody() ) {
            if (isset($error) && is_array($error)) {
                $msg['details'] = implode("\n", $error);
                $msg['code'] = 400;
                $data = $this->restErrors($msg);
            } else {
                $data = [];
                $data['code'] = 200;
                $data['success'] = true;
                $data['status'] = "We sent an email";
            }
        }
        if ($data == null) {
            $data = $this->restErrors($msg['code'] = 500);
        }
        return $response->withJson($data)->withHeader('Content-Type', 'application/json');

    }

    public function test()
    {
        echo 'noal';
        die('hello');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function newsSignup(Request $request, Response $response)
    {
        $body = $request->getBody();
        $data = ['fname'=>'Brian', 'lname'=>'clincy'];

        return $response->withJson($data)->withHeader('Content-Type', 'application/json');
    }

    public function restErrors($msg)
    {
        switch ($msg['code']) {
            case 400:
                $data = ['msg' => 'Bad Request, check data', 'code' => 400];
                break;
            case 401:
                $data = ['msg' => 'Unauthorized please check your credentials', 'code' => 401];
                break;
            case 404:
                $data = ['msg' => 'The Resources requested does not exists', 'code' => 404];
                break;
            case 402:
                $data = ['msg' => 'Parameters were valid but the request failed', 'code' => 402];
                break;
            case 429:
                $data = ['msg' => 'Too many request hit the API in concession', 'code' => 429];
                break;
            case 500:
                $data = ['msg' => 'Internal Server error our side is down', 'code' => 500];
                break;
            default:
                $data['msg'] = 'System is currently down please try again later';
        }

        $data['error'] = $msg['error'];
        $data['status'] = 'Failed';
        $data['details'] = $this->error;
        return array_filter($data);

    }

    public function genericForm (Response $response, Request $request)
    {
        $name = $request->getAttribute('frmName');

    }

    public function nnutsById(Request $request, Response $response)
    {
        try {
            $id = $request->getAttribute('id');
            $stmt = $this->pdo->prepare('SELECT * FROM podcast WHERE id = :id');
            $stmt->execute([':id' => $id]);
            $data = $stmt->fetchAll();
            $data = $data[0] !== null ? $data[0] : [];
        } catch (\Exception $e) {
            $this->logger->addError('NNUTS by ID' . print_r($request, true));
            $data = $this->restErrors(400);
        }
        return $response->withJson($data)->withHeader('Content-Type', 'application/json');

    }



    private function meetsRequirements ($details, $key, $data)
    {
        list($name, $type, $length) = explode('|', $details);
        if (isset($name) && !isset($data[$name])) {
            $error[] = ucwords(strtolower($name)) . ' Was Empty';
        } else {

            switch ($type) {
                case 'int':
                    if ( $data[$name] < $length ) {
                        $error[] = ucwords($name) . ' number smaller than min';
                    }
                    break;
                case 'string':
                    if (strlen($data[$name]) < $length) {
                        $error[] = $key .' is string smaller than min';
                    }
                    break;
                case 'email':
                    if (!filter_var($data[$name], FILTER_VALIDATE_EMAIL)) {
                        $error[] = $data[$name] . ' has an invalid email format';
                    }
                    break;
                case 'date':
                    if (!$this->validateDate($data[$name], $length)) {
                        $error[] = $key . ' is not a date';
                    }
                    break;
            }
        }
        if (isset($error) && is_array($error)) {
            $dd = print_r($_SERVER, true) . "\n" . print_r($data, true);
            $this->logger->addInfo('Bad contact form data dump: '.$dd );
            $this->error[] = $error;
            return false;
        }

        return true;
    }

    public function isValidToken()
    {
        $token = $_SERVER['PHP_AUTH_USER'];
        if ($token === null) {
            $valid = false;
        } else {
            $user = base64_decode($_SERVER['PHP_AUTH_USER']);
            $valid = true;
        }

        return $valid;
    }

    private function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    private function nameSplits ($name)
    {
        $name = ucwords(strtolower($name));
        list($firstName, $lastName)  = explode(' ', $name);
        if ($firstName === null || $lastName === null) {
            $firstName = ucwords(strtolower($name));
            $lastName = $firstName;
        }

        return [$firstName, $lastName];

    }

    private function sendmail($data)
    {
        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($this->container->transport);
        $data['message'] = strip_tags($data['message'], '<br><p><div>');
        // Create a message
        $message = (new \Swift_Message($data['subject']))
            ->setFrom(['info@brianclincy.com' => 'Brian'])
            ->setTo(['bclincy@gmail.com', 'info@brianclincy.com' => 'Brian Clincy'])
            ->setBody($data['message'], 'text/html')
            ->addPart(strip_tags($data['message']), 'text/plain');

        // Send the message
        return $mailer->send($message);

    }

    private function addShoutout(Request $request, Response $response)
    {
        $shoutout = $request->getParsedBody();
        if ($shoutout !== null) {


        }

        return false;

    }

}